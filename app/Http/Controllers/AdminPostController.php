<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostAddRequest;
use App\Models\Post;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminPostController extends Controller
{
    use StorageImageTrait;

    private $post;
    public function __construct(Post $post)
    {
        $this->post=$post;
    }

    public function index(){
        $posts = $this->post->paginate(5);
        return view('admin.posts.index',compact('posts'));
    }
        public function create(){
            return view('admin.posts.add');
        }
        public function store(Request $request) {
        try {
            $dataInsert = [
                'name' => $request->name,
                'title' => $request->title,
                'contents' => $request->contents,
            ];

            // Kiểm tra và xử lý hình ảnh
            if ($request->hasFile('image_path')) {
                $dataImagePost = $this->storageTraitUpload($request, 'image_path', 'post');
                $dataInsert['image_name'] = $dataImagePost['file_name'];
                $dataInsert['image_path'] = $dataImagePost['file_path'];
            }

            $this->post->create($dataInsert);
            return redirect()->route('posts.index');
        } catch (\Exception $exception) {
            Log::error('Message:' . $exception->getMessage() . '--- Line' . $exception->getLine());
            // Redirect với thông báo lỗi nếu cần
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $exception->getMessage());
        }
    }
    public function edit($id){
        $posts = $this->post->find($id);

        return view('admin.posts.edit',compact('posts'));
    }

    public function update($id,Request $request){
        try {
            $dataUpdate = [
                'name' => $request->name,
                'title' => $request->title,
                'contents' => $request->contents,
            ];

            // Kiểm tra và xử lý hình ảnh
            if ($request->hasFile('image_path')) {
                $dataImagePost = $this->storageTraitUpload($request, 'image_path', 'post');
                $dataUpdate['image_name'] = $dataImagePost['file_name'];
                $dataUpdate['image_path'] = $dataImagePost['file_path'];
            }

            $this->post->find($id)->update($dataUpdate);
            return redirect()->route('posts.index');
        } catch (\Exception $exception) {
            Log::error('Message:' . $exception->getMessage() . '--- Line' . $exception->getLine());
            // Redirect với thông báo lỗi nếu cần
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $exception->getMessage());
        }
    }
    public function delete($id){
        try {
            $this->post->find($id)->delete();
            return response()->json([
                'code'=>200,
                'message'=>'success'
            ],200);

        }catch (\Exception $exception){
            Log::error('Message:'.$exception->getMessage().'--- Line'.$exception->getLine());
            return response()->json([
                'code'=>500,
                'message'=>'fail'
            ],500);
        }
    }
}
