@extends('layout.master')


@section('title')
<title>Home Pages</title>
@endsection
@section('content')


@include('home.components.slider')

    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        @include('home.components.features_product')
                    </div><!--features_items-->
                    <!--category-tab-->
                    @include('home.components.category_tab')
                    <!--/category-tab-->

                    @include('home.components.recommend_product')

                </div>
            </div>
        </div>
    </section>


@endsection
