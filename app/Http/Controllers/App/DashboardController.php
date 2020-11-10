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
            $loopDay = now()->startOfWeek()->addDays($i);

            $data[] = $customers->filter(function ($item) use ($i) {
                //dd($loopDay, $loopDay->endOfDay(), $item->created_at, ($item->created_at->greaterThanOrEqualTo($loopDay)) && ($item->created_at->lessThanOrEqualTo($loopDay->endOfDay())));
                return (
                    ($item->created_at->greaterThanOrEqualTo(now()->startOfWeek()->addDays($i))) &&
                    ($item->created_at->lessThanOrEqualTo(now()->startOfWeek()->addDays($i)->endOfDay()))
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