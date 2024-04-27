<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Regions;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function userProfile(){
         $code=Auth::user()->google2fa_secret;
        return view('pages.users.profile',compact('code'));
    }
    //
    public function createUser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255','unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string','confirmed',Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
        'destination' => ['required', 'string', 'max:255'],
        'region' => ['required', 'string', 'max:255'],
    ]);

    if ($validator->fails()) {
        // return response()->json(['errors' => $validator->errors()], 422);
        return redirect()->back()->withErrors($validator->errors());
    }
    $google2fa = new Google2FA();
    $secret = $google2fa->generateSecretKey();
    // Encode the secret key to Base32
    // $base32EncodedSecret = base64_encode($secret);
 
    // $hashedSecret =  Hash::make($base32EncodedSecret);

    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'destination' => $request->input('destination'),
        'region' => $request->input('region'),
        'google2fa_secret'=>$secret,
    ]);
    $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {

            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }

        //Redirect to the users.index view and display message
        return redirect()->route('admin.users')
            ->with('success',
                'User successfully added.');

    return redirect()->route('admin.users')->with('success','User created successfully');
}
    public function editUser(Request $request,$id){
        $regions=Regions::get();
        $roles = Role::get();
        $user=User::find($id);
        return view('pages.users.updateUser',compact('regions','user','roles'));
        }
    public function UpdateUser(Request $request,$id)
            {
                $user = User::findOrFail($id); //Get user specified by id

        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $input = $request->only(['name', 'email']); //Retrieve the name, email fields
        $roles = $request['roles']; //Retreive all roles
        $user->fill($input)->save();

        if ($request->get('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        if (isset($roles)) {
            $user->roles()->sync($roles); //If one or more role is selected associate user to roles
        } else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
        return redirect()->route('admin.users')
            ->with('success',
                'User successfully edited.');
            }

}
