<?php

use App\Http\Controllers\Api\ApiVendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'uloginauth']);
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('/websetting', [ApiController::class, 'WebSetting']);
Route::post('/get-otp', [AuthController::class, 'GenrateOtp']);
Route::post('/mobile-login', [AuthController::class, 'OtpLogin']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/home', [ApiController::class, 'home']);
Route::get('/category/{id}/{sid?}', [ApiController::class, 'CategoryData']);
Route::get('/brand/{brand_slug}', [ApiController::class, 'BrandDetail']);
Route::get('/product-detail/{id}', [ApiController::class, 'ProductData']);


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/vedndor-products/{vid}', [ApiController::class, 'vendorProducts']);


    Route::get('/product/brands', [ApiController::class, 'BrandData']);
    Route::get('/addwishlist/{id}/{sid?}', [ApiController::class, 'Addwishlist']);
    Route::get('/addcart/{id}/{qty?}', [ApiController::class, 'Addcart']);
    Route::get('/getwishlist', [ApiController::class, 'GetWishlist']);
    Route::get('/getcart', [ApiController::class, 'GetCart']);
    Route::get('/profile', [AuthController::class, 'Profile']);
    Route::post('profile/update', [AuthController::class, 'profileUpdate']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/search/{s}', [ApiController::class, 'SearchData']);
    Route::get('/address', [ApiController::class, 'UserAddress']);
    Route::get('/addaddress', [ApiController::class, 'UserAddAddress']);
    Route::get('/getstates/{c}', [ApiController::class, 'StateData']);
    Route::get('/getcities/{s}', [ApiController::class, 'CityData']);
    Route::post('/storeaddress', [ApiController::class, 'StoreAddres']);
    Route::get('/delete-address/{id}', [ApiController::class, 'DeleteAddres']);
    Route::get('/default-address/{id}/{status}', [ApiController::class, 'DefaultAddres']);

    Route::get('/promocode', [ApiController::class, 'PromoCode']);
    Route::get('/orders', [ApiController::class, 'UserOrder']);
    Route::get('/order_details/{oid}', [ApiController::class, 'UserOrderDetails']);

    Route::get('/movetocart/{id}', [ApiController::class, 'MoveToCart']);
    Route::get('/movetowishlist/{id}', [ApiController::class, 'MoveToWish']);
    Route::get('/clearcart', [ApiController::class, 'ClearCart']);
    Route::get('/clearwishlist', [ApiController::class, 'ClearWish']);


    Route::get('/shop', [ApiController::class, 'Shop']);

    Route::get('/check-out', [ApiController::class, 'Checkout']);
    Route::post('/coupon-apply', [ApiController::class, 'CouponApply']);
    Route::post('/password-update', [ApiController::class, 'PasswordUpdate']);

    Route::get('/add-review/{id}', [ApiController::class, 'AddReview']);
    Route::post('/add-review', [ApiController::class, 'StoreReview']);
    Route::post('/order-place', [ApiController::class, 'OrderPlace']);
    Route::post('/completepayment', [ApiController::class, 'completepayment']);
    Route::get('/order-cancel/{id}/{oid?}', [ApiController::class, 'OrderCancel']);

    Route::get('/referral_code/{rcode}', [AuthController::class, 'ApplyRcode']);
    Route::get('/wallet', [ApiController::class, 'Userwallet']);




});


Route::post('/vendor/auth/register', [AuthController::class, 'vcreateUser']);
Route::post('/vendor/auth/login', [AuthController::class, 'vloginauth']);
Route::post('/vendor/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('/vendor/websetting', [ApiController::class, 'WebSetting']);
Route::post('/vendor/get-otp', [AuthController::class, 'VGenrateOtp']);
Route::post('/vendor/mobile-login', [AuthController::class, 'VOtpLogin']);

Route::middleware(['auth:sanctum'])->prefix('vendor')->group(function () {
    Route::get('/dashboard', [ApiVendorController::class, 'home']);

    Route::get('profile', [ApiVendorController::class, 'Profile']);
    Route::post('profile/update', [ApiVendorController::class, 'profileUpdate']);


    Route::get('/variant', [ApiVendorController::class, 'variant']);
    Route::post('/variant/create', [ApiVendorController::class, 'addVariant']);
    Route::post('/variant/update', [ApiVendorController::class, 'updateVariant']);
    Route::post('/variant/stock-status-toggle', [ApiVendorController::class, 'stockStatusToggle']);

    Route::get('/product-detail/{id}', [ApiVendorController::class, 'ProductData']);

    Route::get('/vendor-orders', [ApiVendorController::class, 'vendorOrders']);
    Route::get('/order-list/{id}', [ApiVendorController::class, 'orderList']);
    Route::get('/order-detail/{id}', [ApiVendorController::class, 'orderDetails']);

    Route::get('/edit-variant/{id}', [ApiVendorController::class, 'editVariant']);

    Route::get('/order-accept/{id}', [ApiVendorController::class, 'orderAccept']);
    Route::get('/order-reject/{id}', [ApiVendorController::class, 'orderReject']);

    Route::post('/add-quantity', [ApiVendorController::class, 'addQuantity']);

    Route::get('/product-order-history', [ApiVendorController::class, 'productOrderHistory']);
    Route::get('/product-history/{id}', [ApiVendorController::class, 'productHistory']);

    Route::get('/home', [ApiVendorController::class, 'vendorHome']);

});
