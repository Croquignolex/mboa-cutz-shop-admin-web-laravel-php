<?php

namespace App\Http\Controllers\App;

use App\Enums\Constants;
use App\Enums\ImagePath;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\Base64ImageRequest;
use App\Http\Requests\UserUpdateInfoRequest;
use App\Http\Requests\UserUpdatePasswordRequest;
use Illuminate\Contracts\Foundation\Application;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax')->only(['updateAvatar']);
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('app.profile.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function logs()
    {
        $logs = Auth::user()
            ->logs()
            ->orderBy('updated_at', 'desc')
            ->paginate(Constants::DEFAULT_PAGE_PAGINATION_ITEMS)
            ->onEachSide(Constants::DEFAULT_PAGE_PAGINATION_EACH_SIDE);

        return view('app.profile.logs', compact("logs"));
    }

    /**
     * Update user information
     *
     * @param UserUpdateInfoRequest $request
     * @return RedirectResponse
     */
    public function updateInfo(UserUpdateInfoRequest $request)
    {
        Auth::user()->update($request->all());

        success_toast_alert('Profil mis à jour avec succès');
        log_activity("Profil", "Mise à jour des informations personnelles");

        return back();
    }

    /**
     * Update user password
     *
     * @param UserUpdatePasswordRequest $request
     * @return RedirectResponse
     */
    public function updatePassword(UserUpdatePasswordRequest $request)
    {
        $user = Auth::user();
        $password = $request->input('password');
        $old_password = $request->input('old_password');

        if($old_password === $password) {
            danger_toast_alert('Vous devez choisir un mot de passe different');
            return back();
        }
        else if(!Hash::check($old_password, $user->password)) {
            danger_toast_alert('Ancien mot de passe incorrect');
            return back();
        }

        $user->update(compact('password'));
        success_toast_alert('Mot de passe mis à jour avec succès');
        log_activity("Profil", "Mise à jour du mot de passe");

        return back();
    }

    /**
     * Update user avatar
     *
     * @param Base64ImageRequest $request
     * @return JsonResponse
     */
    public function updateAvatar(Base64ImageRequest $request)
    {
        // Get current user
        $user = Auth::user();

        // Convert base 64 image to normal image for the server and the data base
        $user_avatar_to_save = imageFromBase64AndSave(
            $request->input('base_64_image'),
            $user->avatar,
            $user->avatar_extension,
            ImagePath::USER_DEFAULT_IMAGE_PATH
        );

        // Save image name in database
        $user->update([
            'avatar' => $user_avatar_to_save['name'],
            'avatar_extension' => $user_avatar_to_save['extension'],
        ]);

        log_activity("Profil", "Mise à jour de la photo de profil");
        return response()->json(['message' => 'Photo de profil mise à jour avec succès']);
    }
}