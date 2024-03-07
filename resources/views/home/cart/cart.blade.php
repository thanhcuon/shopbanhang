@extends('layout.master')


@section('title')
    <title>Giỏ hàng</title>
@endsection
@section('content')



    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($cart as $id => $cartItem)
                        @php
                            $price = isset($cartItem['price']) ? $cartItem['price'] : 0;
                            $quantity = isset($cartItem['quantity']) ? $cartItem['quantity'] : 0;
                            $total += $price * $quantity;
                        @endphp
                        <tr class="cart_item" data-product-id="{{ $id }}">
                            <td class="cart_product">
                                <a href=""><img width="100px" src="{{ isset($cartItem['feature_image_path']) ? $cartItem['feature_image_path'] : '' }}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ isset($cartItem['name']) ? $cartItem['name'] : '' }}</a></h4>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($price)." VND" }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up" href="#" data-product-id="{{ $id }}"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{ $quantity }}" autocomplete="off" size="2">
                                    <a class="cart_quantity_down" href="#" data-product-id="{{ $id }}"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price" data-product-total="{{ $price * $quantity }}">{{ number_format($price * $quantity)." VND" }}</p>
                            </td>

                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="#" data-product-id="{{ $id }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">

                        <ul>
                            <li>Cart Sub Total <span id="cart_total">{{number_format($total)." VND"}}</span></li>
                            <li>Total Quantity. <span id="total_quantity">{{ isset($quantity) ? $quantity : 0 }}</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span id="cart_total1">{{number_format($total)." VND"}}</span></li>
                        </ul>

                        <a class="btn btn-default update" href="">Update</a>
                            <a class="btn btn-default check_out" href="{{route('showCheckOut')}}">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Định nghĩa hàm number_format để định dạng số tiền
        function number_format(number) {
            return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }

        $(document).ready(function () {
            // Hàm cập nhật tổng giá tiền
            function updateTotalPrice() {
                var total = 0;
                var totalQuantity = 0; // Biến để theo dõi tổng số lượng sản phẩm

                $(".cart_item").each(function () {
                    var quantity = parseInt($(this).find(".cart_quantity_input").val());
                    var pricePerItem = parseFloat($(this).find(".cart_total_price").data("product-total"));
                    var itemTotal = quantity * pricePerItem;
                    total += itemTotal;
                    totalQuantity += quantity; // Cộng thêm số lượng sản phẩm vào tổng số lượng
                    $(this).find(".cart_total_price").text(number_format(itemTotal) + " VND");
                });

                $("#cart_total").text(number_format(total) + " VND");

                $("#cart_total1").text(number_format(total) + " VND");

                // Cập nhật tổng số lượng sản phẩm vào thẻ HTML
                $("#total_quantity").text(totalQuantity);
            }

            // Gọi hàm để tính toán và hiển thị tổng giá tiền và tổng số lượng sản phẩm ban đầu
            updateTotalPrice();

            $(".cart_quantity_up, .cart_quantity_down").click(function (e) {
                e.preventDefault();

                var productId = $(this).data('product-id');
                var quantityInput = $(this).siblings(".cart_quantity_input");
                var quantity = parseInt(quantityInput.val());
                var $this = $(this);
                if ($this.hasClass("cart_quantity_up")) {
                    quantity += 1;
                } else {
                    if (quantity > 1) {
                        quantity -= 1;
                    }
                }

                // Gửi yêu cầu AJAX để cập nhật giỏ hàng
                $.ajax({
                    type: "POST",
                    url: "/products/update-cart",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: productId,
                        quantity: quantity,
                    },
                    success: function (data) {
                        if (data.code === 200) {
                            // Cập nhật số lượng trên trang mà không cần tải lại
                            quantityInput.val(quantity);

                            // Tính toán tổng giá tiền mới cho sản phẩm và cập nhật nó
                            var pricePerItem = parseFloat($this.closest("tr").find(".cart_total_price").data("product-total"));
                            var newTotal = pricePerItem * quantity;
                            $this.closest("tr").find(".cart_total_price").text(number_format(newTotal) + " VND");

                            // Cập nhật tổng giá tiền của giỏ hàng và tổng số lượng sản phẩm
                            updateTotalPrice();
                        } else {
                            alert("Cập nhật giỏ hàng thất bại.");
                        }
                    },
                    error: function () {
                        alert("Đã xảy ra lỗi khi cập nhật giỏ hàng.");
                    },
                });
            });

            // Xử lý sự kiện khi số lượng sản phẩm thay đổi (input)
            $(".cart_quantity_input").on("input", function () {
                var productId = $(this).closest("td.cart_quantity").find(".cart_quantity_up, .cart_quantity_down").data("product-id");
                var quantity = parseInt($(this).val());
                var $this = $(this); // Lưu lại $(this) trong biến tạm thời

                // Gửi yêu cầu AJAX để cập nhật giỏ hàng khi số lượng thay đổi
                $.ajax({
                    type: "POST",
                    url: "/products/update-cart",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: productId,
                        quantity: quantity,
                    },
                    success: function (data) {
                        if (data.code === 200) {
                            // Tính toán tổng giá tiền mới cho sản phẩm và cập nhật nó
                            var pricePerItem = parseFloat($this.closest("tr").find(".cart_total_price").data("product-total"));
                            var newTotal = pricePerItem * quantity;
                            $this.closest("tr").find(".cart_total_price").text(number_format(newTotal) + " VND");

                            // Cập nhật tổng giá tiền của giỏ hàng và tổng số lượng sản phẩm
                            updateTotalPrice();
                        } else {
                            alert("Cập nhật giỏ hàng thất bại.");
                        }
                    },
                    error: function () {
                        alert("Đã xảy ra lỗi khi cập nhật giỏ hàng.");
                    },
                });
            });
        });
    </script>


    <script>
        // Xử lý sự kiện khi người dùng nhấp vào nút xóa sản phẩm
        $(".cart_quantity_delete").click(function (e) {
            e.preventDefault();

            var productId = $(this).data('product-id');
            var rowElement = $(this).closest("tr"); // Lấy phần tử tr chứa sản phẩm

            // Gửi yêu cầu AJAX để xóa sản phẩm khỏi giỏ hàng
            $.ajax({
                type: "POST",
                url: "/products/delete-cart",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productId,
                },
                success: function (data) {
                    if (data.code === 200) {
                        // Xóa sản phẩm khỏi giao diện người dùng (dựa vào rowElement)
                        rowElement.remove();

                        // Cập nhật tổng giá tiền và tổng số lượng sản phẩm
                        updateTotalPrice();
                    } else {
                        alert("Xóa sản phẩm khỏi giỏ hàng thất bại.");
                    }
                },
                error: function () {
                    alert("Đã xảy ra lỗi khi xóa sản phẩm khỏi giỏ hàng.");
                },
            });
        });
    </script>


@endsection

