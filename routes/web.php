<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\PackageController;
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
use App\Livewire\Admin\Contact\ContactFormComponent;
use App\Livewire\Admin\Coupon\AddCouponComponent;
use App\Livewire\Admin\Coupon\CouponComponent;
use App\Livewire\Admin\Coupon\EditCouponComponent;
use App\Livewire\Admin\DashboardComponent;
use App\Livewire\Admin\Inventory\InventoryComponent;
use App\Livewire\Admin\Inventory\InventoryDetailComponent;
use App\Livewire\Admin\Order\OrderComponent;
use App\Livewire\Admin\Order\OrderDetailComponent;
use App\Livewire\Admin\Order\VendorOrderComponent;
use App\Livewire\Admin\Order\VendorOrderComponentDetail;
use App\Livewire\Admin\Package\AddPackagecomponent;
use App\Livewire\Admin\Package\EditPackagecomponent;
use App\Livewire\Admin\Package\Packagecomponent;
use App\Livewire\Admin\Product\AddProductComponent;
use App\Livewire\Admin\Product\EditProductComponent;
use App\Livewire\Admin\Product\ProductComponent;
use App\Livewire\Admin\Slider\AddSliderComponent;
use App\Livewire\Admin\Slider\EditSliderComponent;
use App\Livewire\Admin\Slider\SliderComponent;
use App\Livewire\Admin\Tax\AddTaxComponent;
use App\Livewire\Admin\Tax\EditTaxComponent;
use App\Livewire\Admin\Tax\TaxComponent;
use App\Livewire\Admin\Testimonial\AddTestimonialComponent;
use App\Livewire\Admin\Testimonial\EditTestimonialComponent;
use App\Livewire\Admin\Testimonial\TestimonialComponent;
use App\Livewire\Admin\User\UserComponent;
use App\Livewire\Admin\WebsettingComponent;
use App\Livewire\Frontend\AboutUsComponent;
use App\Livewire\Frontend\CartComponent;
use App\Livewire\Frontend\CategorySearchComponent;
use App\Livewire\Frontend\CheckOutComponent;
use App\Livewire\Frontend\ContactUsComponent;
use App\Livewire\Frontend\HomeComponent;
use App\Livewire\Frontend\OrderDetailsComponent;
use App\Livewire\Frontend\OrdersComponent;
use App\Livewire\Frontend\ProductDetailsComponent;
use App\Livewire\Frontend\SearchComponent;
use App\Livewire\Frontend\ShopComponent;
use App\Livewire\Frontend\VendorProductComponent;
use App\Livewire\Frontend\WishlistComponent;

// use App
use App\Livewire\ThankyouComponent;
use App\Livewire\Vendor\Inventory\VendorInventoryComponent;
use App\Livewire\Vendor\Inventory\VendorInventoryDetailComponent;
use Illuminate\Support\Facades\Route;

use App\Livewire\User\AccountComponent;
use App\Livewire\User\AddressComponent;
use App\Livewire\User\ChangePasswordComponent;
use App\Livewire\User\InviteEarnComponent;


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
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/account', AccountComponent::class)->name('user.account');
    Route::get('/user/address', AddressComponent::class)->name('user.address');
    Route::get('/user/changePassword', ChangePasswordComponent::class)->name('user.change-password');
    Route::get('/user/orders', OrdersComponent::class)->name('orders');
    Route::get('/order/{id}', OrderDetailsComponent::class)->name('order-details');
    // Route::get('/user/invite_earn', InviteEarnComponent::class)->name('user.invite_earn');

});

Route::get('/', HomeComponent::class)->name('index');

Route::get('/wishlist', WishlistComponent::class)->name('wishlist');
Route::get('/cart', CartComponent::class)->name('cart');

Route::get('/check-out', CheckOutComponent::class)->name('check-out');
Route::get('/thankyou', ThankyouComponent::class)->name('thankyou');

Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/vendor/product_list/{slug}', VendorProductComponent::class)->name('vendorProduct');
Route::get('/category/{category_slug}/{scategory_slug?}', CategorySearchComponent::class)->name('product.category');
Route::get('/product-detail/{slug}/{vendor_id?}', ProductDetailsComponent::class)->name('product-details');

Route::get('/search', SearchComponent::class)->name('searchs');

Route::get('/contact-us', ContactUsComponent::class)->name('contact-us');
Route::get('/about-us', AboutUsComponent::class)->name('about-us');

Route::get('/vdrregistor', [RegisterController::class, 'vdrregisterview'])->name('vdrregisterview');
Route::get('/uregisteor', [RegisterController::class, 'uregisteorview'])->name('udregisteorview');
Route::post('/uregisteor', [RegisterController::class, 'uregisteor'])->name('udregisteor');
Route::get('/ulogin', [LoginController::class, 'uloginview'])->name('uloginview');
Route::post('/ulogin', [LoginController::class, 'uloginauth'])->name('ulogin');
Route::get('/vendorlogin', [LoginController::class, 'vendorlogin'])->name('vendorlogin');
Route::post('/vendorlogin', [LoginController::class, 'vendorloginAuth'])->name('vlogin');
Route::get('/adminlogin', [LoginController::class, 'adminlogin']);
Route::post('/adminlogin', [LoginController::class, 'adminloginauth'])->name('adminlogin');
Route::post('/mobile-login', [AuthController::class, 'OtpLogin']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/user/orders', OrdersComponent::class)->name('orders');
    Route::get('/order/{id}', OrderDetailsComponent::class)->name('order-details');

    Route::post('profile/update2', [AuthController::class, 'profileUpdate2']);

    Route::get('/buy-package/{slug}', [PaymentController::class, 'checkout'])->name('razorpay.checkout');
    Route::post('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('razorpay.success');


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

        Route::get('/testimonials', TestimonialComponent::class)->name('admin.testimonials');
        Route::get('/testimonial/add', AddTestimonialComponent::class)->name('admin.addtestimonial');
        Route::get('/testimonial/edit/{tid}', EditTestimonialComponent::class)->name('admin.edittestimonial');

        Route::get('websetting', WebsettingComponent::class)->name('admin.websetting');
        Route::get('/contact', ContactFormComponent::class)->name('admin.contact-form');

        Route::get('/inventory', InventoryComponent::class)->name('admin.inventory');
        Route::get('/inventory-details/{id}', InventoryDetailComponent::class)->name('admin.inventory.details');

        Route::get('/vendor/list/{type}', [VendorController::class, 'index'])
            ->whereIn('type', ['active', 'deactivated', 'unverified'])
            ->name('vendor.list');
        Route::get('/vendor/{id}/show', [VendorController::class, 'show'])->name('vendor.profile.show');
        Route::patch('/admin/vendor/{id}/toggle-varification', [VendorController::class, 'toggleVerification'])->name('admin.vendor.toggleVerification');
        Route::patch('/admin/vendor/{id}/toggle-status', [VendorController::class, 'toggleStatus'])->name('admin.vendor.toggleStatus');

        Route::get('/orders', OrderComponent::class)->name('admin.orders');
        Route::get('/order/detail/{id}', OrderDetailComponent::class)->name('admin.order-detail');

        Route::get('/admin/packages', Packagecomponent::class)->name('admin.packages');
        Route::get('/admin/package/add', AddPackagecomponent::class)->name('admin.addpackage');
        Route::get('/admin/package/edit/{pid}', EditPackagecomponent::class)->name('admin.editpackage');
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

        //orders
        Route::get('/orders', VendorOrderComponent::class)->name('vendor.orders');
        Route::get('/order/detail/{id}', VendorOrderComponentDetail::class)->name('vendor.order-detail');

        //product inventory
        Route::get('/inventory', VendorInventoryComponent::class)->name('vendor.inventory');
        Route::get('/inventory-details/{id}', VendorInventoryDetailComponent::class)->name('vendor.inventory.details');

        //package
        Route::get('/my-package', [PackageController::class, 'index'])->name('vendor.package');

    });


});


Route::get('/routeclear', function () {
    Artisan::call('optimize:clear');
});

Route::get('/terms-conditions', function () {
    return view('static-pages.terms-and-conditions');
})->name('terms-and-conditions');

Route::get('/return-refund-policy', function () {
    return view('static-pages.return-refund-policy');
})->name('return-refund-policy');
Route::get('/privacy-policy', function () {
    return view('static-pages.privacy-policy');
})->name('privacy-policy');
Route::get('/shipping-policy', function () {
    return view('static-pages.shipping-policy');
})->name('shipping-policy');
Route::get('/vendor-terms-conditions', function () {
    return view('static-pages.vendor-terms-conditions');
})->name('vendor-terms-and-conditions');
Route::get('/vendor-subscription', function () {
    return view('static-pages.vendor-subscription');
})->name('vendor-subscription');
Route::get('/new-user-login', function () {
    return view('livewire.login2');
})->name('new-user-login');
Route::get('/new-user-register', function () {
    return view('livewire.register2');
})->name('new-user-register');
Route::get('/get-otp', function () {
    return view('livewire.otp');
})->name('get-otp');