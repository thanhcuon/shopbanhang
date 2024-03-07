@if($categorysLimitItem->categoryChildrent->count())
    <ul role="menu" class="sub-menu">
        @foreach($categorysLimitItem->categoryChildrent as $categoryChild)
            <li>

                <a href="{{route('category.product',
                                ['slug'=>$categoryChild->slug,'id'=>$categoryChild->id])}}">{{$categoryChild->name}}</a>
                @if($categoryChild->categoryChildrent->count())
                    @include('components.main.child_menu',['categorysLimitItem'=>$categoryChild])
                @endif
            </li>
        @endforeach
    </ul>
@endif
