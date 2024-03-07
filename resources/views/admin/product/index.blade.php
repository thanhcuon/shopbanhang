<!-- resources/views/child.blade.php -->

@extends('layout.admin')

@section('title')
    <title>Product</title>
@endsection

@section('content')

    <div class="content-wrapper">

        @include('partials.content-header', ['name'=>'product','key'=>'List'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <a href="{{route('product.create')}}" class="btn btn-success float-right m-2 ">Add</a>
                    </div>
                    <div class="col-md-11">
                        <table class="table caption-top">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ID</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; ?>
                            @foreach($products as $productItem)
                                <tr>

                                    <td colspan="row">{{$count}}</td>
                                    <td colspan="row">{{$productItem->id}}</td>
                                    <td colspan="row">{{$productItem->name}}</td>
                                    <td colspan="row">{{number_format($productItem->price)." VND"}}</td>
                                    <td colspan="row">
                                        <img src="{{$productItem->feature_image_path}}" alt=" " width="100" height="100">
                                    </td>
                                    <td colspan="row">{{optional($productItem->category)->name }}</td>
                                    <td colspan="row">
                                        <a href="{{route('product.edit',['id'=>$productItem->id])}}" class="btn btn-default">Edit</a>
                                        <a href="" data-url="{{route('product.delete',['id'=>$productItem->id])}}" class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                                    <?php $count++; ?>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-pagination">
                            {{ $products->links('pagination::bootstrap-4') }}
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
                                    'Bạn đã xóa sản phẩm.',
                                    'thành công'
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

