<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class PostMessage extends Component
{
    public $textInput, $messages;

    protected function rules()
    {
        return [
            'textInput' => 'required'
        ];
    }

    public function mount()
    {
        $this->messages = [];
    }

    public function submitText()
    {
        $data = $this->validate();

        $set = preg_split('/\W/', $data['textInput']);

        $set = array_filter($set, static function ($element) {
            return $element !== "";
        });

        $messageBool = false;
        foreach ($set as $value) {
            $search = Str::lower($value);

            foreach ($this->contexts() as $context) {
                if (in_array($search, $context['context'])) {
                    $messageBool = true;
                    //   dd($context['message']);

                    $this->messages[] = [
                        'conversation' => "You: " . $data['textInput'],
                        'convo_time' => now(),
                        'response' => "System: " . $context['message'],
                        'response_time' => now()
                    ];
                }
            }
        }

        if (!$messageBool) {
            // dd("Sorry, I don't understand.");
            $this->messages[] = [
                'conversation' => "You: " . $data['textInput'],
                'response' => "System: Sorry, I don't understand.",
                'convo_time' => now(),
                'response_time' => now()
            ];
        }
    }


    public function contexts()
    {
        return collect([
            [
                'context' => ['hello', 'hi'],
                'message' => 'Welcome to StationFive.'
            ],
            [
                'context' => ['goodbye', 'bye'],
                'message' => 'Thank you, see you around.'
            ]
        ]);
    }

    public function render()
    {
        return view('livewire.post-message');
    }
}
