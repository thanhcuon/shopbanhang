<div class="carousel-inner">
    @foreach ($productImages as $index => $productImage)
        @if ($index % 3 == 0)
            @if ($index == 0)
                <div class="item active">
                    @else
                        <div class="item">
                            @endif
                            @endif
                            <a href=""><img src="{{ asset($productImage->image_path) }}" style="margin-left: 25px; width: 70px" alt=""></a>
                            @if (($index + 1) % 3 == 0)
                        </div>
                    @endif
                    @if ($index == count($productImages) - 1 && ($index + 1) % 3 != 0)
                </div> <!-- Đóng slide cuối cùng nếu không đủ 3 hình ảnh -->
                @for ($i = $index % 3 + 1; $i < 3; $i++)
                    <div class="item">
                        <a href=""><img src="{{ asset($productImages[$i]->image_path) }}" style="margin-left: 25px; width: 70px" alt=""></a>
                    </div>
                @endfor
            @endif
            @endforeach
</div>
