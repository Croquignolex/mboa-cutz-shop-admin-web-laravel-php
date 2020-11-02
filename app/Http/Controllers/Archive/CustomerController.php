<?php

namespace App\Http\Controllers\Archive;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class CustomerController extends Controller
{
    /**
     * CustomerController constructor.
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
        $customers = User::onlyTrashed()
            ->where('role_id', Role::where('type', UserRole::USER)->first()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.customers', compact('customers'));
    }

    /**
     * @param String $customer
     * @return Application|Factory|RedirectResponse|View
     * @throws Exception
     */
    public function restore(String $customer)
    {
        $trashed_customer = User::withTrashed()->whereSlug($customer)->first();
        if(!$trashed_customer->can_delete) return $this->unauthorizedToast();

        $trashed_customer->restore();

        success_toast_alert("Client $trashed_customer->full_name restoré avec success");
        log_activity("Client", "Restoration du client $trashed_customer->full_name");

        return redirect(route('archives.customers.index'));
    }
}