<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('trang-chu');
//tìm kiếm sản phẩm
Route::get('/products/search', 'App\Http\Controllers\HomeController@search')->name('products.search');
// Danh mục sản phẩm ngoài index
Route::get('/category/{slug}/{id}',[
    'as' => 'category.product',
    'uses' => 'App\Http\Controllers\HomeCategoryController@index'
]);
// Chi tiết sản phẩm
Route::get('/view_product/{id}',[
    'as' => 'product.view',
    'uses' => 'App\Http\Controllers\HomeCategoryController@viewproduct'
]);

// giỏ hàng
Route::get('/products/add-to-cart/{id}',[
    'uses' => 'App\Http\Controllers\HomeCategoryController@addToCart'
])->name('addToCart');
Route::get('/products/show-card','App\Http\Controllers\HomeCategoryController@showCart')->name('showCart');
Route::post('/products/update-cart', 'App\Http\Controllers\HomeCategoryController@updateCart')->name('updateCart');
Route::post('/products/delete-cart', 'App\Http\Controllers\HomeCategoryController@deleteCart')->name('deleteCart');
//checkout
Route::get('/products/show-checkout','App\Http\Controllers\HomeCategoryController@showCheckOut')->name('showCheckOut');
Route::post('/checkout/process', 'App\Http\Controllers\HomeCategoryController@processOrder')->name('checkout.process');
// Đăng nhập
Route::get('/login', 'App\Http\Controllers\AuthController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\AuthController@login');
// Đăng ký
Route::get('/register', 'App\Http\Controllers\AuthController@showRegisterForm')->name('register');
Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');
//bài viết
Route::get('/post/view_post','App\Http\Controllers\PostIndexController@viewPosts')->name('view_post');
Route::get('/post/view_post_single/{id}','App\Http\Controllers\PostIndexController@viewPostsSingle')->name('view_post_single');
// Đăng nhập admin
Route::get('/login_admin', 'App\Http\Controllers\AdminController@loginAdmin');
Route::post('/login_admin', 'App\Http\Controllers\AdminController@postLoginAdmin');
Route::get('/logout_admin', 'App\Http\Controllers\AdminController@logout')->name('logout_admin');
// index admin
Route::get('/home', function () {
    return view('home');
    })->name('home')->middleware('checkUserRole');

// các thành phần trên admin
Route::prefix('admins')->group(function (){
    //category
    Route::prefix('categories')->group(function () {
        Route::get('/create',[
            'as' => 'categories.create',
            'uses' => 'App\Http\Controllers\CategoryController@create',
            'middleware' => 'can:category-add'

        ]);

        Route::get('/index',[
            'as' => 'categories.index',
            'uses' => 'App\Http\Controllers\CategoryController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::post('/store',[
            'as' => 'categories.store',
            'uses' => 'App\Http\Controllers\CategoryController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'categories.edit',
            'uses' => 'App\Http\Controllers\CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'categories.delete',
            'uses' => 'App\Http\Controllers\CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'categories.update',
            'uses' => 'App\Http\Controllers\CategoryController@update'
        ]);
    });
    Route::prefix('brands')->group(function () {
        Route::get('/create',[
            'as' => 'brands.create',
            'uses' => 'App\Http\Controllers\BrandsController@create',
            'middleware' => 'can:category-add'

        ]);

        Route::get('/index',[
            'as' => 'brands.index',
            'uses' => 'App\Http\Controllers\BrandsController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::post('/store',[
            'as' => 'brands.store',
            'uses' => 'App\Http\Controllers\BrandsController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'brands.edit',
            'uses' => 'App\Http\Controllers\BrandsController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'brands.delete',
            'uses' => 'App\Http\Controllers\BrandsController@delete',
            'middleware' => 'can:category-delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'brands.update',
            'uses' => 'App\Http\Controllers\BrandsController@update'
        ]);
    });
    //menus
    Route::prefix('menus')->group(function () {
        Route::get('/index',[
            'as' => 'menus.index',
            'uses' => 'App\Http\Controllers\MenuController@index',
            'middleware' => 'can:menu-list'
        ]);

        Route::get('/create',[
            'as' => 'menus.create',
            'uses' => 'App\Http\Controllers\MenuController@create',
            'middleware' => 'can:menu-add'
        ]);
        Route::post('/store',[
            'as' => 'menus.store',
            'uses' => 'App\Http\Controllers\MenuController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'menus.edit',
            'uses' => 'App\Http\Controllers\MenuController@edit',
            'middleware' => 'can:menu-delete'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'menus.delete',
            'uses' => 'App\Http\Controllers\MenuController@delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'menus.update',
            'uses' => 'App\Http\Controllers\MenuController@update'
        ]);
    });
    //sản phẩm
    Route::prefix('product')->group(function () {
        Route::get('/index',[
            'as' => 'product.index',
            'uses' => 'App\Http\Controllers\AdminProductController@index',
            'middleware' => 'can:product-list'
        ]);

        Route::get('/create',[
            'as' => 'product.create',
            'uses' => 'App\Http\Controllers\AdminProductController@create',
            'middleware' => 'can:product-add'
        ]);
        Route::post('/store',[
            'as' => 'product.store',
            'uses' => 'App\Http\Controllers\AdminProductController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'product.edit',
            'uses' => 'App\Http\Controllers\AdminProductController@edit',
            'middleware' => 'can:product-edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'product.delete',
            'uses' => 'App\Http\Controllers\AdminProductController@delete',
            'middleware' => 'can:product-delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'product.update',
            'uses' => 'App\Http\Controllers\AdminProductController@update'
        ]);
   });
    // slider
    Route::prefix('slider')->group(function () {
        Route::get('/index',[
            'as' => 'slider.index',
            'uses' => 'App\Http\Controllers\SliderAdminController@index',
            'middleware' => 'can:slider-list'
        ]);

        Route::get('/create',[
            'as' => 'slider.create',
            'uses' => 'App\Http\Controllers\SliderAdminController@create',
            'middleware' => 'can:slider-add'
        ]);
        Route::post('/store',[
            'as' => 'slider.store',
            'uses' => 'App\Http\Controllers\SliderAdminController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'slider.edit',
            'uses' => 'App\Http\Controllers\SliderAdminController@edit',
            'middleware' => 'can:slider-edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'slider.delete',
            'uses' => 'App\Http\Controllers\SliderAdminController@delete',
            'middleware' => 'can:slider-delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'slider.update',
            'uses' => 'App\Http\Controllers\SliderAdminController@update'
        ]);
    });
    // settings
    Route::prefix('settings')->group(function () {
        Route::get('/index',[
            'as' => 'settings.index',
            'uses' => 'App\Http\Controllers\AdminSettingController@index',
            'middleware' => 'can:setting-list'
        ]);

        Route::get('/create',[
            'as' => 'settings.create',
            'uses' => 'App\Http\Controllers\AdminSettingController@create',
            'middleware' => 'can:setting-add'
        ]);
        Route::post('/store',[
            'as' => 'settings.store',
            'uses' => 'App\Http\Controllers\AdminSettingController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'settings.edit',
            'uses' => 'App\Http\Controllers\AdminSettingController@edit',
            'middleware' => 'can:setting-edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'settings.delete',
            'uses' => 'App\Http\Controllers\AdminSettingController@delete',
            'middleware' => 'can:setting-delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'settings.update',
            'uses' => 'App\Http\Controllers\AdminSettingController@update'
        ]);
    });
    //Order
    Route::prefix('orders')->group(function () {
        Route::get('/index',[
            'as' => 'orders.index',
            'uses' => 'App\Http\Controllers\AdminOrderController@index',

        ]);

        Route::get('/delete/{id}',[
            'as' => 'orders.delete',
            'uses' => 'App\Http\Controllers\AdminOrderController@delete'
        ]);

        Route::get('/approve/{id}',[
            'as' => 'orders.approve',
            'uses' => 'App\Http\Controllers\AdminOrderController@approve'
        ]);
    });
    // bài viết
    Route::prefix('posts')->group(function () {
        Route::get('/index',[
            'as' => 'posts.index',
            'uses' => 'App\Http\Controllers\AdminPostController@index',
            'middleware' => 'can:post-list'
        ]);

        Route::get('/create',[
            'as' => 'posts.create',
            'uses' => 'App\Http\Controllers\AdminPostController@create',
            'middleware' => 'can:post-add'
        ]);
        Route::post('/store', [
            'as' => 'posts.store',
            'uses' => 'App\Http\Controllers\AdminPostController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'posts.edit',
            'uses' => 'App\Http\Controllers\AdminPostController@edit',
            'middleware' => 'can:post-edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'posts.delete',
            'uses' => 'App\Http\Controllers\AdminPostController@delete',
            'middleware' => 'can:post-delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'posts.update',
            'uses' => 'App\Http\Controllers\AdminPostController@update'
        ]);
    });
    // tài khoản
    Route::prefix('users')->group(function () {
        Route::get('/index',[
            'as' => 'users.index',
            'uses' => 'App\Http\Controllers\AdminUserController@index',
            'middleware' => 'can:user-list'
        ]);

        Route::get('/create',[
            'as' => 'users.create',
            'uses' => 'App\Http\Controllers\AdminUserController@create'
        ]);
        Route::post('/store',[
            'as' => 'users.store',
            'uses' => 'App\Http\Controllers\AdminUserController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'users.edit',
            'uses' => 'App\Http\Controllers\AdminUserController@edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'users.delete',
            'uses' => 'App\Http\Controllers\AdminUserController@delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'users.update',
            'uses' => 'App\Http\Controllers\AdminUserController@update'
        ]);
    });
    //quyền
    Route::prefix('roles')->group(function () {
        Route::get('/index',[
            'as' => 'roles.index',
            'uses' => 'App\Http\Controllers\AdminRoleController@index',
            'middleware' => 'can:role-list'
        ]);

        Route::get('/create',[
            'as' => 'roles.create',
            'uses' => 'App\Http\Controllers\AdminRoleController@create'
        ]);
        Route::post('/store',[
            'as' => 'roles.store',
            'uses' => 'App\Http\Controllers\AdminRoleController@store'
        ]);
        Route::get('/edit/{id}',[
            'as' => 'roles.edit',
            'uses' => 'App\Http\Controllers\AdminRoleController@edit'
        ]);
        Route::get('/delete/{id}',[
            'as' => 'roles.delete',
            'uses' => 'App\Http\Controllers\AdminRoleController@delete'
        ]);

        Route::post('/update/{id}',[
            'as' => 'roles.update',
            'uses' => 'App\Http\Controllers\AdminRoleController@update'
        ]);
    });
});

