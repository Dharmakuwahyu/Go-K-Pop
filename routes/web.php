<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\SortingController;
use App\Http\Controllers\StoreSettingController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::post('/register', [AuthController::class, 'store'])->name('register');
// member
Route::get('/member/catalog', [AlbumController::class, 'memberCatalog'])->name('member.catalog');
Route::get('/member/catalog/form/{album}', [AlbumController::class, 'showFormPembelian'])->name('member.form.pembelian');
Route::post('/member/orders', [OrderController::class, 'store'])->name('member.orders.store');
Route::get('/member/pesanan', [DashboardController::class, 'memberDashboard'])->name('member.pesanan');
Route::get('/member/wishlist', [WishlistController::class, 'memberWishlist'])->name('member.wishlist');
Route::get('/member/profile', [ProfileController::class, 'memberProfile'])->name('member.profile');
// admin
Route::get('/admin/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/campaign', [CampaignController::class, 'adminCampaign'])->name('admin.campaign');
Route::post('/admin/campaign', [CampaignController::class, 'store'])->name('admin.store');
Route::put('/admin/campaign/{album}', [CampaignController::class, 'update'])->name('admin.update');

Route::get('/admin/payment', [AdminPaymentController::class, 'adminPayment'])->name('admin.payment');
Route::get('/admin/order', [AdminOrderController::class, 'adminOrder'])->name('admin.order');
Route::get('/admin/sortingpc', [SortingController::class, 'adminSortingPc'])->name('admin.sorting');
Route::get('/admin/shipment', [ShipmentController::class, 'adminShipment'])->name('admin.shipment');
Route::get('/admin/store-setting', [StoreSettingController::class, 'adminStoreSetting'])->name('admin.setting');