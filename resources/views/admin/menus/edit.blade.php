<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'menus','key'=>'Edit'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <form action="{{route('menus.update', ['id'=>$menuFollowIdEdit->id]) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Tên danh mục</label>
                                <input type="text" name="name" value="{{$menuFollowIdEdit->name}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên danh mục">

                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Danh mục cha</label>
                                <select class="form-select" name="parent_id" aria-label="Default select example">
                                    <option value="0">Chọn danh mục cha</option>
                                    {!! $optionSelect !!}
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


