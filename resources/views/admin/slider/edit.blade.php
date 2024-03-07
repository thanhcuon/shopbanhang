<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Slider Add</title>
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
        @include('partials.content-header', ['name'=>'Slider','key'=>'Edit'])

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <form action="{{route('slider.update', ['id'=>$slider->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Tên Slider</label>
                                <input type="text" value="{{ $slider->name}}" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên Slider">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Nhập mô tả</label>
                                {{--                                <input type="text" name="description" value="{{ old('description')}}" class="form-control @error('description') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập mô tả">--}}
                                <textarea type="text"  class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 500px">{{ $slider->description}}</textarea>

                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label  class="form-label">Hình ảnh slider</label>
                                <input type="file" name="image_path"  value="{{ old('image_path')}}" class="form-control-file @error('image_path') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="chọn hình ảnh sản phẩm">
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <img src="{{ $slider->image_path}}" alt="" width="100" height="100">
                            </div>


                            <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Submit</button>
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
