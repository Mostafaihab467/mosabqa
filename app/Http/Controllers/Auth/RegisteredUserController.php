<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\ValidNidRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Laratrust\Models\Role;

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
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['nullable', Rules\Password::defaults()],
            // nid unique, length 14, numeric
            'nid' => ['required', 'unique:'.User::class, 'digits:14', 'numeric', new ValidNidRule()],
            'category_id' => 'required|exists:categories,id',
            'school' => 'nullable|exists:schools,id',
            'school_name' => 'nullable|required_if:school,other|string|max:255',
        ]);

        // birth_date
        $birthDate = getBirthDate($request->nid);

        // gender
        $gender = getGender($request->nid);

        if (isset($request->school_name) && $request->school_name) {
            $checkSchool = School::where('name', $request->school_name)->first();
            if ($checkSchool) {
                $school = $checkSchool;
            } else {
                $school = School::create([
                    'name' => $request->school_name,
                ]);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'category_id' => $request->category_id ?? null,
            'email' => $request->email ?? $request->nid.'@'.env('APP_DOMAIN', 'mgahed.com'),
            'password' => $request->password ? Hash::make($request->password) : Hash::make($request->nid),
            'nid' => $request->nid,
            'birth_date' => $birthDate,
            'gender' => $gender,
            'school_id' => isset($request->school) && !is_null($request->school) && $request->school != 'other' ? $request->school : ($school->id ?? null),
            'degree' => $request->degree ?? null,
            'email_verified_at' => now(),
        ]);

        $studentRole = Role::where('name', 'student')->first();
        $user->addRole($studentRole);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
