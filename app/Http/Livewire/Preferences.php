<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Preferences extends Component
{
    public $language;
    public $timezone;

    public function mount()
    {
        $this->language = auth()->user()->locale;
        $this->timezone = auth()->user()->timezone;
    }
    public function updateLocal(){
        
    }

    public function render()
    {
        return view('livewire.preferences');
    }
}
