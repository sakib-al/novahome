<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventJoinController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

// Other Pages
Route::get('/', [PageController::class, 'homepage'])->name('homepage');

Route::get('contact-us', [PageController::class, 'contactUs'])->name('contactUs');
//Route::post('contact-us', [PageController::class, 'contactUsSubmit']);;

Route::get('page/{slug}',[PageController::class, 'commonPage'])->name('common.page');

Route::get('home/section{home_section}',[PageController::class, 'singleHomeSection'])->name('single.home.page');

Route::get('donate/now',[PageController::class, 'donateMenu'])->name('donate.now');
Route::get('donate/{fund_raiser}program',[PageController::class, 'donateNow'])->name('donate');
Route::get('donation/programs',[PageController::class, 'donateAll'])->name('donation.program');
Route::get('donation/payment/page',[PaymentController::class, 'donation'])->name('donation.payment');
Route::post('donation/pay',[PaymentController::class, 'payment'])->name('donation.pay');

Route::get('event/page{event}', [PageController::class, 'event'])->name('event');
Route::get('event/page/all', [PageController::class, 'eventAll'])->name('event.all');
Route::get('event/page/feature', [PageController::class, 'eventFeature'])->name('event.feature');
Route::get('event/page/upcoming', [PageController::class, 'eventUpcoming'])->name('event.upcoming');
Route::get('event/page/past', [PageController::class, 'eventPast'])->name('event.past');

Route::get('event/join', [EventJoinController::class, 'eventJoin'])->name('event.join');
Route::get('event/payment/page{event_join}', [EventJoinController::class, 'eventPaymentPage'])->name('event.payment.page');
Route::post('event/payment', [EventJoinController::class, 'eventPayment'])->name('event.payment.strip');

Route::get('news/page/all', [PageController::class, 'allNews'])->name('news.all');
Route::get('news/page/{blog}', [PageController::class, 'singleNews'])->name('news.single');

Route::get('vote/all', [PageController::class, 'allVotes'])->name('vote.all');
Route::get('galleries', [PageController::class, 'galleries'])->name('gallery.all');
Route::get('gallery/{gallery}', [PageController::class, 'gallery'])->name('gallery.single');
Route::get('gallery-details',[PageController::class,'galleryDetails'])->name('gallery.details');

Route::get('member/list', [PageController::class, 'memberList'])->name('member.list');

Route::post('vote/store', [VoteController::class, 'store']);

/*
 * contact us related routes
 * */
Route::post('contact/us/store', [\App\Http\Controllers\ContactUsController::class, 'contact'])->name('contact.us.store');

Route::prefix('member')->group(function () {
    Route::get('form', [MemberController::class, 'form'])->name('user.form');
    Route::post('form', [MemberController::class, 'formSubmit']);
    Route::get('member/payment/page', [MemberController::class, 'memberPaymentPage'])->name('member.payment');
    Route::post('member/payment/store', [MemberController::class, 'memberPaymentStore'])->name('member.payment.store');

    Route::get('dashboard',[MemberController::class,'memberDashboard'])->name('memberDashboard');
    Route::get('profile',[MemberController::class, 'memberProfile'])->name('member.profile');
    Route::post('profile/update',[MemberController::class, 'memberUpdate'])->name('member.profile.update');
    Route::post('profile/password/update',[MemberController::class, 'updatePassword'])->name('member.password.update');
    Route::get('contribution',[MemberController::class, 'memberContribution'])->name('member.contribution');
    Route::get('event/join',[MemberController::class, 'memberEventJoin'])->name('member.event_join');
});

// Auth Routes
Auth::routes();
Route::post('register', [AuthController::class, 'registerSubmit']);
Route::get('email-verify/{id}', [AuthController::class, 'emailVerify'])->name('emailVerify');
Route::get('resend-email-verify/{id}', [AuthController::class, 'resendVerifyLink'])->name('resendVerifyLink');
Route::get('email-verify-check/{id}', [AuthController::class, 'emailVerifyCheck'])->name('emailVerifyCheck');

// Test Routes
// Route::get('test',             [TestController::class, 'test'])->name('test');
Route::get('cache-clear',      [TestController::class, 'cacheClear'])->name('cacheClear');
Route::get('config',           [TestController::class, 'config'])->name('config');
