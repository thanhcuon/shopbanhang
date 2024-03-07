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
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>
        </div>
    </div>
@endforeach
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
