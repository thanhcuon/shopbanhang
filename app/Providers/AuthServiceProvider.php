<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
        public function boot()
        {
            $this->registerPolicies();

            // quyền có cho phép xem trên admin
            Gate::define('category-list', function (User $user) {
                return $user->checkPermissionAccess('list_category');
            });
            //
            Gate::define('menu-list', function (User $user) {
                return $user->checkPermissionAccess('list_menu');
            });

            Gate::define('slider-list', function (User $user) {
                return $user->checkPermissionAccess('list_slider');
            });

            Gate::define('product-list', function (User $user) {
                return $user->checkPermissionAccess('list_product');
            });

            Gate::define('setting-list', function (User $user) {
                return $user->checkPermissionAccess('list_setting');
            });

            Gate::define('user-list', function (User $user) {
                return $user->checkPermissionAccess('list_user');
            });

            Gate::define('role-list', function (User $user) {
                return $user->checkPermissionAccess('list_role');
            });
            Gate::define('post-list', function (User $user) {
                return $user->checkPermissionAccess('list_post');
            });
            // quyền có cho phép thêm trên admin
            Gate::define('category-add', function (User $user) {
                return $user->checkPermissionAccess('add_category');
            });
            Gate::define('menu-add', function (User $user) {
                return $user->checkPermissionAccess('add_menu');
            });
            Gate::define('slider-add', function (User $user) {
                return $user->checkPermissionAccess('add_slider');
            });
            Gate::define('product-add', function (User $user) {
                return $user->checkPermissionAccess('add_product');
            });
            Gate::define('setting-add', function (User $user) {
                return $user->checkPermissionAccess('add_setting');
            });
            Gate::define('user-add', function (User $user) {
                return $user->checkPermissionAccess('add_user');
            });
            Gate::define('role-add', function (User $user) {
                return $user->checkPermissionAccess('add_role');
            });
            Gate::define('post-add', function (User $user) {
                return $user->checkPermissionAccess('add_post');
            });
            // quyền có cho phép sửa trên admin
            Gate::define('category-edit', function (User $user) {
                return $user->checkPermissionAccess('edit_category');
            });
            Gate::define('menu-edit', function (User $user) {
                return $user->checkPermissionAccess('edit_menu');
            });
            Gate::define('slider-edit', function (User $user) {
                return $user->checkPermissionAccess('edit_slider');
            });
            Gate::define('product-edit', function (User $user) {
                return $user->checkPermissionAccess('edit_product');
            });
            Gate::define('setting-edit', function (User $user) {
                return $user->checkPermissionAccess('edit_setting');
            });
            Gate::define('user-edit', function (User $user) {
                return $user->checkPermissionAccess('edit_user');
            });
            Gate::define('role-edit', function (User $user) {
                return $user->checkPermissionAccess('edit_role');
            });
            Gate::define('post-edit', function (User $user) {
                return $user->checkPermissionAccess('edit_post');
            });
            // quyền có cho phép xóa trên admin
            Gate::define('category-delete', function (User $user) {
                return $user->checkPermissionAccess('delete_category');
            });
            Gate::define('menu-delete', function (User $user) {
                return $user->checkPermissionAccess('delete_menu');
            });
            Gate::define('slider-delete', function (User $user) {
                return $user->checkPermissionAccess('delete_slider');
            });
            Gate::define('product-delete', function (User $user) {
                return $user->checkPermissionAccess('delete_product');
            });
            Gate::define('setting-delete', function (User $user) {
                return $user->checkPermissionAccess('delete_setting');
            });
            Gate::define('user-delete', function (User $user) {
                return $user->checkPermissionAccess('delete_user');
            });
            Gate::define('role-delete', function (User $user) {
                return $user->checkPermissionAccess('delete_role');
            });
            Gate::define('post-delete', function (User $user) {
                return $user->checkPermissionAccess('delete_post');
            });
        }
}
