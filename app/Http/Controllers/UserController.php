<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\SignUpFormRequest;
use App\Models\Role;

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
            'first_name',
            'last_name',
            'username',
            'email',
            'country',
            'password',
            'confirm_password'
        );

        try {
            if ($validated) {
                $user = User::create([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'username' => $validated['userename'],
                    'email' => $validated['email'],
                    'country' => $validated['country'],
                    'password' => bcrypt($validated['password']),
                ]);

                Role::create([
                    'access_rights' => 'user',
                    'user_id' => $user->id,
                ]);

                return response()->json(['success' => 'ACCOUNT_CREATED', 'user' => [$user->first_name]]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'FAILED_TO_CREATE_USER']);
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
