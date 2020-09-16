<?php

namespace App\Http\Controllers\App;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ProfileController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('app.profile');
    }
}