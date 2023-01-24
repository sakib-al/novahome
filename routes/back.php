<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\BlogController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Back\DonationController;
use App\Http\Controllers\Back\EventController;
use App\Http\Controllers\Back\FrontendController;
use App\Http\Controllers\Back\FundRaiserController;
use App\Http\Controllers\Back\GalleryController;
use App\Http\Controllers\Back\HomeSectionController;
use App\Http\Controllers\Back\MemberTypeController;
use App\Http\Controllers\Back\MenuController;
use App\Http\Controllers\Back\NotificationController;
use App\Http\Controllers\Back\OtherPageController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Back\ReunionController;
use App\Http\Controllers\Back\SliderController;
use App\Http\Controllers\Back\VoteController;
use App\Http\Controllers\Back\MemberController;
use App\Http\Controllers\Back\ReportController;
use App\Http\Controllers\Back\TeamController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

// Auth
// Route::get('login',             [AuthController::class, 'login'])->name('back.login');

Route::middleware('auth', 'isAdmin')->group(function () {
    // Other pages
    Route::get('/', [OtherPageController::class, 'dashboard']);
    Route::get('dashboard', [OtherPageController::class, 'dashboard'])->name('dashboard');

    // Page CRUD
    Route::get('pages/remove-image/{page}', [PageController::class, 'removeImage'])->name('admin.pages.removeImage');
    Route::resource('pages', PageController::class, ['as' => 'back']);

    // Event CRUD
    Route::get('events/remove-image/{event}', [EventController::class, 'removeImage'])->name('back.events.removeImage');
    Route::resource('events', EventController::class, ['as' => 'back']);
    Route::get('event/response{event}', [EventController::class, 'eventResponse'])->name('back.event.response');

    Route::put('/event/member/status/change{event_join}', [EventController::class, 'eventMemberStatusChange']);

    // Vote CRUD
    Route::get('votes/remove-image/{vote}', [VoteController::class, 'removeImage'])->name('back.votes.removeImage');
    Route::post('votes/question/create', [VoteController::class, 'questionCreate'])->name('back.votes.questionCreate');
    Route::get('votes/question/delete/{id}', [VoteController::class, 'questionDelete'])->name('back.votes.questionDelete');
    Route::post('votes/question/edit-ajax', [VoteController::class, 'questionEditAjax'])->name('back.votes.questionEditAjax');
    Route::post('votes/question/update', [VoteController::class, 'questionUpdate'])->name('back.votes.questionUpdate');
    Route::resource('votes', VoteController::class, ['as' => 'back']);

    // Reunion CRUD
    Route::get('reunions/remove-image/{reunion}', [ReunionController::class, 'removeImage'])->name('back.reunions.removeImage');
    Route::post('reunions/input/create/{id}', [ReunionController::class, 'inputCreate'])->name('back.reunions.inputCreate');
    Route::get('reunions/input/delete/{id}', [ReunionController::class, 'inputDelete'])->name('back.reunions.inputDelete');
    Route::post('reunions/input/edit-ajax', [ReunionController::class, 'inputEdit'])->name('back.reunions.inputEdit');
    Route::post('reunions/input/update', [ReunionController::class, 'inputUpdate'])->name('back.reunions.inputUpdate');
    Route::resource('reunions', ReunionController::class, ['as' => 'back']);

    // Fund Raiser CRUD
    Route::get('fund-raisers/remove-image/{fundRaiser}', [FundRaiserController::class, 'removeImage'])->name('back.fund-raisers.removeImage');
    Route::resource('fund-raisers', FundRaiserController::class, ['as' => 'back']);
    Route::get('donation/{fundraiser}list', [FundRaiserController::class, 'donationList'])->name('back.donation.list_l');

    /* gallery related routes */
    Route::post('galleries/upload-photo/{id}', [GalleryController::class, 'uploadPhoto'])->name('back.galleries.uploadPhoto');
    Route::get('galleries/delete-photo/{id}', [GalleryController::class, 'deletePhoto'])->name('back.galleries.deletePhoto');
    Route::post('galleries/change-photo-position', [GalleryController::class, 'changePhotoPosition'])->name('back.galleries.changePhotoPosition');
    Route::get('galleries/category', [GalleryController::class, 'category'])->name('back.galleries.category');
    Route::get('galleries/category/create', [GalleryController::class, 'categoryCreate'])->name('back.galleries.categoryCreate');
    Route::resource('galleries', GalleryController::class, ['as' => 'back']);

    /*donation related routes*/
    Route::get('donation', [DonationController::class, 'index'])->name('back.donation.index');
    Route::get('donation/form', [DonationController::class, 'donationForm'])->name('back.donation.form');
    Route::post('donation/form/store/update', [DonationController::class, 'donationStoreUpdate'])->name('back.donation.storeUpdate');

    // Member CRUD
    Route::get('members/remove-image/{user}', [MemberController::class, 'removeImage'])->name('back.members.removeImage');
    Route::get('members/profile{user}', [MemberController::class, 'memberProfile'])->name('back.members.profile');
    Route::resource('members', MemberController::class, ['as' => 'back']);
    Route::resource('teams', TeamController::class, ['as' => 'back']);

    /*
     * member type related route
     * */
    Route::get('members/type/all', [MemberTypeController::class, 'index'])->name('back.member.type.index');
    Route::get('members/type/create', [MemberTypeController::class, 'create'])->name('back.member.type.create');
    Route::post('members/type/store', [MemberTypeController::class, 'store'])->name('back.member.type.store');
    Route::get('members/type/edit{member_type}', [MemberTypeController::class, 'edit'])->name('back.member.type.edit');
    Route::post('members/type/update{member_type}', [MemberTypeController::class, 'update'])->name('back.member.type.update');
    Route::delete('members/type/remove', [MemberTypeController::class, 'destroy'])->name('back.member.type.delete');


    // Category CRUD
    Route::get('categories/remove-image/{category}', [CategoryController::class, 'removeImage'])->name('back.categories.removeImage');
    Route::get('categories/delete/{category}', [CategoryController::class, 'delete'])->name('back.categories.delete');
    Route::get('categories/get-sub-options', [CategoryController::class, 'getSubOptions'])->name('back.categories.getSubOptions');
    Route::post('categories/update-ajax', [CategoryController::class, 'updateAjax'])->name('back.categories.updateAjax');
    Route::resource('categories', CategoryController::class, ['as' => 'back']);

    // Blog CRUD
    Route::get('blogs/remove-image/{blog}', [BlogController::class, 'removeImage'])->name('back.blogs.removeImage');
    Route::get('blogs/categories', [BlogController::class, 'categories'])->name('back.blogs.categories');
    Route::get('blogs/categories/create', [BlogController::class, 'categoriesCreate'])->name('back.blogs.categories.create');
    Route::resource('blogs', BlogController::class, ['as' => 'back']);

    // report related routes
    Route::get('report/members', [ReportController::class, 'memberReports'])->name('back.report.member');
    Route::get('report/donations', [ReportController::class, 'donations'])->name('back.report.donation');

    // Admin CRUD
    // Update admin profile
    Route::get('profile/update-profile', [AdminController::class, 'update_profile_page'])->name('admin.update-profile');
    Route::post('profile/update-profile/action', [AdminController::class, 'update_profile'])->name('back.admins.update.action');
    Route::post('profile/update-password', [AdminController::class, 'update_password'])->name('admin.password-update');
    Route::get('admins/remove-image/{user}', [AdminController::class, 'removeImage'])->name('back.admins.removeImage');
    Route::resource('admins', AdminController::class, ['as' => 'back']);

    // Media
    Route::get('media/settings', [MediaController::class, 'settings'])->name('back.media.settings');
    Route::post('media/settings', [MediaController::class, 'settingsUpdate']);
    Route::post('media/upload', [MediaController::class, 'upload'])->name('back.media.upload');
    // Image Upload
    Route::post('media/image-upload',  [MediaController::class, 'imageUpload'])->name('imageUpload');

    // Frontend
    Route::get('frontend/general', [FrontendController::class, 'general'])->name('back.frontend.general');
    Route::post('frontend/general', [FrontendController::class, 'generalStore']);

    /*frontend home section controller*/
    Route::get('frontend/section', [HomeSectionController::class, 'index'])->name('back.frontend.section');
    Route::post('frontend/section/store', [HomeSectionController::class, 'store'])->name('back.frontend.section.store');
    Route::get('frontend/section/edit{home_section}', [HomeSectionController::class, 'edit'])->name('back.frontend.section.edit');
    Route::post('frontend/section/update{home_section}', [HomeSectionController::class, 'update'])->name('back.frontend.section.update');
    Route::get('frontend/section/remove{home_section}', [HomeSectionController::class, 'remove'])->name('back.frontend.section.remove');
    Route::post('frontend/section/position/change', [HomeSectionController::class, 'positionUpdate'])->name('back.frontend.section.position.update');
    Route::post('frontend/section/type/store', [HomeSectionController::class, 'sectionTypeStore']);


    Route::post('sliders/position', [SliderController::class, 'position'])->name('back.sliders.position');
    Route::get('sliders/delete/{slider}', [SliderController::class, 'destroy'])->name('back.sliders.delete');
    Route::post('sliders/store', [SliderController::class, 'store']);
    Route::resource('sliders', SliderController::class, ['as' => 'back']);


    // Notification
    Route::get('notification/email', [NotificationController::class, 'email'])->name('back.notification.email');
    Route::get('notification/email/send', [NotificationController::class, 'emailSend'])->name('back.notification.emailSend');
    Route::post('notification/email/send', [NotificationController::class, 'emailSendSubmit']);
    Route::get('notification/email/show/{email}', [NotificationController::class, 'emailShow'])->name('back.notification.emailShow');
    Route::get('members-select-lists', [NotificationController::class, 'selectList'])->name('back.members.selectList');
    Route::get('notification/push', [NotificationController::class, 'push'])->name('back.notification.push');
    Route::post('notification/push', [NotificationController::class, 'pushSend']);

    // Menus
    Route::get('menus', [MenuController::class, 'index'])->name('back.menus.index');
    Route::post('menus/store', [MenuController::class, 'store'])->name('back.menus.store');
    Route::post('menus/store/menu-item', [MenuController::class, 'storeMenuItem'])->name('back.menus.storeMenuItem');
    Route::post('menus/menu-item/position', [MenuController::class, 'menuItemPosition'])->name('back.menus.menuItemPosition');
    Route::get('menus/destroy/{menu}', [MenuController::class, 'destroy'])->name('back.menus.destroy');
    Route::get('menus/item/destroy/{menu_item}', [MenuController::class, 'destroyItem'])->name('back.menus.destroyItem');
    Route::post('menus/item/edit-ajax', [MenuController::class, 'editItemAjax'])->name('back.menus.editItemAjax');
    Route::post('menus/item/update', [MenuController::class, 'updateItem'])->name('back.menus.updateItem');
});
