<?php

namespace App\Http\Controllers\App;

use App\Enums\UserRole;
use App\Models\Role;
use App\Models\User;
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

        $current = [];
        $previous = [];
        $value = $customers->count();

        for($i = 0; $i < 7; $i++)
        {
            $currentLoopDay = now()->startOfWeek()->addDays($i);
            $previousLoopDay = now()->subDays(7)->startOfWeek()->addDays($i);
            $current[] = count($customers->whereBetween('created_at', [$currentLoopDay, $currentLoopDay->endOfDay()])->all());
            $previous[] = count($customers->whereBetween('created_at', [$previousLoopDay, $previousLoopDay->endOfDay()])->all());
        }

        $data = compact('previous', 'current');
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