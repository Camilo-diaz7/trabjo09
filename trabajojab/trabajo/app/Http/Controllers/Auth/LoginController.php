<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirigir según el rol del usuario autenticado.
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if (is_object($user) && $user->is_admin === true) {
            return route('admin.dashboard');
        }
        return '/home';
    }

    /**
     * Cerrar sesión y limpiar sesión actual.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Has cerrado sesión correctamente.');
    }
}
