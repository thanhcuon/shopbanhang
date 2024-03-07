<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Roles Add</title>
@endsection
@section('css')

    <link href="{{asset('admin/vendors/select2/select2.min.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('admin/vendors/css_js/css/role.index.css')}}">
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'Roles','key'=>'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data"  style="width: 100%;">
                    <div class="col-md-12">

                            @csrf
                            <div class="col-mb-3">
                                <label  class="form-label">Tên vai trò</label>
                                <input type="text" value="{{ old('name')}}" name="name" class="form-control"  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên Slider">

                            </div>
                            <div class="mb-12">
                                <label  class="form-label">Nhập mô tả</label>
                                <textarea type="text"  class="form-control tinymce_editor_init " name="display_name" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" >{{ old('display_name')}}</textarea>


                            </div>




                    </div>
                        <div class="col-md-12" style="margin-top: 20px">
                            <div class="row">

                                <div class="col-md-12">
                                    <label class="container">
                                        <input type="checkbox" value="" class="checkall">
                                        <div class="module">
                                            Check All
                                        </div>
                                        <div class="checkmark"></div>
                                    </label>
                                </div>
                                @foreach($permissionsParent as $permissionsParentItem)
                                <div class="card border-primary mb-3 col-md-12" style="width: 100%;">
                                    <div class="card-header">
                                        <label class="container">
                                            <input type="checkbox" value="" class="checkbox_wrapper">
                                            <div class="module">
                                                module {{$permissionsParentItem->name}}
                                            </div>
                                            <div class="checkmark"></div>
                                        </label>


                                    </div>
                                    <div class="row">
                                        @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)

                                            <div class="card-body text-primary col-md-3">
                                                <h5 class="card-title"></h5>
                                                <label class="container">
                                                    <input type="checkbox"
                                                           class="checkbox_childrent"
                                                           name="permission_id[]"
                                                           value="{{$permissionsChildrentItem->id}}">
                                                    <div class="module">{{$permissionsChildrentItem->name}}</div>
                                                    <div class="checkmark"></div>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px; margin-left: 10px">Submit</button>

                    </form>

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
        $('.checkbox_wrapper').on('click',function (){
            $(this).parents('.card').find('.checkbox_childrent').prop('checked',$(this).prop('checked'));
        });
        $('.checkall').on('click',function (){
            $(this).parents().find('.checkbox_childrent').prop('checked',$(this).prop('checked'));
        });
    </script>

@endsection
