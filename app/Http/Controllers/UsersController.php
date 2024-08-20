<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // fetch user model with session 


        $usersWithLastSession = User::with(['session' => function ($query) {
            $query->select('user_id', 'last_activity') // Memilih kolom yang diperlukan dari Session
                ->latest() // Mengurutkan berdasarkan timestamp terakhir
                ->first();  // Mengambil session terakhir
        }])
            ->get();
        $usersWithLastSession->transform(function ($user) {
            $user->last_activity = $user->session ? date('d M Y , H:i', $user->session->last_activity) : 'user belum pernah login'; // Menambahkan kolom last_activity ke User
            unset($user->session);
            return $user;
        });

        return view('users.index', [
            'users' =>  $usersWithLastSession
        ]);
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
    public function destroy(User $user)
    {
        //
    }
}
