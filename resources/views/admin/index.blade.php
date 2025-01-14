@extends('layouts.content')
@section('main-content')
<div class="container">
    <h2>
        Unggah Foto 
    </h2>

    <div class="text-end mb-5">
        <a href="{{route('user.create')}}" class="btn btn-primary">Tambahkan Pegguna Baru</a>
    </div>
    @if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-primary">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse ($users as $index => $row)
                    <tr>
                        <td>1</td>
                        <td>Muhammad Farhan Amien</td>
                        <td>farhan@gmail.com</td>
                        <td>photo</td>
                        <td>
                            <a href="" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Pegguna Tidak Ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection