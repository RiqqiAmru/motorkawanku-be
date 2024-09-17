<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userWithSession = User::with('session')->get()->where('is_active', '1'); // Mengambil semua User beserta relasi Session
        $userWithSession->transform(function ($user) {
            $user->last_activity = $user->session ? date('d M Y , H:i', $user->session->last_activity) : 'user belum pernah login'; // Menambahkan kolom last_activity ke User
            unset($user->session);
            return $user;
        });
        return view('users.index', [
            'users' =>  $userWithSession
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // save data to database

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // set user to inactive
        User::where('id', $user->id)->update([
            'is_active' => 0
        ]);
    }
}
