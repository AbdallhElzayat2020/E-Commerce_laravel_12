<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\Dashboard\ContactService;

class ContactShow extends Component
{
    public $msg;
    protected $listeners = [
        'contact-replay' => '$refresh',
        'refresh-show' => '$refresh',
    ];

    protected ContactService $contactService;

    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function mount()
    {
        $this->msg = $this->contactService->latestContact();
    }

    #[On('show-message')]
    public function showMessage($msgId)
    {
        $this->msg = $this->contactService->getContactById($msgId);
        $this->dispatch('refresh-messages');
    }

    public function replayMsg($msgId)
    {
        $this->dispatch('call-replay-contact-component', $msgId);
    }

    public function markAsUnRead($msgId)
    {
        $this->contactService->markUnread($msgId);
        $this->dispatch('refresh-messages');
    }

    public function deleteMsg($msgId)
    {
        $this->contactService->deleteContact($msgId);
        $this->msg = $this->contactService->latestContact();
        $this->dispatch('msg-deleted', 'Message Deleted Successfully');
        $this->dispatch('refresh-show');
    }

    public function forceDelete($msgId)
    {
        $this->contactService->forceDeleteContact($msgId);
        $this->msg = $this->contactService->latestContact();
        $this->dispatch('msg-deleted', 'Message Deleted Successfully');
        $this->dispatch('refresh-show');
    }

    public function restoreContact($msgId)
    {
        $this->contactService->restoreContact($msgId);
        $this->dispatch('refresh-messages');
    }

    public function render()
    {
        return view('livewire.dashboard.contact.contact-show');
    }
}
