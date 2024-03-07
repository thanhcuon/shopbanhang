@extends('layout.master')


@section('title')
    <title>Chi tiết sản Phẩm</title>
@endsection

@section('content')


    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="{{ asset($product->feature_image_path) }}" alt="{{ $product->name }}" />
                                <h3>ZOOM</h3>
                            </div>
                            <div id="similar-product" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                @include('home.product.product.product_view_1.product_slider')


                                <!-- Controls -->
                                <a class="left item-control" href="#similar-product" data-slide="prev">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                                <a class="right item-control" href="#similar-product" data-slide="next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>

                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <img src="{{asset('frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                                <h2>{{ $product->name }}</h2>
                                <p>Web ID: {{ $product->id }}</p>
                                <img src="{{asset('frontend/images/product-details/rating.png')}}" alt="" />
                                <span>
									<span>{{number_format($product->price)." VND"}}</span>
									<label>Quantity:</label>
									<input type="number" id="quantity" value="1" min="1" />
                                    <a href="#" class="btn btn-fefault cart" onclick="addToCart({{ $product->id }})">
                                      <i class="fa fa-shopping-cart"></i>
                                      Add to cart
                                    </a>
								</span>
                                <p><b>Availability:</b> In Stock</p>
                                <p><b>Condition:</b> New</p>
                                <p><b>Brand:</b> E-SHOPPER</p>
                                <a href=""><img src="{{asset('frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
                            </div><!--/product-information-->
                        </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">

                                <li><a href="#tag" data-toggle="tab">Tag</a></li>
                                <li class="active"><a href="#reviews" data-toggle="tab">Chi tiết mô tả</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">




                            <div class="tab-pane fade" id="tag" >
                                @foreach($relatedProducts as $relatedProduct)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ $relatedProduct->feature_image_path }}" alt="{{ $relatedProduct->name }}" />
                                                <h2>{{number_format($relatedProduct->price)." VND"}}</h2>
                                                <p>{{ $relatedProduct->name }}</p>
                                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="tab-pane fade active in" id="reviews" >
                                <div class="col-sm-12">

                                    <div id="review-content">
                                        {!! $product->content !!} <!-- Hiển thị nội dung đã được chỉnh sửa -->
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div><!--/category-tab-->

                    @include('home.components.recommend_product')

                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        function addToCart(productId) {
            const quantity = document.getElementById('quantity').value;

            fetch(`/products/add-to-cart/${productId}?quantity=${quantity}`)
                .then(response => response.json())
                .then(data => {
                    if (data.code === 200) {
                        alert('Product added to cart successfully.');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>




@endsection

