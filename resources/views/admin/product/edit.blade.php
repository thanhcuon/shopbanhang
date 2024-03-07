<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Add Product</title>
@endsection

@section('css')
    <link href="{{asset('admin/vendors/select2/select2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @include('partials.content-header', ['name'=>'product','key'=>'Edit'])
        <form action="{{route('product.update', ['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            @csrf
                            <div class="mb-3">
                                <label  class="form-label">Tên sản phẩm</label>
                                <input type="text" value="{{$product->name}}" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập tên sản phẩm">

                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Giá sản phẩm</label>
                                <input type="text" value="{{$product->price}}" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nhập giá sản phẩm">

                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Hình ảnh dại diện</label>
                                <input type="file" name="feature_image_path" class="form-control-file" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="chọn hình ảnh sản phẩm">

                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <img src="{{$product->feature_image_path}}" alt="" width="100" height="100">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Hình ảnh chi tiết</label>
                                <input type="file" name="image_path[]" multiple class="form-control-file" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="chọn hình ảnh sản phẩm">

                            </div>
                            <div class="col-md-12">

                                <div class="row" style="white-space: nowrap; overflow-x: auto; flex-wrap: nowrap; padding: 0; margin: 0;">
                                    @foreach($product->productImages as $productImageItem)
                                        <div class="col-md-3" style="display: inline-block;">
                                            <img src="{{ $productImageItem->image_path }}" alt="" width="100" height="100">
                                        </div>
                                    @endforeach
                                </div>


                            </div>

                            <div class="mb-3">
                                <label  class="form-label">Danh mục</label>
                                <select class="form-control select2_init" name="category_id" aria-label="Default select example">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>


                            </div>
                            <div class="form-group">
                                <label  class="form-label">Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_chooses" multiple="multiple">
                                        @foreach($product->tags as $tagItem)
                                    <option value="{{$tagItem->name}}" selected>
                                        {{$tagItem->name}}
                                        </option>
                                    @endforeach
                                </select>


                            </div>





                        </div>
                        <div class="col-md-12">
                            <div class="form-floating">
                                <label for="floatingTextarea2">Content</label>
                                <textarea class="form-control tinymce_editor_init" name="contents" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 500px">{{$product->content}}</textarea>

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

