<?php

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

Route::get('/', ['as' => 'home', 'uses' => 'Website\HomeController@index']);
Route::get('/about-us', ['as' => 'about-us', 'uses' => 'Website\HomeController@aboutUs']);
Route::get('/contact-us', ['as' => 'contact-us', 'uses' => 'Website\HomeController@contactUs']);
Route::post('/store-contact-us', ['as' => 'store-contact-us', 'uses' => 'Website\HomeController@storeContactUs']);
// Centers
Route::get('/club-5', ['as' => 'club-5', 'uses' => 'Website\CentersController@club5']);
Route::get('/club-vita', ['as' => 'club-vita', 'uses' => 'Website\CentersController@clubVita']);
Route::get('/crest-club', ['as' => 'crest-club', 'uses' => 'Website\CentersController@crestClub']);
// Membership
Route::get('membership', ['as' => 'membership', 'uses' => 'Website\MembershipController@membership']);
Route::post('membership/store', ['as' => 'membership/store', 'uses' => 'Website\MembershipController@membershipadd']);

// Route::get('/kids', ['as' => 'kids', 'uses' => 'Website\MembershipController@kids']);
// Route::get('/adults', ['as' => 'adults', 'uses' => 'Website\MembershipController@adults']);
// Route::get('/professional', ['as' => 'professional', 'uses' => 'Website\MembershipController@professional']);
// Training
Route::get('/progressive', ['as' => 'progressive', 'uses' => 'Website\TrainingController@progressive']);
Route::get('/beginner', ['as' => 'beginner', 'uses' => 'Website\TrainingController@beginner']);
Route::get('/intermediate', ['as' => 'intermediate', 'uses' => 'Website\TrainingController@intermediate']);
Route::get('/advance', ['as' => 'advance', 'uses' => 'Website\TrainingController@advance']);
Route::get('/personalized-coaching', ['as' => 'personalized-coaching', 'uses' => 'Website\TrainingController@personalizedCoaching']);
// Gallery
Route::get('/tennis-gallery', ['as' => 'tennis-gallery', 'uses' => 'Website\GalleryController@index']);

// Route::get('/pages/{slug}', ['as' => 'pages', 'uses' => 'Website\HomeController@commonPage']);

// Set Admin Routes With Prefix
Route::prefix('admin')->group(function () {
    // ADMIN
    Route::get('authority', ['as' => 'authority', 'uses' => 'Admin\AdminController@signin']);
    Route::get('signout', ['as' => 'signout', 'uses' => 'Admin\AdminController@signout']);
    Route::post('authority', ['as' => 'authority', 'uses' => 'Admin\AdminController@authenticate']);
    
    // Dashboard
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'Admin\AdminController@dashboard'])->middleware('auth','check-permission');
    
    // MENU => START
    Route::get('menu', ['as' => 'menu', 'uses' => 'Menu\MenuController@index'])->middleware('auth','check-permission');
    Route::get('menu/add', ['as' => 'menu/add', 'uses' => 'Menu\MenuController@add'])->middleware('auth','check-permission');
    Route::get('menu/edit/{id}', ['as' => 'menu/edit', 'uses' => 'Menu\MenuController@edit'])->middleware('auth','check-permission');
    Route::get('menu/delete/{id}', ['as' => 'menu/delete', 'uses' => 'Menu\MenuController@delete'])->middleware('auth','check-permission');
    Route::post('menu/store', ['as' => 'menu/store', 'uses' => 'Menu\MenuController@store'])->middleware('auth','check-permission');
    // MENU => END
    
    // POST => START
    Route::get('post', ['as' => 'post', 'uses' => 'Post\PostController@index'])->middleware('auth','check-permission');
    Route::get('post/add', ['as' => 'post/add', 'uses' => 'Post\PostController@add'])->middleware('auth','check-permission');
    Route::get('post/edit/{id}', ['as' => 'post/edit', 'uses' => 'Post\PostController@edit'])->middleware('auth','check-permission');
    Route::get('post/delete/{id}', ['as' => 'post/delete', 'uses' => 'Post\PostController@delete'])->middleware('auth','check-permission');
    Route::post('post/store', ['as' => 'post/store', 'uses' => 'Post\PostController@store'])->middleware('auth','check-permission');
    Route::get('post/category', ['as' => 'post/category', 'uses' => 'Post\PostController@category_index'])->middleware('auth','check-permission');
    // Route::get('post/category/{id?}', ['as' => 'post/category', 'uses' => 'Post\PostController@category_index'])->middleware('auth','check-permission');
    Route::get('post/category/delete/{id}', ['as' => 'post/category', 'uses' => 'Post\PostController@category_delete'])->middleware('auth','check-permission');
    Route::post('post/category/store', ['as' => 'post/category/store', 'uses' => 'Post\PostController@category_store'])->middleware('auth','check-permission');
    // POST => END
    
    // News => START
    Route::get('news', ['as' => 'news', 'uses' => 'News\NewsController@index'])->middleware('auth','check-permission');
    Route::get('news/add', ['as' => 'news/add', 'uses' => 'News\NewsController@add'])->middleware('auth','check-permission');
    Route::get('news/edit/{id}', ['as' => 'news/edit', 'uses' => 'News\NewsController@edit'])->middleware('auth','check-permission');
    Route::get('news/delete/{id}', ['as' => 'news/delete', 'uses' => 'News\NewsController@delete'])->middleware('auth','check-permission');
    Route::post('news/store', ['as' => 'news/store', 'uses' => 'News\NewsController@store'])->middleware('auth','check-permission');
   
    Route::get('news-gallery/{newsId}', ['as' => 'news-gallery', 'uses' => 'News\NewsGalleryController@index'])->middleware('auth','check-permission');
    Route::post('news-gallery/upload', ['as' => 'news-gallery/upload', 'uses' => 'News\NewsGalleryController@uploadImage'])->middleware('auth','check-permission');
    Route::post('news-gallery/delete', ['as' => 'news-gallery/delete', 'uses' => 'News\NewsGalleryController@delete'])->middleware('auth','check-permission');
    // News => END
    
    // PAGES => START
    Route::get('page', ['as' => 'page', 'uses' => 'Page\PageController@index'])->middleware('auth','check-permission');
    Route::get('page/add', ['as' => 'page/add', 'uses' => 'Page\PageController@add'])->middleware('auth','check-permission');
    Route::get('page/edit/{id}', ['as' => 'page/edit', 'uses' => 'Page\PageController@edit'])->middleware('auth','check-permission');
    Route::get('page/delete/{id}', ['as' => 'page/delete', 'uses' => 'Page\PageController@delete'])->middleware('auth','check-permission');
    Route::post('page/store', ['as' => 'page/store', 'uses' => 'Page\PageController@store'])->middleware('auth','check-permission');
    // PAGES => END
    
    // Slider => START
    Route::get('slider', ['as' => 'slider', 'uses' => 'Slider\SliderController@index'])->middleware('auth','check-permission');
    Route::get('slider/add', ['as' => 'slider/add', 'uses' => 'Slider\SliderController@add'])->middleware('auth','check-permission');
    Route::get('slider/edit/{id}', ['as' => 'slider/edit', 'uses' => 'Slider\SliderController@edit'])->middleware('auth','check-permission');
    Route::get('slider/delete/{id}', ['as' => 'slider/delete', 'uses' => 'Slider\SliderController@delete'])->middleware('auth','check-permission');
    Route::post('slider/store', ['as' => 'slider/store', 'uses' => 'Slider\SliderController@store'])->middleware('auth','check-permission');
    Route::get('slider-images/{sliderId}', ['as' => 'slider-images', 'uses' => 'Slider\SliderImagesController@index'])->middleware('auth','check-permission');
    Route::post('slider-images/upload', ['as' => 'slider-images/upload', 'uses' => 'Slider\SliderImagesController@uploadImage'])->middleware('auth','check-permission');
    Route::post('slider-images/delete', ['as' => 'slider-images/delete', 'uses' => 'Slider\SliderImagesController@delete'])->middleware('auth','check-permission');
    // Slider => END
    
    // Media => START
    Route::get('media', ['as' => 'media', 'uses' => 'Media\MediaController@index'])->middleware('auth','check-permission');
    Route::post('media/delete', ['as' => 'media/delete', 'uses' => 'Media\MediaController@delete'])->middleware('auth','check-permission');
    Route::post('media/get-media-images', ['as' => 'media/get-media-images', 'uses' => 'Media\MediaController@getMediaImages'])->middleware('auth','check-permission');
    Route::post('upload-media-image', ['as' => 'upload-media-image', 'uses' => 'Media\MediaController@uploadMediaImage'])->middleware('auth','check-permission');
    // Media => END
            
    // Event Video Gallery => START
    Route::get('general-settings', ['as' => 'general-settings', 'uses' => 'Settings\GeneralSettingsController@index'])->middleware('auth','check-permission');
    Route::post('general-settings/change-settings', ['as' => 'change-settings', 'uses' => 'Settings\GeneralSettingsController@changeSettings'])->middleware('auth','check-permission');
    // Event Video Gallery => END
    // User Management => START
    Route::get('user-management', ['as' => 'user-management', 'uses' => 'UserManagement\UserManagementController@index'])->middleware('auth','check-permission');
    Route::get('user-management/add', ['as' => 'user-management/add', 'uses' => 'UserManagement\UserManagementController@add'])->middleware('auth','check-permission');
    Route::get('user-management/edit/{id}', ['as' => 'user-management/edit', 'uses' => 'UserManagement\UserManagementController@edit'])->middleware('auth','check-permission');
    Route::get('user-management/delete/{id}', ['as' => 'user-management/delete', 'uses' => 'UserManagement\UserManagementController@delete'])->middleware('auth','check-permission');
    Route::post('user-management/store', ['as' => 'user-management/store', 'uses' => 'UserManagement\UserManagementController@store'])->middleware('auth','check-permission');
    // User Management => END
    // User Role => START
    Route::get('user-role', ['as' => 'user-role', 'uses' => 'UserRole\UserRoleController@index'])->middleware('auth','check-permission');
    Route::get('user-role/add', ['as' => 'user-role/add', 'uses' => 'UserRole\UserRoleController@add'])->middleware('auth','check-permission');
    Route::get('user-role/edit/{id}', ['as' => 'user-role/edit', 'uses' => 'UserRole\UserRoleController@edit'])->middleware('auth','check-permission');
    Route::get('user-role/delete/{id}', ['as' => 'user-role/delete', 'uses' => 'UserRole\UserRoleController@delete'])->middleware('auth','check-permission');
    Route::post('user-role/store', ['as' => 'user-role/store', 'uses' => 'UserRole\UserRoleController@store'])->middleware('auth','check-permission');
    // User Role => END
    // User Role => START
    Route::get('user-permission', ['as' => 'user-permission', 'uses' => 'UserPermission\UserPermissionController@index'])->middleware('auth','check-permission');
    Route::get('user-permission/add', ['as' => 'user-permission/add', 'uses' => 'UserPermission\UserPermissionController@add'])->middleware('auth','check-permission');
    Route::get('user-permission/edit/{id}', ['as' => 'user-permission/edit', 'uses' => 'UserPermission\UserPermissionController@edit'])->middleware('auth','check-permission');
    Route::get('user-permission/delete/{id}', ['as' => 'user-permission/delete', 'uses' => 'UserPermission\UserPermissionController@delete'])->middleware('auth','check-permission');
    Route::post('user-permission/store', ['as' => 'user-permission/store', 'uses' => 'UserPermission\UserPermissionController@store'])->middleware('auth','check-permission');
    // User Role => END

    // Gallery => START
    Route::get('gallery', ['as' => 'gallery', 'uses' => 'Gallery\GalleryController@index'])->middleware('auth','check-permission');
    // Route::get('gallery/add', ['as' => 'gallery/add', 'uses' => 'Gallery\GalleryController@add'])->middleware('auth','check-permission');
    // Route::get('gallery/edit/{id}', ['as' => 'gallery/edit', 'uses' => 'Gallery\GalleryController@edit'])->middleware('auth','check-permission');
    // Route::get('gallery/delete/{id}', ['as' => 'gallery/delete', 'uses' => 'Gallery\GalleryController@delete'])->middleware('auth','check-permission');
    // Route::post('gallery/store', ['as' => 'gallery/store', 'uses' => 'Gallery\GalleryController@store'])->middleware('auth','check-permission');
    
    Route::get('gallery-image/{galleryId}', ['as' => 'gallery-image', 'uses' => 'Gallery\GalleryImageController@index'])->middleware('auth','check-permission');
    Route::post('gallery-image/upload', ['as' => 'gallery-image/upload', 'uses' => 'Gallery\GalleryImageController@uploadImage'])->middleware('auth','check-permission');
    Route::post('gallery-image/delete', ['as' => 'gallery-image/delete', 'uses' => 'Gallery\GalleryImageController@delete'])->middleware('auth','check-permission');
    
    Route::get('gallery-video', ['as' => 'gallery-video', 'uses' => 'Gallery\GalleryController@videoIndex'])->middleware('auth','check-permission');
    Route::get('gallery-video/{galleryId}', ['as' => 'gallery-video', 'uses' => 'Gallery\GalleryVideoController@index'])->middleware('auth','check-permission');
    Route::post('gallery-video/uploadThumb', ['as' => 'gallery-video/uploadThumb', 'uses' => 'Gallery\GalleryVideoController@uploadThumb'])->middleware('auth','check-permission');
    Route::post('gallery-video/uploadVideo', ['as' => 'gallery-video/uploadVideo', 'uses' => 'Gallery\GalleryVideoController@uploadVideo'])->middleware('auth','check-permission');
    
    Route::post('gallery-video/get-media-image', ['as' => 'gallery-video/get-media-image', 'uses' => 'Gallery\GalleryVideoController@getMediaImages'])->middleware('auth','check-permission');

    Route::get('gallery-video/add/{galleryId}', ['as' => 'gallery-video/add', 'uses' => 'Gallery\GalleryVideoController@add'])->middleware('auth','check-permission');
    Route::post('gallery-video/store/{galleryId}', ['as' => 'gallery-video/store', 'uses' => 'Gallery\GalleryVideoController@store'])->middleware('auth','check-permission');
    Route::get('gallery-video/edit/{id}', ['as' => 'tournament-gallery-video/edit', 'uses' => 'TournamentGallery\TournamentGalleryVideoController@edit'])->middleware('auth','check-permission');
    Route::get('gallery-video/delete/{galleryId}/{roundId}/{id}', ['as' => 'tournament-gallery-video/delete', 'uses' => 'TournamentGallery\TournamentGalleryVideoController@delete'])->middleware('auth','check-permission');
    
    // Gallery => END
    
    // Action Logs => START
    Route::get('action-logs', ['as' => 'action-logs', 'uses' => 'ActionLog\ActionLogController@index'])->middleware('auth','check-permission');
    Route::get('action-logs/history/{controller}/{recordId?}/{productId?}', ['as' => 'action-logs/history', 'uses' => 'ActionLog\ActionLogController@history'])->middleware('auth','check-permission');
    // Action Logs => END
            
    // ADMIN AJAX => START
    Route::post('change-status', ['as' => 'change-status', 'uses' => 'Ajax\AdminCommonController@change_status'])->middleware('auth','check-permission');   
    // ADMIN AJAX => END
    
});

Route::get('resizeImage', 'ImageController@resizeImage');
Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);

// Clear Cache
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return "Config Cache is cleared";
});
Route::get('/clear-view-cache', function() {
    $exitCode = Artisan::call('view:cache');
    return "View Cache is cleared";
});