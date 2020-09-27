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
        $admins = User::onlyTrashed()
            ->where(function($query) {
                $query->where('role_id', Role::where('type', UserRole::ADMIN)->first()->id);
                $query->orWhere('role_id', Role::where('type', UserRole::SUPER_ADMIN)->first()->id);
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('archive.admins', compact('admins'));
    }

    /**
     * @param String $admin
     * @return Application|Factory|RedirectResponse|View
     * @throws Exception
     */
    public function restore(String $admin)
    {
        $trashed_admin = User::withTrashed()->whereSlug($admin)->first();
        if(!$trashed_admin->can_restore) return $this->unauthorizedToast();

        $trashed_admin->restore();

        success_toast_alert("Administrateur $trashed_admin->full_name restoré avec success");
        log_activity("Administrateur", "Restoration de l'administrateur $trashed_admin->full_name");

        return redirect(route('archives.admins.index'));
    }
}