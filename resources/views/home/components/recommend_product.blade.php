<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="productContainer">

                @foreach($productsRecommend as $keyRecommend => $productsRecommendItem)
                @if($keyRecommend % 3 == 0)
            <div class="item {{$keyRecommend == 0 ? 'active' : ''}}">
                @endif
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{$productsRecommendItem->feature_image_path}}" alt="" />
                                <h2>{{number_format($productsRecommendItem->price)." VND"}}</h2>
                                <div class="row">
                                    <a href="{{route('product.view', ['id'=>$productsRecommendItem->id])}}" style="color: #0a0e14">{{$productsRecommendItem->name}}
                                    </a>
                                </div>

                                <a href="#" data-url="{{route('addToCart',['id'=>$productsRecommendItem->id])}}"
                                   class="btn btn-default add-to-cart Add_To_Cart">
                                    <i class="fa fa-shopping-cart">
                                    </i>Add to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
                @if($keyRecommend % 3 == 2)
            </div>
                @endif
                @endforeach
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div><!--/recommended_items-->
{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        var $carousel = $("#recommended-item-carousel");--}}
{{--        var $items = $carousel.find(".carousel-inner .item");--}}
{{--        var itemCount = $items.length;--}}
{{--        var currentIndex = 0;--}}

{{--        $carousel.carousel();--}}

{{--        $carousel.on("slid.bs.carousel", function () {--}}
{{--            currentIndex = $carousel.find(".carousel-inner .item.active").index();--}}

{{--            if (currentIndex === itemCount - 1) {--}}
{{--                // Nếu đang ở trang cuối cùng, chuyển đến trang đầu tiên--}}
{{--                $carousel.carousel(0);--}}
{{--            }--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
