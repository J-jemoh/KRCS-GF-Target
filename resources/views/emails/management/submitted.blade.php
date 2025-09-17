@component('mail::message')
# Management Action Submitted

Hello {{ $managementAction->user->name }},

Your management action for SR **{{ $managementAction->sr_name }}** was submitted successfully.

**Key Issues:** {{ $managementAction->key_issues }}

@component('mail::button', ['url' => route('keyActions.show', $managementAction->id)])
View Action
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
