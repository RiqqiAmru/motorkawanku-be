<?php

namespace App\Http\Controllers;

use App\Models\Kawasan;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

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
        $kawasan = Kawasan::all();
        // only use id and kawasan field
        $kawasan = $kawasan->pluck('kawasan', 'id');
        return view('users.index', [
            'users' =>  $userWithSession,
            'kawasan' => $kawasan
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
        $validated = $request->validateWithBag('addNewUser', [
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);
        $kawasan = "";
        if ($request->input('role') == 'user') {
            $kawasan = $request->input('kawasan');
        }
        User::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'role' => $request->input('role'),
            'password' => Hash::make("password"),
            'kawasan_id' => $kawasan
        ]);
        return Redirect::to('/users')->with('success', "Berhasil Menambahkan user baru {$validated['nama']}");
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
    public function edit(User $user, Request $request)
    {
        //validate 
        // if the data is same as the previous one 

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, string $id)
    {
        // return nothing if the data is same as the previous one
        $previousData = User::where(['id' => $id])->first();
        if ($previousData?->name) {
            if ($previousData->name == $request->nama && $previousData->email == $request->email && $previousData->role == $request->role && $previousData->kawasan_id == $request->kawasan) {
                return Redirect::to('/users')->with('info', "Nothing Changed ");
            }
            $validated = $request->validateWithBag('editExistingUser', [
                'nama' => 'required|string|max:255',
                'email' => ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore($id)]
            ]);
            $kawasan = "";
            if ($request->input('role') == 'user') {
                $kawasan = $request->input('kawasan');
            }
            // edit user data
            User::where('id', $id)->update([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'role' => $request->role,
                'kawasan_id' => $kawasan,
            ]);
            return Redirect::to('/users')->with('success', "Berhasil Mengubah data user {$request->nama}");
        } else {
            return Redirect::to('/users')->with('error', "User tidak terdaftar di database");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $user = User::find($id);
        if ($user == $request->user()) {
            return Redirect::to('/users')->with('error', "Silahkan hapus user anda di menu profile");
        }
        if ($user) {
            if ($user->role == 'admin') {
                return Redirect::to('/users')->with('error', "Maaf anda tidak dapat mengapus akun admin orang lain");
            }
            $user->update(['is_active' => 0]);
            return Redirect::to('/users')->with('success', "User {$user->name} berhasil dihapus");
        } else {
            return Redirect::to('/users')->with('error', "User tidak terdaftar");
        }
    }
}
