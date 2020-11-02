<?php

namespace App\Http\Controllers\App;

use App\Models\Role;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\CustomerCreateRequest;
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
        $customers = User::where('role_id', Role::where('type', UserRole::USER)->first()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('app.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerCreateRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(CustomerCreateRequest $request)
    {
        $user = Role::where('type', UserRole::USER)->first()->users()->create($request->all());

        success_toast_alert("Client $user->full_name créer avec success");
        log_activity("Client", "Création du client $user->full_name");

        return redirect(route('customers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $customer
     * @return Application|Factory|RedirectResponse|View
     */
    public function show(User $customer)
    {
        return view('app.customers.show', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $customer
     * @return RedirectResponse
     */
    public function update(Request $request, User $customer)
    {
        $customer->is_confirmed = !$customer->is_confirmed;
        $customer->save();
        return back();
    }

    /**
     * @param User $customer
     * @return Application|Factory|RedirectResponse|View
     * @throws \Exception
     */
    public function destroy(User $customer)
    {
        if(!$customer->can_delete) return $this->unauthorizedToast();

        $customer->delete();

        success_toast_alert("Client $customer->full_name archivé avec success");
        log_activity("Client", "Archivage du client $customer->full_name");

        return redirect(route('customers.index'));
    }
}