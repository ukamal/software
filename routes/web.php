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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','Frontend\FrontendController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
	Route::prefix('users')->group(function(){
		Route::get('/add','Backend\UserController@addUser')->name('add-user');
		Route::post('/store','Backend\UserController@store')->name('store-user');
		Route::get('/view','Backend\UserController@viewUser')->name('view-user');
		Route::get('/edit{id}','Backend\UserController@editUser')->name('edit-user');
		Route::post('/update{id}','Backend\UserController@updateUser')->name('update-user');
		Route::get('/delete{id}','Backend\UserController@deleteUser')->name('delete-user');
	});

	Route::prefix('profiles')->group(function(){
	    Route::get('/view','Backend\ProfileController@index')->name('profiles-view');
		Route::get('/edit','Backend\ProfileController@edit')->name('edit-profile');
		Route::post('/store','Backend\ProfileController@update')->name('profiles-update');
		Route::get('/password/view','Backend\ProfileController@passwordView')->name('password-view');
		Route::post('/password/update','Backend\ProfileController@passwordUpdate')->name('password-update');
	});

	Route::prefix('suppliers')->group(function(){
		Route::get('/index','Backend\SupplierController@index')->name('view-supplier');
		Route::get('/create','Backend\SupplierController@create')->name('add-supplier');
		Route::post('/store','Backend\SupplierController@store')->name('store-supplier');
		Route::get('/edit{id}','Backend\SupplierController@edit')->name('edit-supplier');
		Route::post('/update{id}','Backend\SupplierController@update')->name('update-supplier');
		Route::get('/delete{id}','Backend\SupplierController@destroy')->name('delete-supplier');
	});

	Route::prefix('customers')->group(function(){
		Route::get('/view','Backend\CustomerController@view')->name('view-customer');
		Route::get('/add','Backend\CustomerController@add')->name('add-customer');
		Route::post('/store','Backend\CustomerController@store')->name('store-customer');
		Route::get('/edit{id}','Backend\CustomerController@edit')->name('edit-customer');
		Route::post('/update{id}','Backend\CustomerController@update')->name('update-customer');
		Route::get('delete{id}','Backend\CustomerController@delete')->name('delete-customer');
		Route::get('/customer','Backend\CustomerController@creditCustomer')->name('credit-customer');
		Route::get('/customer/pdf','Backend\CustomerController@creditCustomerPdf')->name('credit-customer-pdf');
		Route::get('/envoice/edit{invoice_id}','Backend\CustomerController@editInvoice')->name('customer_edit_invoice');
		Route::post('/envoice/update{invoice_id}','Backend\CustomerController@updateInvoice')->name('customer_update_invoice');
		Route::get('/envoice/details/pdf{invoice_id}','Backend\CustomerController@csDetailsInvoicePdf')->name('customer-details-invoice-pdf');
		Route::get('/paid','Backend\CustomerController@paidCustomer')->name('paid-customer');
		Route::get('/paid/pdf','Backend\CustomerController@paidCustomerPdf')->name('paid-customer-pdf');
		Route::get('/wise/report','Backend\CustomerController@customerReport')->name('customer-report');
		Route::get('/wise/credit/report','Backend\CustomerController@customerCreditReport')->name('customer-wise-credit-report');
		Route::get('/wise/paid/report','Backend\CustomerController@customerPaidReport')->name('customer-wise-paid-report');
	});

	Route::prefix('units')->group(function(){
		Route::get('/view','Backend\UnitsController@view')->name('view-units');
		Route::get('/add','Backend\UnitsController@add')->name('add-units');
		Route::post('/store','Backend\UnitsController@store')->name('store-units');
		Route::get('/edit{id}','Backend\UnitsController@edit')->name('edit-units');
		Route::post('/update{id}','Backend\UnitsController@update')->name('update-units');
		Route::get('/delete{id}','Backend\UnitsController@delete')->name('delete-units');
	});

	Route::prefix('categories')->group(function(){
		Route::get('/view','Backend\CategoryController@view')->name('view-category');
		Route::get('/add','Backend\CategoryController@add')->name('add-category');
		Route::post('/store','Backend\CategoryController@store')->name('store-category');
		Route::get('/edit{id}','Backend\CategoryController@edit')->name('edit-category');
		Route::post('/update{id}','Backend\CategoryController@update')->name('update-category');
		Route::get('/delete{id}','Backend\CategoryController@delete')->name('delete-category');
	});

	Route::prefix('products')->group(function(){
		Route::get('/view','Backend\ProductController@view')->name('view-product');
		Route::get('/add','Backend\ProductController@add')->name('add-product');
		Route::post('/store','Backend\ProductController@store')->name('store-product');
		Route::get('/edit{id}','Backend\ProductController@edit')->name('edit-product');
		Route::post('/update{id}','Backend\ProductController@update')->name('update-product');
		Route::get('/delete{id}','Backend\ProductController@delete')->name('delete-product');
	});

	Route::prefix('purchase')->group(function(){
		Route::get('/view','Backend\PurchaseController@view')->name('view-purchase');
		Route::get('/add','Backend\PurchaseController@add')->name('add-purchase');
		Route::post('/store','Backend\PurchaseController@store')->name('store-purchase');
		Route::get('/delete{id}','Backend\PurchaseController@delete')->name('delete-purchase');
		Route::get('/pending-list','Backend\PurchaseController@pendingList')->name('pending-list');
		Route::get('/purchase-approve{id}','Backend\PurchaseController@approved')->name('purchase-approve');
		Route::get('/daily/report/','Backend\PurchaseController@dailyPurchaseReport')->name('daily-purchase-report');
		Route::get('/report/pdf/','Backend\PurchaseController@dailyPurchaseReportPdf')->name('daily-purchase-report-pdf');
	});

	Route::get('/get-category','Backend\DefaultController@getCategory')->name('get-category');
	Route::get('/get-product','Backend\DefaultController@getProduct')->name('get-product');
	Route::get('/get-stock','Backend\DefaultController@getStock')->name('check-product-stock');

	Route::prefix('invoices')->group(function(){
		Route::get('/view','Backend\InvoiceController@view')->name('view-invoice');
		Route::get('/add','Backend\InvoiceController@add')->name('add-invoice');
		Route::post('/store','Backend\InvoiceController@store')->name('store-invoice');
		Route::get('/edit','Backend\InvoiceController@edit')->name('edit-invoice');
		Route::post('/update','Backend\InvoiceController@update')->name('update-invoice');
		Route::get('/delete/{id}','Backend\InvoiceController@delete')->name('delete-invoice');

		Route::get('/pending-invoice-list','Backend\InvoiceController@invoicePendingList')->name('invoice-pending-list');
		Route::get('/approved/{id}','Backend\InvoiceController@approvedInvoice')->name('invoice-approve');
		Route::post('/approved/store/{id}','Backend\InvoiceController@approvalStore')->name('approval.store');

		//Print Invoice
		Route::get('/print/list','Backend\InvoiceController@invoicePrintList')->name('invoice-print-list');
		Route::get('/invoice/print/{id}','Backend\InvoiceController@invoicePrint')->name('invoice-print');
		//Daily Invoice Report
		Route::get('/daily/report','Backend\InvoiceController@dailyInvoiceReport')->name('daily-invoice-report'); 
		Route::get('/daily/report/pdf','Backend\InvoiceController@dailyReportPdf')->name('daily-report-pdf'); 
	});

	Route::prefix('stocks')->group(function(){
		Route::get('/report','Backend\StockController@stockReport')->name('report-stock');
		Route::get('/report/pdf','Backend\StockController@stockReportPdf')->name('report-stock-pdf');
		Route::get('/report/sp/wise','Backend\StockController@supplierProductWise')->name('stock-report-supplier-product-wise');
		Route::get('/report/supplier/wise/pdf','Backend\StockController@supplierWisePdf')->name('stock-report-supplier-wise-pdf');
		Route::get('/report/product/wise/pdf','Backend\StockController@productWisePdf')->name('stock-report-product-wise-pdf');
	});


});
