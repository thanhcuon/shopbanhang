<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Slider List</title>
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'Silder', 'key'=>'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <a href="{{route('slider.create')}}" class="btn btn-success float-right m-2 ">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table caption-top">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ID</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Description</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; ?>

                            @foreach($sliders as $slider)
                                <tr>
                                    <td>{{$count}}</td>
                                    <th scope="row">{{$slider->id}}</th>
                                    <td colspan="row">{{$slider->name}}</td>
                                    <td colspan="row">{{$slider->description}}</td>
                                    <td colspan="row">
                                        <img src="{{$slider->image_path}}" alt=" " width="100" height="100">
                                    </td>
                                    <td>
                                        <a href="{{route('slider.edit',['id'=>$slider->id])}}" class="btn btn-default">Edit</a>
                                        <a href="" data-url="{{route('slider.delete',['id'=>$slider->id])}}" class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                                    <?php $count++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-pagination">
                            {{ $sliders->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


@endsection

@section('js')
    <script src="{{asset('admin/vendors/select2/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('admin/vendors/SweetAlert/sweetalert2@11.js')}}"></script>

    <script>

        function actionDelete(event){
            event.preventDefault();
            let urlRequest = $(this).data('url');
            let that =$(this);
            Swal.fire({
                title: 'Bạn có chắc?',
                text: "Muốn xóa sản phẩm này không!",
                icon: 'Cảnh Báo',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: urlRequest,
                        success: function (data){
                            if (data.code == 200){
                                that.parent().parent().remove();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        },
                        error: function () {

                        }
                    });


                }
            })
        }
        $(function (){
            $(document).on('click','.action_delete', actionDelete);
        })
    </script>
@endsection
