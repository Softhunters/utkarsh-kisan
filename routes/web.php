<?php

use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Livewire\Admin\Attribute\AddAttributeComponent;
use App\Livewire\Admin\Attribute\AttributeComponent;
use App\Livewire\Admin\Attribute\EditAttributeComponent;
use App\Livewire\Admin\Banner\AddBannerComponent;
use App\Livewire\Admin\Banner\BannerComponent;
use App\Livewire\Admin\Banner\EditBannerComponent;
use App\Livewire\Admin\Brand\AddBrandComponent;
use App\Livewire\Admin\Brand\BrandComponent;
use App\Livewire\Admin\Brand\EditBrandComponent;
use App\Livewire\Admin\Category\AddCategoryComponent;
use App\Livewire\Admin\Category\AddSubCategoryComponent;
use App\Livewire\Admin\Category\AddSubSubCategoryComponent;
use App\Livewire\Admin\Category\CategoryComponent;
use App\Livewire\Admin\Category\EditCategoryComponent;
use App\Livewire\Admin\Category\EditSubCategoryComponent;
use App\Livewire\Admin\Category\EditSubSubCategoryComponent;
use App\Livewire\Admin\Category\SubCategoryComponent;
use App\Livewire\Admin\Category\SubSubCategoryComponent;
use App\Livewire\Admin\Coupon\AddCouponComponent;
use App\Livewire\Admin\Coupon\CouponComponent;
use App\Livewire\Admin\Coupon\EditCouponComponent;
use App\Livewire\Admin\DashboardComponent;
use App\Livewire\Admin\Product\AddProductComponent;
use App\Livewire\Admin\Product\EditProductComponent;
use App\Livewire\Admin\Product\ProductComponent;
use App\Livewire\Admin\Slider\AddSliderComponent;
use App\Livewire\Admin\Slider\EditSliderComponent;
use App\Livewire\Admin\Slider\SliderComponent;
use App\Livewire\Admin\Tax\AddTaxComponent;
use App\Livewire\Admin\Tax\EditTaxComponent;
use App\Livewire\Admin\Tax\TaxComponent;
use App\Livewire\Admin\User\UserComponent;
use App\Livewire\Admin\WebsettingComponent;
use App\Livewire\Frontend\CategorySearchComponent;
use App\Livewire\Frontend\HomeComponent;
use App\Livewire\Frontend\ProductDetailsComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeComponent::class)->name('index');

Route::get('/category/{category_slug}/{scategory_slug?}',CategorySearchComponent::class)->name('product.category');
Route::get('/product-detail/{slug}',ProductDetailsComponent::class)->name('product-details');
Route::get('/vdrregistor', [RegisterController::class, 'vdrregisterview'])->name('vdrregisterview');
Route::get('/uregisteor', [RegisterController::class, 'uregisteorview'])->name('udregisteorview');
Route::post('/uregisteor', [RegisterController::class, 'uregisteor'])->name('udregisteor');
Route::get('/ulogin', [LoginController::class, 'uloginview'])->name('uloginview');
Route::post('/ulogin', [LoginController::class, 'uloginauth'])->name('ulogin');
Route::get('/vendorlogin', [LoginController::class, 'vendorlogin']);
Route::get('/adminlogin', [LoginController::class, 'adminlogin']);
Route::post('/adminlogin', [LoginController::class, 'adminloginauth'])->name('adminlogin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Admin Routes
    Route::middleware(['authadmin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', DashboardComponent::class)->name('admin.dashboard');
        Route::get('/sliders', SliderComponent::class)->name('admin.sliders');
        Route::get('/slider/add', AddSliderComponent::class)->name('admin.addslider');
        Route::get('/slider/edit/{sid}', EditSliderComponent::class)->name('admin.editslider');
        Route::get('/banners', BannerComponent::class)->name('admin.banners');
        Route::get('/banner/add', AddBannerComponent::class)->name('admin.addbanner');
        Route::get('/banner/edit/{bid}', EditBannerComponent::class)->name('admin.editbanner');
        Route::get('/categories', CategoryComponent::class)->name('admin.categories');
        Route::get('/category/add', AddCategoryComponent::class)->name('admin.addcategory');
        Route::get('/category/edit/{category_slug}', EditCategoryComponent::class)->name('admin.editcategory');
        Route::get('/subcategories', SubCategoryComponent::class)->name('admin.subcategories');
        Route::get('/subcategory/add', AddSubCategoryComponent::class)->name('admin.addsubcategory');
        Route::get('/subcategory/edit/{scategory_slug}', EditSubCategoryComponent::class)->name('admin.editsubcategory');
        Route::get('/subsubcategories', SubSubCategoryComponent::class)->name('admin.subsubcategories');
        Route::get('/subsubcategory/add', AddSubSubCategoryComponent::class)->name('admin.addsubsubcategory');
        Route::get('/subsubcategory/edit/{scategory_slug}', EditSubSubCategoryComponent::class)->name('admin.editsubsubcategory');

        Route::get('/admin/users', UserComponent::class)->name('admin.users');


        Route::get('/brands', BrandComponent::class)->name('admin.brands');
        Route::get('/brands/add', AddBrandComponent::class)->name('admin.addbrand');
        Route::get('/brands/edit/{br_id}', EditBrandComponent::class)->name('admin.editbrand');

        Route::get('/attributes', AttributeComponent::class)->name('admin.attributes');
        Route::get('/attributes/add', AddAttributeComponent::class)->name('admin.addattribute');
        Route::get('/attributes/edit/{att_id}', EditAttributeComponent::class)->name('admin.editattribute');

        Route::get('/products', ProductComponent::class)->name('admin.products2');
        Route::get('/product/add', AddProductComponent::class)->name('admin.addproduct2');
        Route::get('/product/edit/{product_slug}', EditProductComponent::class)->name('admin.editproduct2');


        Route::get('/taxs', TaxComponent::class)->name('admin.taxs');
        Route::get('/tax/add', AddTaxComponent::class)->name('admin.addtax');
        Route::get('/tax/edit/{bid}', EditTaxComponent::class)->name('admin.edittax');

        Route::get('/coupons', CouponComponent::class)->name('admin.coupons');
        Route::get('/coupon/add', AddCouponComponent::class)->name('admin.addcoupon');
        Route::get('/coupon/edit/{cid}', EditCouponComponent::class)->name('admin.editcoupon');

        Route::get('websetting', WebsettingComponent::class)->name('admin.websetting');

        Route::get('/vendor/list/{type}', [VendorController::class, 'index'])
            ->whereIn('type', ['active', 'deactivated', 'unverified'])
            ->name('vendor.list');
        Route::get('/vendor/{id}/show', [VendorController::class, 'show'])->name('vendor.profile.show');
        Route::patch('/admin/vendor/{id}/toggle-varification', [VendorController::class, 'toggleVerification'])->name('admin.vendor.toggleVerification');
        Route::patch('/admin/vendor/{id}/toggle-status', [VendorController::class, 'toggleStatus'])->name('admin.vendor.toggleStatus');
    });


    
    // Vendor Routes
    Route::middleware(['authvendor'])->prefix('vendor')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('vendor.dashboard');

        //product list
        Route::get('/products', [ProductController::class, 'index'])->name('vendor.products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('vendor.addproduct');
        Route::post('/products/save', [ProductController::class, 'store'])->name('vendor.products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('vendor.products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('vendor.products.update');
        Route::get('/products/{id}', [ProductController::class, 'show'])->name('vendor.products.show');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('vendor.products.destroy');
        Route::patch('/vendor/products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('vendor.products.toggleStatus');
        Route::get('/api/subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
        Route::get('/api/products', [ProductController::class, 'getProducts']);

        //profile
        Route::get('profile', [VendorProfileController::class, 'edit'])->name('vendor.profile.edit');
        Route::post('profile/update', [VendorProfileController::class, 'update'])->name('vendor.profile.update');

        //fetch state and city
        Route::get('/getstates/{c}', [ApiController::class, 'StateData']);
        Route::get('/getcities/{s}', [ApiController::class, 'CityData']);
    });


});
