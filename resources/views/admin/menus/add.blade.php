<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'menus','key'=>'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <form action="{{route('menus.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Tên Menus</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên menus">

                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Menus cha</label>
                                <select class="form-select" name="parent_id" aria-label="Default select example">
                                    <option value="0">Chọn menus cha</option>
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


