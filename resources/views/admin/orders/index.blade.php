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
                        <a href="" class="btn btn-success float-right m-2 ">Add</a>
                    </div>
                    <div class="col-md-11">
                        <table class="table caption-top">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">ID</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Tên Khách hàng</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        @if ($order->orderItems->isNotEmpty() && $order->orderItems[0]->product && $order->orderItems[0]->product->name)
                                            {{ $order->orderItems[0]->product->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    @if($order->customerAddress)
                                        <td>{{ $order->customerAddress->fullname }}</td>
                                    @else
                                        <td>N/A</td> {{-- Hoặc hiển thị thông báo khác nếu không có địa chỉ khách hàng --}}
                                    @endif

                                    @if($order->customerAddress)
                                        <td>{{ $order->customerAddress->address }}</td>
                                    @else
                                        <td>N/A</td> {{-- Hoặc hiển thị thông báo khác nếu không có địa chỉ khách hàng --}}
                                    @endif
                                    @if($order->customerAddress)
                                        <td>{{ $order->customerAddress->phone_number }}</td>
                                    @else
                                        <td>N/A</td> {{-- Hoặc hiển thị thông báo khác nếu không có địa chỉ khách hàng --}}
                                    @endif
                                    {{-- Thay 'customer_address' bằng tên relation phù hợp --}}
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        @if ($order->orderItems->isNotEmpty() && $order->orderItems[0]->product)
                                            <img src="{{ $order->orderItems[0]->product->feature_image_path ?? 'path_to_default_image.jpg' }}" alt="" width="100">
                                        @else
                                            <img src="path_to_default_image.jpg" alt="" width="100">
                                        @endif
                                    </td>


                                    @php
                                        $totalQuantity = 0; // Khởi tạo biến tổng số lượng
                                    @endphp

                                    @foreach ($order->orderItems as $orderItem)
                                        @php
                                            $totalQuantity += $orderItem->quantity; // Cộng số lượng vào biến tổng
                                        @endphp
                                    @endforeach

                                    <td>{{ $totalQuantity }}</td>
                                    <td data-order-id="{{ $order->id }}">{{ $order->status }}</td>
                                    <td>
                                        @if ($order->status != 'đã duyệt')
                                            <a href="#" class="btn btn-default" id="approveButton{{ $order->id }}" onclick="approveOrder({{ $order->id }})">Duyệt đơn hàng</a>
                                        @endif
                                        <a href="#" data-url="{{ route('orders.delete', ['id' => $order->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="custom-pagination">
{{--                            {{ $products->links('pagination::bootstrap-4') }}--}}
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

    <script>
        $(document).ready(function() {
            @foreach($orders as $order)
            @if ($order->status == 'đã duyệt')
            $("#approveButton{{ $order->id }}").hide();
            @endif
            @endforeach
        });

        function approveOrder(orderId) {
            // Ẩn nút "Duyệt đơn hàng" sau khi nhấn
            var approveButton = $("#approveButton" + orderId);
            approveButton.hide();

            $.ajax({
                method: "GET",
                url: "{{ route('orders.approve', ['id' => ':orderId']) }}".replace(':orderId', orderId),
                success: function(data) {
                    if (data.success) {
                        alert("Đơn hàng đã được duyệt.");

                        // Cập nhật giá trị hiển thị của cột "Trạng thái" thành "đã duyệt"
                        var statusTd = $("td[data-order-id='" + orderId + "']");
                        statusTd.text('đã duyệt');

                        // Thực hiện các hành động khác sau khi duyệt đơn hàng thành công
                    } else {
                        alert("Duyệt đơn hàng thất bại.");
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText);
                    alert("Đã xảy ra lỗi.");
                }
            });
        }
    </script>

@endsection

