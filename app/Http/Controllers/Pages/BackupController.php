<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Illuminate\Support\Facades\Log;

class BackupController extends Controller
{
    //
     public function backup(Request $request)
    {
        try {
            $config= config('backup.backup');
            // Create a new backup job
            // dd($config);
            Log::info($config);
            if ($config === null) {
            throw new \Exception('Backup configuration is null');
            }

        // Proceed with the backup job creation
        $backupJob = BackupJobFactory::createFromArray($config);
            // $backupJob = BackupJobFactory::createFromArray(config('backup.source.databases'));

            // Execute the backup
            $backupJob->run();

            // Retrieve the path to the backup
            $backupPath = $backupJob->getBackupDestination()->backupPath();

            // You can now move the backup file to your desired location, such as OneDrive
            // For simplicity, let's just save it to a local directory within the Laravel project
            $destinationPath = storage_path('backups');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true); // Create the directory if it doesn't exist
            }
            $backupFileName = basename($backupPath);
            $backupFullPath = $destinationPath . '/' . $backupFileName;

            // Move the backup file
            rename($backupPath, $backupFullPath);

            return redirect()->back()->with('success', 'Database backup successful.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Database backup failed: ' . $e->getMessage());
        }
    }
}
