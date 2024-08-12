<?php

use App\Http\Controllers\Controller;
use Doctrine\DBAL\Logging\Middleware;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CaterogyController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\SocialController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Backend\OrderDetailsController;
use App\Http\Controllers\Frontend\LoginGoogleController;
use App\Http\Controllers\Backend\ImgController;
use App\Http\Controllers\Frontend\MyAccountController;
use App\Http\Controllers\Frontend\LoginGithubController;
use App\Http\Controllers\Backend\RatingController;
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
//Frontend
Route::prefix('')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('frontend.index');
    Route::get('/product-detail-{id}-{slug}', [HomeController::class, 'productDetail'])->name('productDetail.index');
    Route::get('/contact-index', [HomeController::class, 'contact'])->name('contact.index');
    //tìm kiếm
    Route::get('/search-result', [HomeController::class, 'search'])->name('search.result');
    //giỏ hàng-cart
    Route::get('/cart-index', [CartController::class,'cartIndex'])->name('cart.index');
    Route::post('/add-cart', [CartController::class, 'addCart'])->name('cart.add');
    Route::post('/remove-cart/{id}', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::patch('/update-cart', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/clear-cart', [CartController::class, 'clearCart'])->name('cart.clear');

    //checkout-đặt hàng
    Route::prefix('checkout')->middleware('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'checkoutIndex'])->name('checkout.index');
        Route::post('/order', [CheckoutController::class, 'checkoutStore'])->name('checkout.store');
        Route::get('/result', [CheckoutController::class, 'checkoutResult'])->name('checkout.result.index');
        Route::get('/order-list', [CheckoutController::class, 'orderDetailList'])->name('orderList.index');
        Route::post('/order/cancel/{id}', [CheckoutController::class, 'cancelOrder'])->name('order.cancel');

        //đánh giá bình luận
        Route::post('/product/{id}/rate', [HomeController::class, 'rateProduct'])->name('product.rate');

    });
    //quản lý thông tin cá nhân
    Route::get('/my-account', [MyAccountController::class, 'myAccount'])->name('myAccount.index');
    Route::put('/update-account-info', [MyAccountController::class, 'updateAccountInfo'])->name('myAccount.update');

    //logout
    Route::get('/logout', [HomeController::class, 'userlogout'])->name('user.logout');
});

//login-register-frontend
Route::get('/login-user-index', [HomeController::class, 'login'])->name('userLogin.index');
Route::post('/login-user', [HomeController::class, 'checkLogin'])->name('user.checkLogin');
Route::get('/register-user-index', [HomeController::class, 'register'])->name('userRegister.index');
Route::get('email/verify/{id}', [HomeController::class, 'verify'])->name('verification.verify')->middleware('signed');

Route::post('/register-user', [HomeController::class, 'storeRegister'])->name('user.register');

// //forgot pass
Route::get('/forgot-password', [HomeController::class, 'forgotPasswordIndex'])->name('userForgotPassword.index');
Route::post('/forgot-password', [HomeController::class, 'sendResetLinkEmail'])->name('forgotPassword.send');
Route::get('/reset-password/{token}', [HomeController::class, 'resetPasswordIndex'])->name('userResetPassword.index');
Route::post('/reset-password', [HomeController::class, 'resetPassword'])->name('resetPassword.update');

//google login
Route::get('/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('user.google');
Route::get('/google/callback', [LoginGoogleController::class, 'handleGoogleCallback'])->name('user.googlecallback');

//github login
Route::get('/github', [LoginGithubController::class, 'redirectToGithub'])->name('user.github');
Route::get('/github/callback', [LoginGithubController::class, 'handleGithubCallback'])->name('user.githubcallback');

// //facebook login
// Route::get('/facebook', [SocialController::class, 'getInfo'])->name('user.getFB');
// Route::get('/facebook/callback}', [SocialController::class, 'checkInfo'])->name('user.checkFB');
//endfront

//backend
//login backend
Route::get('/login-admin-index', [AdminController::class, 'login'])->name('adminLogin.index');
Route::post('/login-admin', [AdminController::class, 'checkLogin'])->name('admin.checkLogin');

Route::prefix('admin')->middleware(['auth:admin', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/adminlogout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/change-password-index', [AdminController::class, 'changePasswordindex'])->name('admin.changePasswordIndex');
    Route::post('/change-password/{id}', [AdminController::class, 'changePassword'])->name('admin.changePassword');

    //quản lý user
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('/users-edit/{id}', [UserController::class, 'editUser'])->name('user.edit');
        Route::get('/users-delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');
    }); 
    //quản lý danh mục
    Route::prefix('caterogy')->group(function () {
        Route::get('/', [CaterogyController::class, 'index'])->name('caterogy.index');
        Route::get('/create-caterogy-index', [CaterogyController::class, 'createCaterogyIndex'])->name('createCaterogy.index');
        Route::get('/edit-caterogy-index/{id}', [CaterogyController::class, 'editCaterogyIndex'])->name('editCaterogy.index');
        Route::get('/create-caterogy', [CaterogyController::class, 'createCaterogy'])->name('caterogy.create');
        Route::post('/create-caterogy', [CaterogyController::class, 'createCaterogy'])->name('caterogy.create');
        Route::get('/edit-caterogy/{id}', [CaterogyController::class, 'editCaterogy'])->name('caterogy.edit');
        Route::post('/edit-caterogy/{id}', [CaterogyController::class, 'editCaterogy'])->name('caterogy.edit');
        Route::get('/caterogy-delete/{id}', [CaterogyController::class, 'deleteCaterogy'])->name('caterogy.delete');
    });
    //quản lý thương hiệu
    Route::prefix('brand')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/create-brand-index', [BrandController::class, 'createBrandIndex'])->name('createBrand.index');
        Route::get('/edit-brand-index/{id}', [BrandController::class, 'editBrandIndex'])->name('editBrand.index');
        Route::get('/create-brand', [BrandController::class, 'createBrand'])->name('brand.create');
        Route::post('/create-brand', [BrandController::class, 'createBrand'])->name('brand.create');
        Route::get('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('brand.edit');
        Route::post('/edit-brand/{id}', [BrandController::class, 'editBrand'])->name('brand.edit');
        Route::get('/brand-delete/{id}', [BrandController::class, 'deleteBrand'])->name('brand.delete');
    });
    //quản lý sản phẩm
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create-product-index', [ProductController::class, 'createProductIndex'])->name('createProduct.index');
        Route::get('/edit-product-index/{id}', [ProductController::class, 'editProductIndex'])->name('editProduct.index');
        Route::post('/create-product', [ProductController::class, 'createProduct'])->name('product.create');
        Route::put('/edit-product/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
        Route::get('/product-delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    });
    //quản lý đơn hàng
    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('order.index');
        Route::post('/edit-order/{id}', [OrderController::class, 'editOrder'])->name('order.edit');
        Route::get('/order-delete/{id}', [OrderController::class, 'deleteOrder'])->name('order.delete');
    });
    //chi tiết đơn hàng
    Route::prefix('order-details')->group(function () {
        Route::get('/{id}', [OrderDetailsController::class, 'index'])->name('orderDetails.index');
    });
    //hình sản phẩm
    Route::prefix('imgs')->group(function () {
        Route::get('/', [ImgController::class, 'index'])->name('imgs.index');
        Route::get('/upload-img-index', [ImgController::class, 'uploadIndex'])->name('uploadimgs.index');
        Route::post('/upload-img', [ImgController::class, 'uploadImg'])->name('imgs.upload');
        Route::get('/edit-img-index/{id}', [ImgController::class, 'editIndex'])->name('editimgs.index');
        Route::put('/upload-img/{id}', [ImgController::class, 'editImg'])->name('imgs.edit');
        Route::get('/img-delete/{id}', [ImgController::class, 'deleteImg'])->name('imgs.delete');
    });
    //Đánh giá bình luận sản phẩm
    Route::prefix('ranting')->group(function () {
        Route::get('/', [RatingController::class, 'index'])->name('rating.index');
        Route::post('/update-rating/{id}', [RatingController::class, 'updateRating'])->name('rating.update');
        Route::get('/rating-delete/{id}', [RatingController::class, 'deleteRating'])->name('rating.delete');
    });
});
//endbackend
