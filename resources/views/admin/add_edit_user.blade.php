@extends('layouts.content')
@section('main-content')
<div class="container">
    <div class="col-md-12">
        <div class="form-appl">
            <h3>{{ $title }}</h3>
            <form class="form1" method="post" action="" enctype="multipart/form-data">
                @csrf
                <div class="form-group col-md-12 mb-3">
                    <label for="">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Masukkan Nama" value="">
                </div>

                <div class="form-group col-md-12 mb-3">
                    <label for="">Email</label>
                    <input class="form-control" type="text" name="email" placeholder="Masukkan Email" value="">
                </div>

                <div class="form-group col-md-12 mb-3">
                    <label for="">photo</label>
                    <div class="avatar-upload">
                        <div>
                            <input type='file' id="imageUpload" name="photo" accept=".png, .jpg, .jpeg">
                            <label for="imageUpload"></label>
                        </div>
                    </div>
                </div>

                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="{{ route('user.index') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection