<div class="category-tab">
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            @foreach($categorys as $indexCategory => $categoryItem)
                <li class="{{$indexCategory == 0 ? 'active' : ''}}">
                    <a href="#category_tab_{{$categoryItem->id}}" data-toggle="tab">
                        {{$categoryItem->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
        @foreach($categorys as $indexCategoryProduct => $categoryItemProduct)
            <div class="tab-pane fade {{$indexCategoryProduct == 0 ? 'active in' : ''}}" id="category_tab_{{$categoryItemProduct->id}}" >
                <div class="row">
                    @foreach($categoryItemProduct->products as $productItemTabs)
                        <div class="col-sm-3">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{$productItemTabs->feature_image_path}}" alt="" />
                                        <h2>{{number_format($productItemTabs->price)." VND"}}</h2>
                                        <div class="row">
                                            <a href="{{route('product.view', ['id'=>$productItemTabs->id])}}" style="color: #0a0e14">{{$productItemTabs->name}}</a>
                                        </div>
                                        <a href="#" data-url="{{route('addToCart',['id'=>$productItemTabs->id])}}"
                                           class="btn btn-default add-to-cart Add_To_Cart">
                                            <i class="fa fa-shopping-cart">
                                            </i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>



