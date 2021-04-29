<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;

class SwapPlan extends Component
{
    public $month = false;
    public $show = 'month';
    public $plans = [];

    public function mount()
    {
        // $this->plans = Plan::where('slug', '!=', currentTeam()->plan->slug)->get();
        $this->plans = Plan::where('active', true)->get();
    }

    public function switchPlan()
    {
        $this->show = $this->month ? 'year' : 'month';
    }

    public function render()
    {
        return view('livewire.swap-plan');
    }
}
