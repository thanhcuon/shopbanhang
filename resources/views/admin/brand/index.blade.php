<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Trang chủ</title>
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'brand','key'=>'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <a href="{{route('brands.create')}}" class="btn btn-success float-right m-2 ">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table caption-top">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ID</th>
                                <th scope="col">Tên thương hiệu</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; ?>
                            @foreach($brands as $brand)
                            <tr>
                                <td>{{$count}}</td>
                                <th scope="row">{{$brand->id}}</th>
                                <td colspan="row">{{$brand->name}}</td>
                                <td colspan="row">{{optional($brand->category)->name }}</td>
                                <td>
                                    <a href="{{route('brands.edit',['id'=>$brand->id])}}" class="btn btn-default">Edit</a>
                                    <a href="" data-url="{{route('brands.delete',['id'=>$brand->id])}}" class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                                <?php $count++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-pagination">
                            {{ $brands->links('pagination::bootstrap-4') }}
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

