<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Livewire\Component;

class MaintenanceMode extends Component
{
    public $maintenance;
    public $token;

    public function mount()
    {
        $this->maintenance = app()->isDownForMaintenance();
        $this->generateToken();
    }

    /**
     * Bring Application out of Maintenance Mode.
     *
     * @return void
     */
    public function up()
    {
        @unlink(storage_path('framework/down'));
        $this->alert('success', __('Maintenance mode deactivated !'));
    }

    /**
     * Put Application into Maintenance Mode.
     *
     * @param Request $request
     * @return void
     */
    public function down($token)
    {
        $this->demoMode();
        Artisan::call('down', ['--secret' => $token]);
        $this->alert('success', __('Maintenance mode activated !'));
    }

    public function generateToken()
    {
        $this->token = Str::random(32);
    }

    public function demoMode(){
        abort_if(config('saas.demo_mode'),403,'Unauthorized action on demo mode! Please Buy Saasify to test that feature');
    }

    public function render()
    {
        return view('livewire.maintenance-mode')
        ->extends('layouts.admin')
        ->section('content');
    }
}
