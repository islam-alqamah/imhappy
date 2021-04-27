<?php

namespace App\Http\Livewire;

use App\Jobs\CreateBackupJob;
use App\Rules\BackupDisk;
use App\Rules\PathToZip;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Spatie\Backup\BackupDestination\Backup as SpatieBackup;
use Spatie\Backup\BackupDestination\BackupDestination;
use Spatie\Backup\Helpers\Format;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatus;
use Spatie\Backup\Tasks\Monitor\BackupDestinationStatusFactory;

class Backup extends Component
{
    // use  LivewireAlert;
    public $activeDisk = null;
    public $disks = [];
    public $backups = [];

    public $backupStatuses = [];

    public function mount()
    {
        $status = Cache::remember('backup-statuses', now()->addSeconds(4), function () {
            return BackupDestinationStatusFactory::createForMonitorConfig(config('backup.monitor_backups'))
                ->map(function (BackupDestinationStatus $backupDestinationStatus) {
                    return [
                        'name' => $backupDestinationStatus->backupDestination()->backupName(),
                        'disk' => $backupDestinationStatus->backupDestination()->diskName(),
                        'reachable' => $backupDestinationStatus->backupDestination()->isReachable(),
                        'healthy' => $backupDestinationStatus->isHealthy(),
                        'amount' => $backupDestinationStatus->backupDestination()->backups()->count(),
                        'newest' => $backupDestinationStatus->backupDestination()->newestBackup()
                            ? $backupDestinationStatus->backupDestination()->newestBackup()->date()->diffForHumans()
                            : 'No backups present',
                        'usedStorage' => Format::humanReadableSize($backupDestinationStatus->backupDestination()->usedStorage()),
                    ];
                })
                ->values();
        });
        $this->disks = $status->map(function ($stat) {
            return $stat['disk'];
        });

        if (empty($this->activeDisk)) {
            $this->activeDisk = $this->disks->first();
        }

        $this->getFiles();
        $this->backupStatuses = $status;
    }

    public function getFiles()
    {
        if (! empty($this->activeDisk)) {
            $this->backups($this->activeDisk);
        }
        // show alert
        $this->alert('success', __('Backup files Refreshed !'));

    }

    public function backups($disk)
    {
        $validated = ['disk' => $disk];
        $backupDestination = BackupDestination::create($validated['disk'], config('backup.backup.name'));

        $backups = Cache::remember("backups-{$validated['disk']}", now()->addSeconds(4), function () use ($backupDestination) {
            return $backupDestination
                ->backups()
                ->map(function (SpatieBackup $backup) {
                    return [
                        'path' => $backup->path(),
                        'date' => $backup->date()->format('Y-m-d H:i:s'),
                        'size' => Format::humanReadableSize($backup->size()),
                    ];
                });
        });
        $this->activeDisk = 'local';
        $this->backups = $backups;
    }

    public function createBackup($option = '')
    {
        // $option = $request->input('option', '');
        $this->demoMode();
        dispatch(new CreateBackupJob($option))
            ->onQueue(config('saas.backup.queue'));
        $this->backups($this->activeDisk);
        // show alert
        $this->alert('success', __('Creating a new backup in the background...'));
    }

    // public function delete(Request $request)
    public function delete($disk, $path)
    {
        $this->demoMode();
        // $validated = $request->validate([
        //     'disk' => new BackupDisk(),
        //     'path' => ['required', new PathToZip()],
        // ]);

        $backupDestination = BackupDestination::create($disk, config('backup.backup.name'));

        $backupDestination
            ->backups()
            ->first(function (SpatieBackup $backup) use ($path) {
                return $backup->path() === $path;
            })
            ->delete();

        $this->backups($this->activeDisk);
        $this->alert('success', __('Backup delete successfully !'));
    }

    public function updateBackupStatuses()
    {

        // $this->alert('success', __('Backup status refreshed !'));
    }

    public function demoMode(){
        abort_if(config('saas.demo_mode'),403,'Unauthorized action on demo mode! Please Buy Saasify to test that feature');
    }

    public function render()
    {
        return view('livewire.backup');
    }
}
