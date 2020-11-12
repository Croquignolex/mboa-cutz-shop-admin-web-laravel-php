<?php

namespace App\Http\Controllers\App;

use App\Models\Role;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax')->only(['timezoneAjax', 'registerCustomer']);
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('app.dashboard');
    }

    /**
     * @return JsonResponse
     */
    public function registerCustomer()
    {
        $customers = User::where('role_id', Role::where('type', UserRole::USER)->first()->id)->get();

        $data = [];
        $value = $customers->count();

        for($i = 0; $i < 7; $i++)
        {
            $data[] = $customers->filter(function ($item) use ($i) {

                $timezone_creation_date = $item->created_at->setTimezone(session('timezone'));
                $timezone_min_date = now()->setTimezone(session('timezone'))->startOfWeek()->addDays($i);
                $timezone_max_date = now()->setTimezone(session('timezone'))->startOfWeek()->addDays($i)->endOfDay();

                return (
                    $timezone_creation_date->greaterThanOrEqualTo($timezone_min_date) &&
                    $timezone_creation_date->lessThanOrEqualTo($timezone_max_date)
                );

            })->count();
        }

        return response()->json(compact('value', 'data'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function timezoneAjax(Request $request)
    {
        session(['timezone' => $request->input('timezone')]);
        return response()->json();
    }
}