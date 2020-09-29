<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Return unauthorized toast message
     *
     * @return RedirectResponse
     */
    protected function unauthorizedToast() {
        warning_toast_alert("vous n'êtes pas authorisés à éffectuer cette action");
        return back();
    }
}
