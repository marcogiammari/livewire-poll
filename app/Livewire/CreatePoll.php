<?php

namespace App\Livewire;

use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First'];
    
    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = 'Second';
    }

    public function removeOption($index)
    {
        // rimuove l'opzione dall'array
        unset($this->options[$index]);
        // ricreiamo l'array per assicurarci che non ci siano "buchi" negli indici
        $this->options = array_values($this->options);
    }

    // proprietà semplici si inizializzano come $options
    // proprietà più complesse si possono inserire nel metodo mount()
    // public function mount() 
    // {
        // es. $options = prendo dati dal db
    // }
}
