<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Trang chủ</title>
@endsection
@section('css')

    <link href="{{asset('admin/vendors/select2/select2.min.css')}}" rel="stylesheet" />

    <style>
        .alert-danger{
            margin-top: 10px;
            padding: 3px 5px;
        }

    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
@include('partials.content-header', ['name'=>'category','key'=>'Add'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <form action="{{route('brands.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Tên danh mục</label>
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên danh mục">

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
<!-- Tải thư viện jQuery -->
<script src="{{asset('admin/vendors/select2/jquery-3.6.0.min.js')}}"></script>
<!-- Tải thư viện Select2 -->
<script src="{{asset('admin/vendors/select2/select2.min.js')}}"></script>
<script>

    $(".tags_select_chooses").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })

    $(".select2_init").select2({
        placeholder: "Chọn danh mục",
        allowClear: true
    })

    // $(document)
</script>
@endsection
