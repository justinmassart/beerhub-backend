<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\User;
use App\Http\Requests\SignUpFormRequest;
use App\Models\Role;
use App\Models\UserPreference;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SignUpFormRequest $request)
    {
        $validated = $request->safe()->only(
            'firstname',
            'lastname',
            'username',
            'email',
            'country',
            'password',
        );


        try {
            if ($validated) {
                $uuid = Str::uuid();
                $roleUuid = Str::uuid();

                $userPref = UserPreference::factory()->create();

                $user = User::create([
                    'id' => $uuid,
                    'firstname' => $validated['firstname'],
                    'lastname' => $validated['lastname'],
                    'username' => $validated['username'],
                    'email' => $validated['email'],
                    'password' => bcrypt($validated['password']),
                    'DOB' => '2000-11-09',
                    'country' => $validated['country'],
                    'user_preferences_id' => $userPref->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                Role::create([
                    'id' => $roleUuid,
                    'access_rights' => 'user',
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                return response()->json(['success' => 'ACCOUNT_CREATED', 'user' => $user->firstname]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
