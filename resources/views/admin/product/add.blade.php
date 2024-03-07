<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Add Product</title>
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
        @include('partials.content-header', ['name'=>'product','key'=>'Add'])
{{--        <div class="col-md-12">--}}
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        </div>--}}
            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" value="{{ old('name')}}"  class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label  class="form-label " >Giá sản phẩm</label>
                                <input type="text" name="price" value="{{ old('price')}}" class="form-control @error('price') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập giá sản phẩm">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Hình ảnh dại diện</label>
                                <input type="file" name="feature_image_path" class="form-control-file" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="chọn hình ảnh sản phẩm">

                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Hình ảnh chi tiết</label>
                                <input type="file" name="image_path[]" multiple class="form-control-file" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="chọn hình ảnh sản phẩm">

                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Danh mục</label>
                                <select class="form-control select2_init  @error('category_id') is-invalid @enderror" value="{{ old('category_id')}}" name="category_id" aria-label="Default select example" multiple>
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>

                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  class="form-label">Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_chooses" multiple="multiple">

                                </select>


                            </div>





                    </div>
                    <div class="col-md-12">
                            <div class="form-floating">
                            <label for="floatingTextarea2">Content</label>
                            <textarea  class="form-control tinymce_editor_init @error('contents') is-invalid @enderror" name="contents" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 500px">{{ old('contents')}}</textarea>
                            @error('contents')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
        </form>
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('js')
    <!-- Tải thư viện jQuery -->
    <script src="{{asset('admin/vendors/select2/jquery-3.6.0.min.js')}}"></script>
    <!-- Tải thư viện Select2 -->
    <script src="{{asset('admin/vendors/select2/select2.min.js')}}"></script>
    <!-- Mã JavaScript -->
    <script src="https://cdn.tiny.cloud/1/p8mp6kvvjfs991a7ax9bp0gn2b61vtpbuobbcfuoq1yek5bj/tinymce/5/tinymce.min.js"></script>
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
    <script>
        let editor_config = {
            path_absolute : "/",
            selector: 'textarea.tinymce_editor_init',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback : function(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                let cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection

