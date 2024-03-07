@extends('layout.master')


@section('title')
    <title>Danh sách sản phẩm</title>
@endsection
@section('content')





{{--    <section id="advertisement">--}}
{{--        <div class="container">--}}
{{--            <img src="{{asset('frontend/images/shop/advertisement.jpg')}}" alt="" />--}}
{{--        </div>--}}
{{--    </section>--}}

    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @foreach($products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{$product->feature_image_path}}" alt="" />
                                        <h2>{{number_format($product->price)." VND"}}</h2>
                                        <div class="row">
                                            <a href="{{route('product.view', ['id'=>$product->id])}}" style="color: #0a0e14">{{$product->name}}
                                            </a>
                                        </div>
                                        <a href="#" data-url="{{route('addToCart',['id'=>$product->id])}}"
                                           class="btn btn-default add-to-cart Add_To_Cart">
                                            <i class="fa fa-shopping-cart">
                                            </i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>{{number_format($product->price)." VND"}}</h2>
                                            <div class="row">
                                                <a href="{{route('product.view', ['id'=>$product->id])}}" style="color: #0a0e14">{{$product->name}}
                                                </a>
                                            </div>
                                            <a href="#" data-url="{{route('addToCart',['id'=>$product->id])}}"
                                               class="btn btn-default add-to-cart Add_To_Cart">
                                                <i class="fa fa-shopping-cart">
                                                </i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <ul class="pagination">
                            {{ $products->links('pagination::bootstrap-4') }}

                        </ul>
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function addToCart(event) {
        event.preventDefault();
        let urlCart = $(this).data('url');
        $.ajax({
            type: "GET",
            url: urlCart,
            dataType: 'json',
            success: function (data) {
                if(data.code == 200){
                    alert('thêm sản phẩm vào giỏ hàng thành công')
                }
            },
            error: function () {

                alert('Bạn cần đăng ký hoặc đăng nhập để thêm sản phẩm vào giỏ hàng')

            }
        });
    }
    $(function () {
        $('.Add_To_Cart').on('click', addToCart); // Chỉ định lớp CSS '.add_to_cart' cho sự kiện click
    });
</script>



@endsection

