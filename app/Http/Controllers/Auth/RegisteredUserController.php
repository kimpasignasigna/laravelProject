<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'skill' => ['required', 'string', 'max:255'],
            'skill2' => ['required', 'string', 'max:255'],
            'skill3' => ['required', 'string', 'max:255'],
            'skill4' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'mimes:jpeg,jpg,png'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'skill' => $request->skill,
            'skill2' => $request->skill2,
            'skill3' => $request->skill3,
            'skill4' => $request->skill4,
        ]);

                // Handle the file upload for logo
                if ($request->hasFile('logo')) {
                    $file = $request->file('logo');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('logos'), $filename); // Store in public/logos folder
                    $user->logo = 'logos/' . $filename; // Save the relative path to the logo
                }
        
                // Save the user record with the uploaded logo
            $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
