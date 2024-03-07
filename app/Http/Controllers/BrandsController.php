<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    private $brand;
    private $category ;
    public function __construct(Brand $brand,Category $category)
    {
        $this->brand = $brand;
        $this->category = $category;
    }

    public function index(){
        $brands = $this->brand->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parent_id='');
        return view('admin.brand.add',compact('htmlOption'));
    }
    public function getCategory($parent_id){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parent_id);
        return $htmlOption;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|array',
        ]);

        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->slug = \Str::slug($request->input('name')); // Tạo slug từ tên thương hiệu
        $brand->save();
        return redirect()->route('brand.index')->with('success', 'Thương hiệu đã được tạo thành công.');
    }
    public function edit($id)
    {

        $brand = Brand::find($id);
        $htmlOption = $this->getCategory($brand->category_id);
        return view('admin.brand.edit', compact('brand','htmlOption'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
        ]);

        $brand = Brand::find($id);
        $brand->name = $request->input('name');
        $brand->slug = \Str::slug($request->input('name'));
        $brand->save();

        return redirect()->route('brand.index', $id)->with('success', 'Thương hiệu đã được cập nhật thành công.');
    }
    public function delete($id){
        try {
            $this->brand->find($id)->delete();
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
