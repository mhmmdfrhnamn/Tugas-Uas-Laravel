<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

            if($request->hasFile('photo')) {
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
    public function edit($id)
    {
        $title = "Edit Data";
        $edit = User::findOrFail($id);
        return view('admin.add_edit_user', compact('edit','title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name'=> 'required',
                'email'=> 'required|email|unique:users,email,' . $id,
                'photo' => 'mimes:png,jpeg,jpg|max:2048',
            ]
            );
            $update = User::findOrFail($id);
            $update -> name = $request->name;
            $update->email = $request->email;
            if ($request->hasFile('photo')) {
                $filePath = public_path('uploads');
                $file = $request->file('photo');
                $file_name = time() . $file->getClientOriginalName();
                $file->move($filePath,$file_name);
                // hapus foto lama
                if (!is_null($update->photo)) {
                    $oldImage = public_path('uploads/' . $update->photo);
                    if (File::exists($oldImage)) {
                        unlink($oldImage);
                    }
                }
                $update->photo = $file_name;
            }
            $result = $update->save();
            Session::flash('success', 'Update Data Pegguna Berhasil');
            return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $userData = User::findOrFail($request->user_id);
        $userData->delete();
        // delete photot if exists
        if (!is_null($userData->photo)) {
            $photo = public_path('uploads/' . $userData->photo);
            if (File::exists($photo)) {
                unlink($photo);
            }
        }
        Session::flash('success','Menghapus Pegguna Sukses');
        return redirect()->route('user.index');
    }
}
