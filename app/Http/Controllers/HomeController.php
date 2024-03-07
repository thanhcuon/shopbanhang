<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->get();
        $categorys = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productsRecommend = Product::latest('views_count','desc')->take(6)->get();
        $categorysLimit = Category::where('parent_id',0)->take(3)->get();
        return view('home.home',compact('sliders',
            'categorys','products','productsRecommend',
         'categorysLimit'));
    }

    public function search(Request $request){
        $categorys = Category::where('parent_id',0)->get();
        $keyword = $request->input('keyword');
        $categorysLimit = Category::where('parent_id',0)->take(3)->get();
        $products = Product::where('name', 'like', "%$keyword%")
            ->orWhere('content', 'like', "%$keyword%")
            ->paginate(6); // Số lượng sản phẩm trên mỗi trang

        return view('home.product.search.search', compact('products', 'keyword','categorys','categorysLimit'));
    }

}
