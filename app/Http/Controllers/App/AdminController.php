<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\AdminCreateRequest;
use App\Models\Role;
use App\Models\User;
use App\Enums\UserRole;
use App\Models\Product;
use App\Enums\Constants;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class AdminController extends Controller
{
    /**
     * ProductsController constructor.
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
        $admins = User::where('role_id', Role::where('type', UserRole::ADMIN)->first()->id)
            ->orWhere('role_id', Role::where('type', UserRole::SUPER_ADMIN)->first()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        $admin_role = Role::where('type', UserRole::ADMIN)->first();
        $super_admin_role = Role::where('type', UserRole::SUPER_ADMIN)->first();

        $roles =  [
            [
                "value" => $admin_role->type,
                "label" => $admin_role->name,
                'class' => "badge badge-pill badge-$admin_role->badge_color"
            ]
        ];

        if(Auth::user()->role->type === UserRole::SUPER_ADMIN)  {
            $roles[] = [
                "value" => $super_admin_role->type,
                "label" => $super_admin_role->name,
                'class' => "badge badge-pill badge-$super_admin_role->badge_color"
            ];
        }

        return view('app.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdminCreateRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(AdminCreateRequest $request)
    {
        $role = Role::where('type', $request->input('role'))->first();
        $user = Role::where('type', UserRole::USER)->first()->users()->create($request->only([
            'first_name', 'last_name', 'phone', 'description', 'post_code',
            'city', 'country', 'profession', 'address', 'email'
        ]));

        if($this->can_grant_privileges($user, $role)) {
            $user->role()->associate($role);
            $user->save();
        } else {
            danger_toast_alert("Vous n'avez pas le droit d'éffectuer cette opération");
            return back();
        }

        success_toast_alert("Utitlisateur {$request->input('first_name')} créer avec success");
        return redirect(route('admins.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|Factory|Response|View
     */
    public function show(Request $request, Product $product)
    {
        return view('app.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(Request $request, Product $product)
    {
        return view('app.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Product $product)
    {
        // TODO: store
        return redirect(route('products.edit', compact('product')));
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return Application|Factory|View
     */
    public function destroy(Request $request, Product $product)
    {
        // TODO: delete
        return redirect(route('products.index'));
    }

    /**
     * User can grant required privilege
     *
     * @param User $user
     * @param $role
     * @return bool
     */
    private function can_grant_privileges(User $user, $role) {
        return (
            ($role !== null) &&
            (
                (($role->type === UserRole::SUPER_ADMIN) && $user->can_grant_super_admin_user) ||
                (($role->type === UserRole::ADMIN) && $user->can_grant_admin_user)
            )
        );
    }
}