@extends('layout.master')


@section('title')
    <title>Home Pages</title>
@endsection
@section('content')


    <section>
        <div class="container">
            <div class="row">
                @include('components.sidebar')
                <div class="col-sm-9">

                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        <div class="single-blog-post">
                            <h3>{{$posts->name}}</h3>

                            <a href="">
                                <img src="{{$posts->image_path}}" alt="">
                            </a>
                            <div id="review-content">
                                {!! $posts->contents !!} <!-- Hiển thị nội dung đã được chỉnh sửa -->
                            </div>
                            <div class="pager-area">
                                <ul class="pager pull-right">
                                    <li><a href="#">Pre</a></li>
                                    <li><a href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/blog-post-area-->

                </div>
            </div>
        </div>
    </section>


@endsection
