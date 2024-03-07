<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{route('trang-chu')}}" class="active">Home</a></li>
        @foreach($categorysLimit as $categorysLimitItem)
        <li class="dropdown"><a href="#">
            {{$categorysLimitItem->name}}
                <i class="fa fa-angle-down"></i></a>
                @include('components.main.child_menu',['categorysLimitItem' => $categorysLimitItem])
        </li>
        @endforeach
{{--        <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>--}}
{{--            <ul role="menu" class="sub-menu">--}}
{{--                <li><a href="blog.html">Blog List</a></li>--}}
{{--                <li><a href="blog-single.html">Blog Single</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
        <li><a href="">404</a></li>
        <li><a href="{{route('view_post')}}">Bài Viết</a></li>
        <li><a href="contact-us.html">Contact</a></li>
    </ul>
</div>
