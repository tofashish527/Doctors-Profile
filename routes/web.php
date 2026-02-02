<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\BannerSettingController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\HomeController;

// Frontend route

// Route::get('/', function () {
//     return view('welcome');
// });

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

     // Contact Info Routes
        Route::get('/contact', [ContactInfoController::class, 'index'])->name('admin.contact-info.index');
        Route::get('/contact/create', [ContactInfoController::class, 'create'])->name('admin.contact-info.create');
        Route::post('/contact', [ContactInfoController::class, 'store'])->name('admin.contact-info.store');
        Route::get('/contact/{contactInfo}/edit', [ContactInfoController::class, 'edit'])->name('admin.contact-info.edit');
        Route::put('/contact/{contactInfo}', [ContactInfoController::class, 'update'])->name('admin.contact-info.update');
        Route::delete('/contact/{contactInfo}', [ContactInfoController::class, 'destroy'])->name('admin.contact-info.destroy');
  

         Route::get('/messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('admin.messages.show');
    Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('admin.messages.destroy'); 

 // Doctor Profile/Banner Settings
    Route::get('/doctor-profile', [BannerSettingController::class, 'index'])->name('admin.banner.index');
    Route::post('/doctor-profile/update', [BannerSettingController::class, 'update'])->name('admin.banner.update');
    Route::post('/doctor-profile/update-expertise', [BannerSettingController::class, 'updateExpertise'])->name('admin.banner.updateExpertise');
    Route::post('/doctor-profile/upload-image', [BannerSettingController::class, 'uploadImage'])->name('admin.banner.uploadImage');
    Route::post('/doctor-profile/upload-video', [BannerSettingController::class, 'uploadVideo'])->name('admin.banner.uploadVideo');
    Route::delete('/doctor-profile/delete-video', [BannerSettingController::class, 'deleteVideo'])->name('admin.banner.deleteVideo');
   
      // Education & Experience Management Pages
    Route::get('/doctor-profile/educations', [BannerSettingController::class, 'educations'])->name('admin.banner.educations');
    Route::get('/doctor-profile/experiences', [BannerSettingController::class, 'experiences'])->name('admin.banner.experiences');
    // // Education Routes
    Route::post('/doctor-profile/education', [BannerSettingController::class, 'storeEducation'])->name('admin.banner.storeEducation');
    Route::put('/doctor-profile/education/{education}', [BannerSettingController::class, 'updateEducation'])->name('admin.banner.updateEducation');
    Route::delete('/doctor-profile/education/{education}', [BannerSettingController::class, 'deleteEducation'])->name('admin.banner.deleteEducation');
    
    // Experience Routes
    Route::post('/doctor-profile/experience', [BannerSettingController::class, 'storeExperience'])->name('admin.banner.storeExperience');
    Route::put('/doctor-profile/experience/{experience}', [BannerSettingController::class, 'updateExperience'])->name('admin.banner.updateExperience');
    Route::delete('/doctor-profile/experience/{experience}', [BannerSettingController::class, 'deleteExperience'])->name('admin.banner.deleteExperience');

    Route::get('/doctor-profile/awards', [BannerSettingController::class, 'awards'])->name('admin.banner.awards');
    Route::post('/doctor-profile/awards', [BannerSettingController::class, 'storeAward'])->name('admin.banner.storeAward');
    Route::put('/doctor-profile/awards/{award}', [BannerSettingController::class, 'updateAward'])->name('admin.banner.updateAward');
    Route::delete('/doctor-profile/awards/{award}', [BannerSettingController::class, 'deleteAward'])->name('admin.banner.deleteAward');

     Route::get('/settings', [SiteSettingsController::class, 'index'])
        ->name('admin.settings.index');
        Route::put('/settings', [SiteSettingsController::class, 'update'])
        ->name('admin.settings.update');
          Route::delete('/settings/delete-logo', [SiteSettingsController::class, 'deleteLogo'])
        ->name('admin.settings.delete-logo');
    });

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/', [HomeController::class, 'index'])->name('home');
