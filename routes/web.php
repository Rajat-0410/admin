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
Route::get('/term-condition', ['as' => 'term-condition', 'uses' => 'Website\WebsiteCommonController@termCondition']);
Route::get('/privacy-policy', ['as' => 'privacy-policy', 'uses' => 'Website\WebsiteCommonController@privacyPolicy']);

Route::group(['prefix' => 'user'], function () {
    Route::post('login', ['as' => 'login', 'uses' => 'User\UserController@login']);
    Route::post('verify/{id}', ['as' => 'verify', 'uses' => 'User\UserController@verify']);
    
    Route::middleware(['UserAuth'])->group(function () {
        // login and register
        Route::post('name', ['as' => 'name', 'uses' => 'User\UserController@store']);
        Route::post('email', ['as' => 'email', 'uses' => 'User\UserController@store']);
        Route::post('logout', ['as' => 'logout', 'uses' => 'User\UserController@logout']);

        //working
        Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'User\UserController@dashboard']);
        // Route::get('/notification', 'UserNotification@index');
        // Route::delete('/notification/{id}', 'UserNotification@delete');

        // //profile
        Route::post('profile', ['as' => 'profile', 'uses' => 'User\UserController@store']);
        Route::get('profile', ['as' => 'profile', 'uses' => 'User\UserController@profile']);
        Route::post('profile/image', ['as' => 'profile/image', 'uses' => 'User\UserController@image']);
        
        Route::get('disease', ['as' => 'disease', 'uses' => 'Disease\DiseaseCategorieController@index']);
        Route::get('disease/category/{id}', ['as' => 'disease/category', 'uses' => 'Disease\DiseaseController@index']);
        // Route::get('/disease', 'DiseaseController@index');
        // Route::get('/disease/category/{id}', 'DiseaseCategorieController@index');
        
        // //medicalrecord
        // Route::get('/medicalrecord', 'UserMedicalRecordController@index');
        // Route::get('/medicalrecord/{id}', 'UserMedicalRecordController@show');
        // Route::post('/medicalrecord', 'UserMedicalRecordController@store');
        // Route::patch('/medicalrecord/{id}', 'UserMedicalRecordController@update');
        
        // //medicalrecordimage
        // Route::post('/medicalrecordimage/{id}', 'UserMedicalRecordImageController@upload');
        // Route::get('/medicalrecordimage/image/{filename}', 'UserMedicalRecordImageController@showImage');

        // //consult
        // Route::post('/consult', 'UserConsultController@store');
        // Route::get('/consult/{id}', 'UserConsultController@show');
        // Route::get('/consult', 'UserConsultController@index');
        // Route::patch('/consult/{id}', 'UserConsultController@update');

        // //consult image
        // Route::post('/consultimage/{consult_id}', 'UserConsultImageController@store');

        // //payment
        // Route::post('/payment', 'PaymentController@store');
    });
});

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
            
    // General Setting => START
    Route::get('general-settings', ['as' => 'general-settings', 'uses' => 'Settings\GeneralSettingsController@index'])->middleware('auth','check-permission');
    Route::post('general-settings/change-settings', ['as' => 'change-settings', 'uses' => 'Settings\GeneralSettingsController@changeSettings'])->middleware('auth','check-permission');
    // General Setting => END

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

    // User Permission => START
    Route::get('user-permission', ['as' => 'user-permission', 'uses' => 'UserPermission\UserPermissionController@index'])->middleware('auth','check-permission');
    Route::get('user-permission/add', ['as' => 'user-permission/add', 'uses' => 'UserPermission\UserPermissionController@add'])->middleware('auth','check-permission');
    Route::get('user-permission/edit/{id}', ['as' => 'user-permission/edit', 'uses' => 'UserPermission\UserPermissionController@edit'])->middleware('auth','check-permission');
    Route::get('user-permission/delete/{id}', ['as' => 'user-permission/delete', 'uses' => 'UserPermission\UserPermissionController@delete'])->middleware('auth','check-permission');
    Route::post('user-permission/store', ['as' => 'user-permission/store', 'uses' => 'UserPermission\UserPermissionController@store'])->middleware('auth','check-permission');
    // User Permission => END

    // Disease => START
    Route::get('disease-category', ['as' => 'disease-category', 'uses' => 'Disease\DiseaseCategorieController@indexAdminList'])->middleware('auth','check-permission');
    Route::get('disease-category/add', ['as' => 'disease-category/add', 'uses' => 'Disease\DiseaseCategorieController@add'])->middleware('auth','check-permission');
    Route::get('disease-category/edit/{id}', ['as' => 'disease-category/edit', 'uses' => 'Disease\DiseaseCategorieController@edit'])->middleware('auth','check-permission');
    Route::get('disease/delete-category/{id}', ['as' => 'disease-category/delete', 'uses' => 'Disease\DiseaseCategorieController@delete'])->middleware('auth','check-permission');
    Route::post('disease-category/store', ['as' => 'disease-category/store', 'uses' => 'Disease\DiseaseCategorieController@store'])->middleware('auth','check-permission');
    
    Route::get('disease-list/{id}', ['as' => 'disease-list', 'uses' => 'Disease\DiseaseController@indexAdminList'])->middleware('auth','check-permission');
    Route::get('disease/edit/{id}', ['as' => 'disease/edit', 'uses' => 'Disease\DiseaseController@edit'])->middleware('auth','check-permission');
    Route::post('disease/store', ['as' => 'disease/store', 'uses' => 'Disease\DiseaseController@store'])->middleware('auth','check-permission');
    // Disease => END

    // Patient => START
    Route::get('patient', ['as' => 'patient', 'uses' => 'PatientManagement\PatientManagementController@index'])->middleware('auth','check-permission');
    Route::get('patient/view/{id}', ['as' => 'patient/view', 'uses' => 'PatientManagement\PatientManagementController@view'])->middleware('auth','check-permission');
    // Patient => END

    // Patient => START
    Route::get('consult/{id}', ['as' => 'consult', 'uses' => 'ConsultManagement\ConsultManagementController@index'])->middleware('auth','check-permission');
    Route::get('consult/view/{id}', ['as' => 'consult/view', 'uses' => 'ConsultManagement\ConsultManagementController@view'])->middleware('auth','check-permission');
    // Patient => END

    // Profile => START
    Route::get('profile', ['as' => 'profile', 'uses' => 'UserManagement\UserManagementController@profile'])->middleware('auth','check-permission');
    Route::post('profile/store', ['as' => 'profile/store', 'uses' => 'UserManagement\UserManagementController@profileStore'])->middleware('auth','check-permission');
    // Profile => END
    
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