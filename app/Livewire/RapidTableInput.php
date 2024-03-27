<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RapidTableInput extends Component
{
    public array $items = [];

    public function render()
    {
        return view('livewire.rapid-table-input');
    }

    public function save()
    {
        Log::info(print_r($this->items, true));
    }
}
