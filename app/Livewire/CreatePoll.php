<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = ['First'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|array|min:1|max:10',
        // così puoi validare ogni elemento dell'array
        'options.*' => 'required|min:1|max:255'
    ];

    protected $messages = [
        'options.*' => "The option can't be empty"
    ];

    // esegue logica ogni volta che una proprietà viene aggiornata 
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        // rimuove l'opzione dall'array
        unset($this->options[$index]);
        // ricreiamo l'array per assicurarci che non ci siano "buchi" negli indici
        $this->options = array_values($this->options);
    }

    public function createPoll()
    {
        $this->validate();

        $poll = Poll::create([
            'title' => $this->title
        ]);

        foreach ($this->options as $optionName) {
            $poll->options()->create(['name' => $optionName]);
        }

        // metodo alternativo per creare il poll con options insieme

        // Poll::create([
        //     'title' => $this->title
        // ])->options()->createMany(
        //     collect($this->options)
        //         ->map(fn ($option) => ['name' => $option])
        //         ->all()
        // );

        $this->reset('title', 'options');
    }

    // proprietà semplici si inizializzano come $options
    // proprietà più complesse si possono inserire nel metodo mount()
    // public function mount() 
    // {
    // es. $options = prendo dati dal db
    // }
}
