<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CustomerAddress;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeCategoryController extends Controller
{

    public function index($slug,$categoryId){
        $categorysLimit = Category::where('parent_id',0)->take(3)->get();
        $categorys = Category::where('parent_id',0)->get();
        $products = Product::where('category_id',$categoryId)->paginate(12);
        return view('home.product.category.list',compact('categorysLimit','products','categorys'));
    }

        public function viewproduct($id){
            $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
            $categorys = Category::where('parent_id', 0)->get();
            $productsRecommend = Product::latest('views_count','desc')->take(6)->get();
            // Truy vấn sản phẩm cụ thể dựa trên $id
            $product = Product::find($id);

            if (!$product) {
                // Xử lý trường hợp sản phẩm không tồn tại
                return redirect()->route('home')->with('error', 'Sản phẩm không tồn tại.');
            }

            // Truy vấn các hình ảnh sản phẩm từ bảng product_images
            $productImages = ProductImage::where('product_id', $id)->get();
            // Truy vấn danh sách các thẻ liên quan đến sản phẩm
            $productTags = $product->tags;

            // Lấy danh sách các sản phẩm liên quan
            $relatedProducts = Product::whereHas('tags', function ($query) use ($productTags) {
                $query->whereIn('tags.id', $productTags->pluck('id'));
            })->where('products.id', '!=', $id)->get();

            return view('home.product.product.view_product', compact('categorysLimit', 'categorys', 'product', 'productImages','productsRecommend','relatedProducts'));
        }

        public function addToCart($id,Request $request){
            // Xác định tài khoản người dùng
            $user = Auth::user();

            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            if (!$user) {
                return response()->json([
                    'code' => 401,
                    'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.',
                ], 401);
            }

            // Lấy giỏ hàng của tài khoản
            $cart = session()->get('cart_' . $user->id);

            if (!$cart) {
                $cart = [];
            }

            // Tìm kiếm sản phẩm theo ID
            $product = Product::find($id);

            // Kiểm tra xem sản phẩm có tồn tại hay không
            if (!$product) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Sản phẩm không tồn tại.',
                ], 404);
            }

            // Lấy số lượng từ query parameter hoặc mặc định là 1 nếu không có
            $quantity = $request->input('quantity', 1);

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            if (isset($cart[$id])){
                $cart[$id]['quantity'] += $quantity;
            } else{
                $cart[$id] = [
                    'id' => $product->id,
                    'name'=> $product->name,
                    'price'=>$product->price,
                    'quantity'=> $quantity,
                    'feature_image_path'=>$product->feature_image_path,
                ];
            }

            // Lưu lại giỏ hàng trong phiên làm việc của tài khoản
            session()->put('cart_' . $user->id, $cart);

            return response()->json([
                'code' => 200,
                'message' => 'Thêm sản phẩm vào giỏ hàng thành công.',
            ], 200);
        }

        public function showCart(){
            // Xác định tài khoản người dùng
            $user = Auth::user();

            // Kiểm tra xem người dùng đã đăng nhập hay chưa
            if (!$user) {
                return redirect()->route('login'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập.
            }

            // Lấy giỏ hàng của tài khoản
            $cart = session()->get('cart_' . $user->id);

            if (!$cart) {
                $cart = [];
            }

            $categorysLimit = Category::where('parent_id', 0)->take(3)->get();

            return view('home.cart.cart', compact('categorysLimit', 'cart'));
        }


    public function updateCart(Request $request)
    {
        // Xác định tài khoản người dùng
        $user = Auth::user();

        // Lấy giỏ hàng của tài khoản
        $cart = session()->get('cart_' . $user->id);

        if (!$cart) {
            $cart = [];
        }

        $productId = $request->input('id');
        $quantity = $request->input('quantity');

        // Update the cart session data with the new quantity
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart_' . $user->id, $cart);

            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật giỏ hàng thành công.',
            ], 200);
        }

        return response()->json([
            'code' => 400,
            'message' => 'Cập nhật giỏ hàng thất bại.',
        ], 400);
    }

    public function deleteCart(Request $request)
    {
        // Xác định tài khoản người dùng
        $user = Auth::user();

        // Lấy giỏ hàng của tài khoản
        $cart = session()->get('cart_' . $user->id);

        if (!$cart) {
            $cart = [];
        }

        $productId = $request->input('id');

        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($cart[$productId])) {
            // Xóa sản phẩm khỏi giỏ hàng
            unset($cart[$productId]);

            // Cập nhật lại giỏ hàng trong session
            session()->put('cart_' . $user->id, $cart);

            return response()->json([
                'code' => 200,
                'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công.',
            ], 200);
        }

        return response()->json([
            'code' => 400,
            'message' => 'Xóa sản phẩm khỏi giỏ hàng thất bại.',
        ], 400);
    }


    public function showCheckOut()
    {
        $categorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập.
        }

        // Lấy giỏ hàng của tài khoản
        $cart = session()->get('cart_' . $user->id);

        if (!$cart) {
            $cart = [];
        }

        return view('home.cart.checkout', compact('categorysLimit', 'cart'));
    }
    public function processOrder(Request $request)
    {
        // Lấy thông tin từ biểu mẫu thanh toán
        $email = $request->input('email');
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');

        // Lưu thông tin địa chỉ khách hàng vào bảng customer_addresses
        $customerAddress = new CustomerAddress();
        $customerAddress->user_id = auth()->user()->id;
        $customerAddress->fullname = $name;
        $customerAddress->email = $email;
        $customerAddress->phone_number = $phone;
        $customerAddress->address = $address;
        $customerAddress->save();

        // Tạo một đơn hàng (order) và lưu vào bảng orders
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->customer_address_id = $customerAddress->id;
        $order->status = 'pending';
        $order->save();

        // Tính tổng tiền cho đơn hàng
        $total = 0;
        $user = Auth::user();
        $cart = session()->get('cart_' . $user->id, []); // Lấy giỏ hàng theo user ID

        foreach ($cart as $product_id => $cartItem) {
            $product = Product::find($product_id);
            $total += $product->price * $cartItem['quantity'];

            // Lưu thông tin sản phẩm vào bảng order_items
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $product_id;
            $orderItem->quantity = $cartItem['quantity'];
            $orderItem->total = $product->price * $cartItem['quantity']; // Tổng tiền cho sản phẩm
            $orderItem->save();
        }

        // Cập nhật tổng tiền cho đơn hàng
        $order->total = $total;
        $order->save();

        // Xóa giỏ hàng sau khi đã xử lý đơn hàng
        session()->forget('cart_' . $user->id);

        // Sau khi đã xử lý đơn hàng, bạn có thể chuyển hướng người dùng đến trang cảm ơn hoặc trang xác nhận thanh toán.
        return redirect('/'); // Chuyển hướng đến trang cảm ơn
    }
}
