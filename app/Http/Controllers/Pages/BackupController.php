<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class BackupController extends Controller
{
    //
     public function backup(Request $request)
{
    $db   = config('database.connections.pgsql.database');
    $user = config('database.connections.pgsql.username');
    $pass = config('database.connections.pgsql.password');
    $host = config('database.connections.pgsql.host');
    $port = config('database.connections.pgsql.port');

    // Detect pg_dump path based on OS
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $pgDumpPath = 'C:\\Program Files\\PostgreSQL\\16\\bin\\pg_dump.exe';
    } else {
        $pgDumpPath = 'pg_dump';
    }

    // Create backup folder if not exists
    $backupDir = storage_path('app/backups');
    if (!file_exists($backupDir)) {
        mkdir($backupDir, 0755, true);
    }

    $backupFile = 'backups/' . $db . '_' . date('Y-m-d_H-i-s') . '.sql';

    // Build command for logging & testing
    $command = sprintf(
        'PGPASSWORD=%s "%s" -h %s -p %d -U %s -F c -b -v -f "%s" %s',
        $pass,
        $pgDumpPath,
        $host,
        $port,
        $user,
        storage_path('app/' . $backupFile),
        $db
    );

    // Log the command so you can try it in terminal
    \Log::info("Backup command: " . $command);

    // Run the process
    $process = Process::fromShellCommandline($command);
    $process->run();

    if (!$process->isSuccessful()) {
        return response()->json([
            'success' => false,
            'message' => 'Backup failed',
            'error'   => $process->getErrorOutput() ?: 'No error output - check credentials & host.'
        ], 500);
    }

    return response()->download(storage_path('app/' . $backupFile))->deleteFileAfterSend(true);
}

}
