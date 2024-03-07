<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;

class PostIndexController extends Controller
{
    public function viewPosts(){
        $categorysLimit = Category::where('parent_id',0)->take(3)->get();
        $categorys = Category::where('parent_id',0)->get();
        $posts = Post::latest()->paginate(5);
        return view('home.posts.blog',compact('categorys','categorysLimit','posts'));
    }

    public function viewPostsSingle($id){
        $categorysLimit = Category::where('parent_id',0)->take(3)->get();
        $categorys = Category::where('parent_id',0)->get();
        $posts = Post::find($id);

        if (!$posts) {
            // Handle the case where the post with the given ID is not found
            abort(404);
        }
        return view('home.posts.blog_single',compact('categorys','categorysLimit','posts'));
    }
}
