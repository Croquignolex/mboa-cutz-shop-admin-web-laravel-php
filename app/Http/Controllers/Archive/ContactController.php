<?php

namespace App\Http\Controllers\Archive;

use App\Models\Contact;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ContactController extends Controller
{
    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $contacts = Contact::onlyTrashed()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.contacts', compact('contacts'));
    }

    /**
     * @param Int $contact
     * @return Application|Factory|RedirectResponse|View
     */
    public function restore(Int $contact)
    {
        $trashed_contacts = Contact::withTrashed()->where('id', $contact)->first();
        if(!$trashed_contacts->can_delete) return $this->unauthorizedToast();

        $trashed_contacts->restore();

        success_toast_alert("Message de contact $trashed_contacts->subject restoré avec success");
        log_activity("Message", "Restoration du message de contact $trashed_contacts->subject");

        return redirect(route('archives.contacts.index'));
    }
}