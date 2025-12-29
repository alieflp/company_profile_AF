<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\WebController;
use App\Http\Controllers\AdminWebController;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\AboutUs;
use App\Models\BlogPost;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\TestimonialPublicController;
use App\Http\Controllers\LegalPageController;
use App\Http\Controllers\AdminLegalPageController;
use App\Http\Controllers\PasswordResetController;

// Public web pages (Blade) — named routes
Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::get('/services', [WebController::class, 'servicesIndex'])->name('services.index.public');
Route::get('/portfolios', [WebController::class, 'portfoliosIndex'])->name('portfolios.index.public');
Route::get('/portfolios/{portfolio:slug}', [WebController::class, 'portfoliosShow'])->name('portfolios.show.public');
Route::get('/testimonials', [WebController::class, 'testimonialsIndex'])->name('testimonials.index.public');
Route::get('/testimonials/submit', [TestimonialPublicController::class, 'create'])->name('testimonials.submit.form');
Route::post('/testimonials/submit', [TestimonialPublicController::class, 'store'])->name('testimonials.submit');
Route::get('/blog', [WebController::class, 'blogIndex'])->name('blog.index.public');
Route::get('/blog/{blogPost:slug}', [WebController::class, 'blogShow'])->name('blog.show.public');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');

// Legal pages
Route::get('/privacy-policy', [LegalPageController::class, 'show'])->defaults('type', 'privacy-policy')->name('legal.show.privacy');
Route::get('/terms-of-service', [LegalPageController::class, 'show'])->defaults('type', 'terms-of-service')->name('legal.show.terms');
Route::get('/legal/{type}', [LegalPageController::class, 'show'])->name('legal.show');

// Web form submit — reuse existing public controller (adjust later for redirects)
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');

// (Optional) JSON endpoints were removed from web to avoid route clutter.

// Auth endpoints (issue/revoke tokens)
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

// Password Reset Routes
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// Removed admin API resource routes from web to prevent conflicts with admin views.

// Admin web views + form submissions (session based middleware)
Route::name('admin.')->prefix('admin')->middleware(\App\Http\Middleware\AdminSessionAuth::class)->group(function () {
    Route::get('/', [AdminWebController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [AdminWebController::class, 'settingsIndex'])->name('settings.index');
        // Redirect old email settings URL to main settings page
        Route::get('/settings/email', function() {
            return redirect()->route('admin.settings.index')->with('activeTab', 'email');
        })->name('settings.email');
        Route::put('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
        Route::put('/settings/email', [AdminSettingsController::class, 'updateEmailConfig'])->name('settings.email.update');
        Route::post('/settings/email/test', [AdminSettingsController::class, 'testEmail'])->name('settings.email.test');
        // Account settings
        Route::put('/account/update-email', [AdminSettingsController::class, 'updateEmail'])->name('account.update-email');
        Route::put('/account/update-password', [AdminSettingsController::class, 'updatePassword'])->name('account.update-password');
    Route::get('/about', [AdminWebController::class, 'aboutEdit'])->name('about.edit');

    Route::get('/services', [AdminWebController::class, 'servicesIndex'])->name('services.index');
    Route::get('/services/create', [AdminWebController::class, 'servicesCreate'])->name('services.create');
    Route::get('/services/{id}/edit', [AdminWebController::class, 'servicesEdit'])->name('services.edit');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('/portfolios', [AdminWebController::class, 'portfoliosIndex'])->name('portfolios.index');
    Route::get('/portfolios/create', [AdminWebController::class, 'portfoliosCreate'])->name('portfolios.create');
    Route::get('/portfolios/{id}/edit', [AdminWebController::class, 'portfoliosEdit'])->name('portfolios.edit');
    Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');

    Route::get('/testimonials', [AdminWebController::class, 'testimonialsIndex'])->name('testimonials.index');
    Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    if (config('features.blog')) {
        Route::get('/blog', [AdminWebController::class, 'blogIndex'])->name('blog.index');
        Route::get('/blog/create', [AdminWebController::class, 'blogCreate'])->name('blog.create');
        Route::get('/blog/{id}/edit', [AdminWebController::class, 'blogEdit'])->name('blog.edit');
        Route::post('/blog', [BlogPostController::class, 'store'])->name('blog.store');
        Route::put('/blog/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.destroy');
    }

    Route::get('/contacts', [AdminWebController::class, 'contactsIndex'])->name('contacts.index');
        Route::get('/contacts/{id}', [AdminWebController::class, 'contactsShow'])->name('contacts.show');
    
    // Legal Pages Management
    Route::get('/legal', [AdminLegalPageController::class, 'index'])->name('legal.index');
    Route::get('/legal/{type}/edit', [AdminLegalPageController::class, 'edit'])->name('legal.edit');
    Route::put('/legal/{type}', [AdminLegalPageController::class, 'update'])->name('legal.update');
    
    // About Us single record update (store & update) reuse AboutUsController
    Route::post('/about-us', [AboutUsController::class, 'store'])->name('about.store');
    Route::put('/about-us/{aboutUs}', [AboutUsController::class, 'update'])->name('about.update');
});

// Admin login page (simple blade)
Route::get('/admin/login', function () {
    return view('auth.login');
})->name('admin.login');
