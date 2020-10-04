<?php

namespace App\Http\Controllers\Archive;

use App\Models\Tag;
use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Enums\UserRole;
use App\Models\Category;
use Illuminate\View\View;
use App\Models\Testimonial;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ArchiveController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $admins = User::onlyTrashed()
            ->where(function($query) {
                $query->where('role_id', Role::where('type', UserRole::ADMIN)->first()->id);
                $query->orWhere('role_id', Role::where('type', UserRole::SUPER_ADMIN)->first()->id);
            })
            ->count();

        $tags = Tag::onlyTrashed()->count();

        $products = Product::onlyTrashed()->count();

        $categories = Category::onlyTrashed()->count();

        $testimonials = Testimonial::onlyTrashed()->count();

        return view('archive.index', compact(
            'admins', 'categories', 'tags', 'testimonials', 'products'
            )
        );
    }
}