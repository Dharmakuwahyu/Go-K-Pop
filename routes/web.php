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
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('member')->group(function () {
// member
    Route::get('/member/catalog', [AlbumController::class, 'memberCatalog'])->name('member.catalog');
    Route::get('/member/catalog/form/{album}', [AlbumController::class, 'showFormPembelian'])->name('member.form.pembelian');
    Route::post('/member/wishlist/toggle', [WishlistController::class, 'toggle'])->name('member.wishlist.toggle');
    Route::post('/member/orders', [OrderController::class, 'store'])->name('member.orders.store');
    Route::get('/member/pesanan', [DashboardController::class, 'memberDashboard'])->name('member.pesanan');
    Route::post('/member/payments/upload', [PaymentController::class, 'upload'])->name('member.payment.upload');
    Route::get('/member/wishlist', [WishlistController::class, 'memberWishlist'])->name('member.wishlist');
    Route::get('/member/profile', [ProfileController::class, 'memberProfile'])->name('member.profile');
});

Route::middleware('admin')->group(function () {
// admin
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/campaign', [CampaignController::class, 'adminCampaign'])->name('admin.campaign');
    Route::post('/admin/campaign', [CampaignController::class, 'store'])->name('admin.store');
    Route::put('/admin/campaign/{album}', [CampaignController::class, 'update'])->name('admin.update');

    Route::get('/admin/payment', [AdminPaymentController::class, 'adminPayment'])->name('admin.payment');
    Route::post('/admin/payment/{payment}/approve', [AdminPaymentController::class, 'approve'])->name('admin.payment.approve');
    Route::post('/admin/payment/{payment}/reject', [AdminPaymentController::class, 'reject'])->name('admin.payment.reject');
    Route::get('/admin/order', [AdminOrderController::class, 'adminOrder'])->name('admin.order');
    Route::get('/admin/sortingpc', [SortingController::class, 'adminSortingPc'])->name('admin.sorting');
    Route::post('/admin/sortingpc/process', [SortingController::class, 'processSorting'])->name('admin.sorting.process');
    Route::get('/admin/shipment', [ShipmentController::class, 'adminShipment'])->name('admin.shipment');
    Route::post('/admin/shipment/update-resi', [ShipmentController::class, 'updateResi'])->name('admin.shipment.updateResi');
    Route::get('/admin/store-setting', [StoreSettingController::class, 'adminStoreSetting'])->name('admin.setting');
});
