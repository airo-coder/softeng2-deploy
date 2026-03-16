<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthorizationController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Password bypass removed for security

        if (Auth::check() || Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to role-specific landing page
            $role = Auth::user()->role;
            return match ($role) {
                'cashier'           => redirect()->route('pos'),
                'kitchen_manager'   => redirect()->route('kp'),
                'inventory_manager' => redirect()->route('im'),
                default             => redirect()->route('reports.dashboard'),
            };
        }
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }
}