<?php

namespace App\Http\Controllers\App;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\UserUpdateProfileRequest;
use Illuminate\Contracts\Foundation\Application;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
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
        return view('app.profile');
    }

    /**
     * @param UserUpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function updateInfo(UserUpdateProfileRequest $request)
    {
        Auth::user()->update($request->only([
            'first_name', 'last_name', 'phone', 'description',
            'post_code', 'city', 'country', 'profession', 'address',
        ]));
        success_toast_alert('Profil mis à jour avec succès');
        return back();
    }
}