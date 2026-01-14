<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePoll extends Component
{
    #[Validate('required|min:3|max:255')]
    public $title;

    #[Validate([
        'options' => 'required|array|min:2|max:10',
        'options.*' => 'required|min:1|max:255'
    ], message: [
        'options.*' => "The option field can't be empty",
        'options.max' => "One Poll can't have more than 10 options",
        'options.min' => "One Poll can't have less than 2 options"
    ])]
    public $options = [''];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.create-poll');
    }
    public function createPoll()
    {
        $this->validate();
        Poll::create([
            'title' => $this->title,
            'options' => $this->options
        ])->options()->createMany(
            collect($this->options)
                ->map(fn($option) => ['name' => $option])
                ->all()
        );
        $this->reset(['title', 'options']);
        $this->dispatch('poll-created');
    }

    public function addOption()
    {
        $this->options[] = '';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        $this->options = array_values($this->options);
    }
}
