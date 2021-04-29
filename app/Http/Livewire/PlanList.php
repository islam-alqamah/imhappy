<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;

class PlanList extends Component
{
    public $plans = [];
    public $month = false;
    public $show = 'month';
    // public $title = '';
    // public $subtitle = '';

    public function mount()
    {
        // $this->plans = Plan::get();
        $this->plans = Plan::where('interval', $this->show)->get();
    }

    public function changePlan()
    {
        $this->show = $this->month ? 'year' : 'month';
        $this->plans = Plan::where('interval', $this->show)->get();
    }

    public function render()
    {
        return view('livewire.plan-list');
    }
}
