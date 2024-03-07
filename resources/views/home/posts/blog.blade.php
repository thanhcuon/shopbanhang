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
                        @foreach($posts as $post)
                        <div class="single-blog-post">
                            <h3>{{$post->name}}</h3>
                            <div class="post-meta">
                                <span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
                            </div>
                            <a href="">
                                <img src="{{$post->image_path}}" alt="">
                            </a>
                            <p>{{$post->title}}</p>
                            <a  class="btn btn-primary" href="{{route('view_post_single', ['id'=>$post->id])}}">Read More</a>
                        </div>
                        @endforeach

                        <div class="pagination-area">
                            <ul class="pagination">
                                {{ $posts->links('pagination::bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
