<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\AdminCreateRequest;
use App\Http\Requests\AdminUpdateRequest;
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
            ->orderBy('updated_at', 'desc')
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
        $roles = $this->user_accessible_roles();

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

        if(!$this->can_grant_privileges($user, $role)) return $this->unauthorizedToast();

        $user->role()->associate($role);
        $user->save();

        success_toast_alert("Administrateur $user->full_name créer avec success");
        log_activity("Administrateur", "Création de l'administrateur $user->full_name");

        return redirect(route('admins.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $admin
     * @return Application|Factory|RedirectResponse|View
     */
    public function show(User $admin)
    {
        if(!$admin->can_show) return $this->unauthorizedToast();

        $logs = $admin
            ->logs()
            ->orderBy('created_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.admins.show', compact('admin', 'logs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $admin
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit(User $admin)
    {
        if(!$admin->can_edit) return $this->unauthorizedToast();

        $roles = $this->user_accessible_roles();

        $role = $admin->role->type;

        return view('app.admins.edit', compact('admin', 'roles', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdminUpdateRequest $request
     * @param User $admin
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(AdminUpdateRequest $request, User $admin)
    {
        if(!$admin->can_edit) return $this->unauthorizedToast();

        $admin->update(
            $request->only([
                'first_name', 'last_name', 'phone', 'description', 'post_code',
                'city', 'country', 'profession', 'address'
            ])
        );

        if($admin->role->type !== $request->input('role')) {
            $role = Role::where('type', $request->input('role'))->first();

            if(!$this->can_grant_privileges($admin, $role)) return $this->unauthorizedToast();

            $admin->role()->associate($role);
            $admin->save();

        }

        success_toast_alert("Administrateur $admin->full_name mis à jour avec success");
        log_activity("Administrateur", "Mise à jour de l'administrateur $admin->full_name");

        return redirect(route('admins.show', compact('admin')));
    }

    /**
     * @param Request $request
     * @param User $admin
     * @return Application|Factory|RedirectResponse|View
     */
    public function destroy(Request $request, User $admin)
    {
        if(!$admin->can_delete) return $this->unauthorizedToast();

        // TODO: delete
        return redirect(route('admins.index'));
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

    /**
     * Get user accessible roles
     *
     * @return array[]
     */
    private function user_accessible_roles() {
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

        return $roles;
    }
}