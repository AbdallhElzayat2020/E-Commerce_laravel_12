<?php

namespace App\Repositories\Dashboard;

use App\Models\Contact;

class ContactRepository
{

    public function getMarkReadContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->read()->latest();
    }
    public function getMarkUnreadContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->unread()->latest();
    }
    public function getAnsweredContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->answered()->latest();
    }
    public function getInboxContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->latest();
    }
    public function getTrashedContacts($keyword = null)
    {
        return Contact::searchContact($keyword)->onlyTrashed()->latest();
    }
    public function getContactById($id)
    {
        return Contact::withTrashed()->find($id);
    }
    public function deleteContact($contact)
    {
        return $contact->delete();
    }
    public function deleteAllReadedContacts()
    {
        return Contact::read()->delete();
    }
    public function markAllAsRead()
    {
        $contacts = Contact::get();
        foreach ($contacts as $contact) {
            $contact->is_read = 1;
            $contact->save();
        }
        return true;
    }
    public function deleteAllAnsweredContacts()
    {
        return Contact::answered()->delete();
    }
    public function markRead($contact)
    {
        $contact->is_read = 1;
        $contact->save();
    }
    public function markUnread($contact)
    {
        $contact->is_read = 0;
        $contact->save();
    }
    public function latestContact()
    {
        return Contact::latest()->first();
    }
    // sofDeletes
    public function restoreContact($contact)
    {
        return $contact->restore();
    }
    public function forceDeleteContact($contact)
    {
        return $contact->forceDelete();
    }
}
