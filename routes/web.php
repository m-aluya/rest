<?php

use App\Http\Controllers\AdminUser\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashController;




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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/logi', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/transactions', [DashController::class, 'index'])->name('transactions')->middleware('auth');
Route::get('/transactions/{id}/details', [DashController::class, 'details'])->name('details')->where(array('id' => '[0-9]+'));
Route::get('/payment/{id}/details', [DashController::class, 'paymentDetails'])->name('payment.details')->where(array('id' => '[0-9]+'))->middleware('auth');

Route::get('/payments', [DashController::class, 'payments'])->name('payments')->middleware('auth');
Route::get('/orders', [DashController::class, 'order'])->name('orders')->middleware('auth');
Route::get('/orders/{id}/details', [DashController::class, 'orderDetails'])->name('order.details')->where(array('id' => '[0-9]+'));

//invoices
Route::get('/invoices', [DashController::class, 'invoices'])->name('invoices')->middleware('auth');
Route::get('/invoices/{id}/details', [DashController::class, 'inDetails'])->name('invoices.details')->where(array('id' => '[0-9]+'))->middleware('auth');

//disputes
Route::get('/disputes', [DashController::class, 'disputes'])->name('disputes')->middleware('auth');
Route::get('/disputes/{id}/details', [DashController::class, 'disputeDetails'])->name('dispute.details')->where(array('id' => '[0-9]+'))->middleware('auth');
Route::post('/disputes/{id}/details', [DashController::class, 'resolveDispute'])->name('resolve')->where(array('id' => '[0-9]+'))->middleware('auth');


//shipments
Route::get('/shipment', [DashController::class, 'shipment'])->name('shipment.all')->middleware('auth');
Route::get('/shipment/{md}', [DashController::class, 'shipmentBooked'])->name('shipmet.status');
Route::get('/shipment/{id}/details', [DashController::class, 'shipmentDetails'])->name('shipment.details')->where(array('id' => '[0-9]+'))->middleware('auth');



//Audit trails
Route::get('/audit', [DashController::class, 'audit_trails'])->name('audit')->middleware('auth');
Route::get('/audit/{id}/details', [DashController::class, 'auditdetails'])->name('audit.details')->middleware('auth');
//Audit transactions
Route::get('/audit/transactions', [DashController::class, 'index'])->name('audit.transaction')->middleware('auth');
Route::get('/audit/orders', [DashController::class, 'order'])->name('audit.order')->middleware('auth');
Route::get('/audit/invoice', [DashController::class, 'invoices'])->name('audit.invoice')->middleware('auth');

//users
Route::get('/users', [DashController::class, 'users'])->name('users')->middleware('auth');
Route::get('/customers/{id}/details', [DashController::class, 'auditdetails'])->name('audit.details')->middleware('auth');


//users
Route::get('/customers/{type}', [DashController::class, 'customers'])->name('customers')->middleware('auth');
Route::get('/customer/get', [DashController::class, 'addCustomerForm'])->name('customer.add.get')->middleware('auth');
Route::post('/customer/add', [DashController::class, 'addCustomer'])->name('customer.add')->middleware('auth');
Route::get('/customers/{id}/details', [DashController::class, 'customerdetails'])->name('cdetails')->middleware('auth');
Route::post('/customers/{id}/details', [DashController::class, 'block'])->name('customer.block')->middleware('auth');


//Admin users
Route::get('/admin', [AdminController::class, 'admin'])->name('admins')->middleware('auth');
Route::post('/admin', [AdminController::class, 'saveAdmin'])->name('admin.post')->middleware('auth');

Route::get('/admins', [AdminController::class, 'getAdmins'])->name('admin.manage')->middleware('auth');
Route::get('/admins/{id}/details', [AdminController::class, 'show'])->name('admin.show')->middleware('auth');
Route::get('/admins/{id}/delete', [AdminController::class, 'delete'])->name('admin.delete')->middleware('auth');


Route::get('/password', [AdminController::class, 'password'])->name('password')->middleware('auth');

Route::get('/filter/data', [DashController::class, 'filterTransaction'])->name('filter')->middleware('auth');


//Route::get('/download_order', [DashController::class, 'downloadOrder'])->name('download.order')->middleware('auth');
