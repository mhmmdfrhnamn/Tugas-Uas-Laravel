<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest('id')->get();
        return view('admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambahkan Pengguna Baru";
        return view('admin.add_edit_user', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'photo' => 'mimes:png,jpeg,jpg|max:2048'
            ]
            );

            $filePath = public_path('uploads');
            $insert = new User();
            $insert->name = $request->name;
            $insert->email = $request->email;
            $insert->password = bcrypt('password');

            if($request->hasfile('photo')) {
                $file = $request->file('photo');
                $file_name = time() . $file->getClientOriginalName();

                $file->move($filePath, $file_name);
                $insert->photo = $file_name;
            }

            $result = $insert->save();
            Session::flash('success', 'Pegguna Baru Berhasil Ditambahkan');
            return redirect()->route('user.index');
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
