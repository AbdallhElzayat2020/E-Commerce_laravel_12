<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactMessages extends Component
{

    use WithPagination;

    public $itemSearch;
    public $openMsgId;

    public $page = 1;

    public function updatingItemSearch()
    {
        $this->resetPage();
    }

    public function showMessage($msgeId)
    {
        $this->dispatch('show-message', $msgeId);
        $this->openMsgId = $msgeId;
    }

    public function render()
    {
        return view('livewire.dashboard.contact.contact-messages', [
            'messages' => Contact::when($this->itemSearch, function ($query) {
                $query->where('email', 'like', '%' . $this->itemSearch . '%');
            })->latest()->paginate(6),
        ]);
    }
}
