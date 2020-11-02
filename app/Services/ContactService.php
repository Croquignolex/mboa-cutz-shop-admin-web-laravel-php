<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;

class ContactService
{
    /**
     * unread contact messages number
     *
     * @return int
     */
    public function unreadMessagesNumber() {
        return $this->unreadMessages()->count();
    }

    /**
     * Only take 5 unread contact messages
     *
     * @return Contact[]|Collection
     */
    public function unreadMessagesToDisplay() {
        return $this->unreadMessages()->take(5);
    }

    /**
     * All unread contact messages
     *
     * @return Contact[]|Collection
     */
    private function unreadMessages() {
        return Contact::where('is_read', false)->orderBy('updated_at', 'desc')->get();
    }
}