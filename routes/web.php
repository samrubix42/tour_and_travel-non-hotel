<?php

use App\Livewire\Admin\Banner\BannerManagement;
use App\Livewire\Admin\Blog\Category\BlogCategoryList;
use App\Livewire\Admin\Category\CategoryList;
use App\Livewire\Admin\Destination\DestinationList;
use App\Livewire\Admin\Hotel\Category\HotelCategoryList;
use App\Livewire\Admin\Hotel\Hotel\HotelList;
use App\Livewire\Auth\AdminLogin;
use App\Livewire\Admin\Dashboard\Dashboard;
use App\Livewire\Admin\Enquires\Hotel as EnquiresHotel;
use App\Livewire\Admin\Enquires\Tour as EnquiresTour;
use App\Livewire\Admin\Experience\ExperinceList;
use App\Livewire\Admin\Hotel\Hotel\AddHotel;
use App\Livewire\Admin\Hotel\Hotel\UpdateHotel;
use App\Livewire\Admin\PageManagement\PageList;
use App\Livewire\Admin\Setting;
use App\Livewire\Public\About;
use App\Livewire\Public\Blog\Blog;
use App\Livewire\Public\Blog\BlogView;
use App\Livewire\Public\Contact;
use App\Livewire\Public\Destination\Destination;
use App\Livewire\Public\Home\Home;
use App\Livewire\Public\Tour\Tour;
use App\Livewire\Public\Tour\TourView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Tour\TourPackageList;
use App\Livewire\Admin\Tour\AddTourPackage;
use App\Livewire\Admin\Tour\UpdateTourPackage;
use App\Livewire\Public\Experience\Experience;

Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/tour', Tour::class)->name('tour');
Route::get('/tour/{slug}', TourView::class)->name('tour.view');
Route::get('/blog', Blog::class)->name('blog');
Route::get('/blog/{slug}', BlogView::class)->name('blog.view');
Route::get('destination', Destination::class)->name('destination');
Route::get('experience', Experience::class)->name('experience');
Route::get('hotels', \App\Livewire\Public\Hotel\Hotel::class)->name('hotels');
Route::get('hotel/{slug}', \App\Livewire\Public\Hotel\HotelView::class)->name('hotel.view');


Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::prefix('enquire')->name('enquire.')->group(function () {
        Route::get('tour', EnquiresTour::class)->name('tour.contact.list');
        Route::get('hotel', EnquiresHotel::class)->name('hotel.contact.list');
    });
    Route::prefix('tour')->name('tour.')->group(function () {

        Route::get('/category', CategoryList::class)->name('category.list');
        Route::get('/destination', DestinationList::class)->name('destination.list');
        Route::get('/experience', ExperinceList::class)->name('experience.list');
        // tour packages
        Route::get('/packages', TourPackageList::class)->name('package.list');
        Route::get('/packages/create', AddTourPackage::class)->name('package.create');
        Route::get('/packages/{id}/edit', UpdateTourPackage::class)->name('package.edit');
    });
    Route::get('page-list', PageList::class)->name('page.management');
    Route::get('/pages/create', \App\Livewire\Admin\PageManagement\AddPageContent::class)->name('page.create');
    Route::get('/pages/{id}/edit', \App\Livewire\Admin\PageManagement\UpdatePageContent::class)->name('page.edit');
    //blog routes
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/category', BlogCategoryList::class)->name('category.list');
        // posts
        Route::get('/posts', \App\Livewire\Admin\Blog\Post\PostList::class)->name('post.list');
        Route::get('/posts/create', \App\Livewire\Admin\Blog\Post\AddPost::class)->name('post.create');
        Route::get('/posts/{id}/edit', \App\Livewire\Admin\Blog\Post\UpdatePost::class)->name('post.edit');
    });
    Route::get('/settings', Setting::class)->name('settings');
    //hotel routes
    Route::prefix('hotel')->name('hotel.')->group(function () {
        Route::get('/category', HotelCategoryList::class)->name('category.list');
        Route::get('/', HotelList::class)->name('list');
        Route::get('/create', AddHotel::class)->name('create');
        Route::get('/{id}/edit', UpdateHotel::class)->name('edit');
    });
    Route::get('/banners', BannerManagement::class)->name('banners');
});

Route::get('/login', AdminLogin::class)->name('login');

Route::get('logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');
