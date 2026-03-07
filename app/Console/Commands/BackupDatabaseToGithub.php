<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Log;

class BackupDatabaseToGithub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:github';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically backup the MySQL database and push it to GitHub';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database backup to GitHub...');

        // Database connection details
        $host = env('DB_HOST', '127.0.0.1');
        $port = env('DB_PORT', '3306');
        $username = env('DB_USERNAME', 'root');
        $password = env('DB_PASSWORD', '');
        $database = env('SALEPRO_DB_DATABASE', env('DB_DATABASE', 'lenzbreeze'));
        
        $backupDir = database_path('backups');
        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $backupFile = $backupDir . '/lenzbreeze_backup.sql';

        // Find mysqldump (adjust path if XAMPP is different)
        $mysqldumpPath = 'mysqldump';
        if (file_exists('C:\xampp\mysql\bin\mysqldump.exe')) {
            $mysqldumpPath = 'C:\xampp\mysql\bin\mysqldump.exe';
        }

        // 1. Run mysqldump
        $passwordOption = $password ? "--password=\"{$password}\"" : '';
        $dumpCmd = sprintf(
            '"%s" --host=%s --port=%s --user=%s %s %s > "%s"',
            $mysqldumpPath, $host, $port, $username, $passwordOption, $database, $backupFile
        );

        $this->info("Exporting database: {$database}...");
        $result = Process::run($dumpCmd);

        if (!$result->successful()) {
            $this->error("Backup failed: " . $result->errorOutput());
            Log::error("Database backup to GitHub failed: " . $result->errorOutput());
            return 1;
        }
        
        $this->info("Dump successful. Pushing to GitHub...");

        // 2. Git Automation
        $baseDir = base_path();
        
        Process::path($baseDir)->run('git add database/backups/lenzbreeze_backup.sql');
        
        $commitMessage = 'Auto DB Backup - ' . now()->toDateTimeString();
        $commitResult = Process::path($baseDir)->run('git commit -m "' . $commitMessage . '"');
        
        // If there's nothing to commit, Git exits with code 1 (which is fine, just means no DB changes)
        if (str_contains($commitResult->output(), 'nothing to commit') || str_contains($commitResult->errorOutput(), 'nothing to commit')) {
            $this->info('No database changes to backup since last commit.');
            return 0;
        }

        $pushResult = Process::path($baseDir)->run('git push');

        if (!$pushResult->successful()) {
            $this->error("Failed to push to GitHub: " . $pushResult->errorOutput());
            Log::error("Database backup git push failed: " . $pushResult->errorOutput());
            return 1;
        }

        $this->info('Backup successfully pushed to GitHub!');
        Log::info('Database successfully synced to GitHub.');
        return 0;
    }
}
