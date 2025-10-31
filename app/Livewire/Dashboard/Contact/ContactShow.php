<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Attributes\On;
use Livewire\Component;

class ContactShow extends Component
{
    public $msg;

    #[On('show-message')]
    public function showMessage($msgeId)
    {
        $this->msg = Contact::where('id', $msgeId)->first();
    }


    public function deleteMsg($msgId)
    {
        Contact::where('id', $msgId)->delete();
        $this->msg = Contact::where('id', $msgId)->first();
        $this->dispatch('msg-deleted', 'Message Deleted Successfully');
    }

    public function render()
    {
        return view('livewire.dashboard.contact.contact-show');
    }
}
