<?php

namespace App\Http\Controllers\App;

use Exception;
use App\Models\Contact;
use App\Enums\Constants;
use Illuminate\Support\Facades\DB;
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
        Contact::where('is_read', false)->update(['is_read' => true]);

        $contacts = Contact::orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.contacts', compact('contacts'));
    }

    /**
     * @param Contact $contact
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Contact $contact)
    {
        if(!$contact->can_delete) return $this->unauthorizedToast();

        $contact->delete();

        success_toast_alert("Message de contact $contact->subject archivée avec success");
        log_activity("Message de contact", "Archivage du message de contact $contact->subject");

        return redirect(route('contacts.index'));
    }
}