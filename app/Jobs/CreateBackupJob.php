<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class CreateBackupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $option;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($option = '')
    {
        $this->option = $option;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $backupJob = BackupJobFactory::createFromArray(config('backup'));

        if ($this->option === 'only-db') {
            $backupJob->dontBackupFilesystem();
        }

        if ($this->option === 'only-files') {
            $backupJob->dontBackupDatabases();
        }

        if (! empty($this->option)) {
            $prefix = str_replace('_', '-', $this->option).'-';

            $backupJob->setFilename($prefix.date('Y-m-d-H-i-s').'.zip');
        }

        $backupJob->run();
    }
}
