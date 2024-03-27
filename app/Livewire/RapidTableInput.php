<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class RapidTableInput extends Component
{
    public array $items = [
        ['row' => 0, 'nama' => 'example', 'harga' => 1000, 'quantity' => 5, 'total' => 1000 * 5],
    ];

    public function render()
    {
        return view('livewire.rapid-table-input');
    }

    public function save()
    {
        Log::info(print_r($this->items, true));
    }
}
