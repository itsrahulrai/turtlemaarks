<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductBookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Frontend  Route Starts
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    return view('frontend.layouts.layout');
})->name('home');


Route::get('/login',function(){
    return view('auth.login');
})->name('login');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::view('/about-us', 'frontend.about-us')->name('about-us');
Route::view('/pta-pure-tone-audiometry', 'frontend.pta-pure-tone-audiometry')->name('pta-pure-tone-audiometry');
Route::view('/tymp-tympanometry', 'frontend.tymp-tympanometry')->name('tymp-tympanometry');
Route::view('/bera-brain-evoked-response-audiometry', 'frontend.bera-brain-evoked-response-audiometry')->name('bera-brain-evoked-response-audiometry');
Route::view('/oae-oto-acoustic-emission', 'frontend.oae-oto-acoustic-emission')->name('oae-oto-acoustic-emission');
Route::view('/products', 'frontend.products')->name('products');
Route::view('/repair', 'frontend.repair')->name('repair');
Route::view('/gallery', 'frontend.gallery')->name('gallery');
Route::view('/contact-us', 'frontend.contact-us')->name('contact-us');

Route::view('/terms-and-conditions', 'frontend.terms-and-conditions')->name('terms-and-conditions');
Route::view('/privacy-statement', 'frontend.privacy-statement')->name('privacy-statement');
Route::view('/return-refund-policy', 'frontend.return-refund-policy')->name('return-refund-policy');
Route::view('/shipping-policy', 'frontend.shipping-policy')->name('shipping-policy');
Route::view('/widex-hearing-aid-clinic-in-noida-extension', 'frontend.widex-hearing-aid-clinic-in-noida-extension')->name('widex-hearing-aid-clinic-in-noida-extension');
Route::view('/pta-test-in-noida-extension', 'frontend.pta-test-in-noida-extension')->name('pta-test-in-noida-extension');
Route::view('/oae-test-in-gaur-city', 'frontend.oae-test-in-gaur-city')->name('oae-test-in-gaur-city');
Route::view('/hearing-test-in-noida-extension', 'frontend.hearing-test-in-noida-extension')->name('hearing-test-in-noida-extension');
Route::view('/hearing-aid-clinic-in-noida-extension', 'frontend.hearing-aid-clinic-in-noida-extension')->name('hearing-aid-clinic-in-noida-extension');
Route::view('/bera-test-in-noida-extension', 'frontend.bera-test-in-noida-extension')->name('bera-test-in-noida-extension');

Route::view('/audiologist-in-gaur-city', 'frontend.audiologist-in-gaur-city')->name('audiologist-in-gaur-city');


Route::view('/oticon-hearing-aid-clinic-in-noida-extension', 'frontend.oticon-hearing-aid-clinic-in-noida-extension')->name('oticon-hearing-aid-clinic-in-noida-extension');
Route::view('/horizon-hearing-aid-clinic-in-noida-extension', 'frontend.horizon-hearing-aid-clinic-in-noida-extension')->name('horizon-hearing-aid-clinic-in-noida-extension');
Route::post('/contact-submit', [HomeController::class, 'contactSubmit'])->name('contact.submit');



Route::post('/contact-send', [HomeController::class, 'contactSubmit'])->name('contact.send');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [HomeController::class, 'show'])->name('blog.details');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('blog.category');

Route::view('/thank-you', 'frontend.thank-you')->name('thankyou');


/*
|--------------------------------------------------------------------------
| Frontend  Route Ends
|--------------------------------------------------------------------------
|
|
*/


/*
|--------------------------------------------------------------------------
| Backend  Route Start
|--------------------------------------------------------------------------
|
|
*/


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('dashboard')->group(function () {
        Route::resource('categories', CategoryController::class);
    });
    Route::prefix('dashboard')->name('admin.')->middleware(['auth'])->group(function () {
        Route::resource('blogs', BlogController::class);
         Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);
         Route::resource('teams', \App\Http\Controllers\Admin\TeamsController::class);
         Route::resource('testimonials',\App\Http\Controllers\Admin\TestimonialController::class);
         Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
    });
    Route::prefix('dashboard')->name('admin.')->group(function () {
        Route::get('/product-bookings', [ProductBookingController::class, 'index'])->name('product.bookings');
        Route::delete('/product-bookings/{id}', [ProductBookingController::class, 'destroy'])->name('product.bookings.destroy');
    });
    Route::prefix('dashboard')->name('admin.')->group(function () {
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
        Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    });

    Route::post('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return back()->with('success', 'Cache cleared successfully!');
})->name('cache.clear')->middleware('auth');

});

Route::get('/{slug}', [HomeController::class, 'pages'])->name('page.details');

require __DIR__ . '/auth.php';



