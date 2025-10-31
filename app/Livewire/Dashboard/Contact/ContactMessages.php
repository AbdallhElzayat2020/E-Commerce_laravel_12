<?php

namespace App\Livewire\Dashboard\Contact;

use App\Models\Contact;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Services\Dashboard\ContactService;

class ContactMessages extends Component
{
    use WithPagination;

    public $itemSearch;
    public $page = 1;
    public $opendMsgId;
    public $screen = 'inbox';

    protected $listeners = [
        'msg-deleted' => '$refresh',
        'refresh-messages' => '$refresh',
    ];

    protected ContactService $contactService;

    public function boot(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function updatingItemSearch()
    {
        $this->resetPage();
    }

    public function showMessage($msgId)
    {
        $this->markAsRead($msgId);
        $this->dispatch('show-message', $msgId);
        $this->opendMsgId = $msgId;
    }

    public function markAsRead($msgId)
    {
        $this->contactService->markAsRead($msgId);
    }

    #[On('select-screen')]
    public function selectScreen($screen)
    {
        $this->screen = $screen;
    }

    public function render()
    {
        if ($this->screen == 'readed') {
            $messages = $this->contactService->getMarkReadContacts(trim($this->itemSearch));
        } elseif ($this->screen == 'answered') {
            $messages = $this->contactService->getAnsweredContacts(trim($this->itemSearch));
        } elseif ($this->screen == "trashed") {
            $messages = $this->contactService->getTrashedContacts(trim($this->itemSearch));

        } else {
            $messages = $this->contactService->getInboxContacts(trim($this->itemSearch));
        }

        return view('livewire.dashboard.contact.contact-messages', [
            'messages' => $messages->paginate(5),
        ]);
    }
}
