<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>User Edit</title>
@endsection
@section('css')

    <link href="{{asset('admin/vendors/select2/select2.min.css')}}" rel="stylesheet" />

    <style>
        .alert-danger{
            margin-top: 10px;
            padding: 3px 5px;
        }

    </style>
    <style>
       .select2-selection__choice{
           background: #0c84ff!important;

       }

    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'User','key'=>'Edit'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <form action="{{route('users.update', ['id'=>$user->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Name</label>
                                <input type="text" value="{{ $user->name}}"
                                       name="name" class="form-control"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="Nhập tên ">

                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Email</label>
                                <input type="text" value="{{ $user->email}}"
                                       name="email" class="form-control"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="Nhập tên email">

                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Passwords</label>
                                <input type="password"
                                       name="password" class="form-control"
                                       id="exampleInputEmail1"
                                       aria-describedby="emailHelp"
                                       placeholder="Nhập passwords">

                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Chọn vai Trò</label>
                                <select class="form-control select2_init" name="role_id[]" multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)

                                    <option
                                        {{$rolesOfUser->contains('id', $role->id) ? 'selected' : ''}}
                                            value="{{$role->id}}">{{$role->name}}
                                    </option>
                                    @endforeach
                                </select>


                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

@section('js')
    <script src="{{asset('admin/vendors/select2/jquery-3.6.0.min.js')}}"></script>
    <!-- Tải thư viện Select2 -->
    <script src="{{asset('admin/vendors/select2/select2.min.js')}}"></script>
    <!-- Mã JavaScript -->
    <script src="https://cdn.tiny.cloud/1/p8mp6kvvjfs991a7ax9bp0gn2b61vtpbuobbcfuoq1yek5bj/tinymce/5/tinymce.min.js"></script>
    <script>


        $(".select2_init").select2({
            placeholder: "Chọn vai trò",
            allowClear: true
        })

        // $(document)
    </script>
@endsection
