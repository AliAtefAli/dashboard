<?php

Auth::routes(['verify' => true]);
// Auth
Route::get('/reset_pass', 'Auth\AuthController@resetUserPassword')->name('reset_pass');
Route::post('/get_code', 'Auth\AuthController@getCode')->name('get_code');
Route::get('/code_confirm/{user}', 'Auth\AuthController@codePage')->name('code_confirm');
Route::post('/code_confirmation', 'Auth\AuthController@codeConfirm')->name('set_confirm');
// Verify
Route::group(['middleware' => 'auth'], function() {
    Route::get('user/verify', 'Auth\AuthController@verify')->name('verify.email');
    Route::post('user/verify', 'Auth\AuthController@verifyUser')->name('user.verify');
});
Route::get('/change_language', 'Web\HomeController@change_language')->name('change.language');

Route::group(['middleware' => ['web', 'auth', 'verified'], 'namespace' => 'Web'], function () {
    Route::get('/','HomeController@index')->name('home');

    Route::get('/messages/email', 'MessageController@email')->name('messages.email');
    Route::get('/messages/sms', 'MessageController@sms')->name('messages.sms');
    Route::get('/messages/show/{message}', 'MessageController@show')->name('message.show');
    Route::get('/messages/send', 'MessageController@send')->name('messages.send');
    Route::post('/messages/mark-as-read', 'MessageController@markAsRead')->name('messages.markAsRead');
    Route::delete('/messages/delete', 'MessageController@destroy')->name('messages.destroy');
    Route::post('/messages/mark-all-as-read', 'MessageController@markAllAsRead')->name('messages.markAllAsRead');
    Route::post('/messages/delete-all-as-read', 'MessageController@deleteAll')->name('messages.deleteAll');

    Route::get('/messages/system', 'MessageController@system')->name('messages.system');
    // Route::get('storeConversations', 'MessageController@storeConversations')->name('storeConversations');
    // Route::get('storeConversation/{conv_id?}', 'MessageController@storeConversation')->name('storeConversation');
    Route::post('uploadFile','MessageController@uploadFile')->name('uploadFile');

    // User
    Route::get('/user/profile', 'UserController@profile')->name('user.profile');
    Route::put('/user/profile/update', 'UserController@updateProfile')->name('user.profile.update');
    Route::get('/user/documents', 'UserController@documents')->name('user.documents');
    Route::get('/setting', 'HomeController@setting')->name('site.setting');
    Route::post('/users/change-password/{user}', 'UserController@changePassword')->name('users.changePassword');
    // Notifications
    Route::get('/user/notifications', 'UserController@notifications')->name('user.notifications');
    Route::post('/mark-as-read', 'UserController@markNotification')->name('markNotification');


    // Link
    Route::get('file/download/{file}', 'StepController@downloadFile')->name('file.download');
    Route::get('link/approve/{link}', 'LinkController@approve')->name('link.approve');
    Route::post('link/upload/{link}', 'LinkController@uploadDocument')->name('link.upload');
    // Option
    Route::post('option/approve', 'OptionController@approve')->name('option.approve');
    // Project Step
    Route::post('projectStep/upload/{projectStep}', 'OptionController@uploadDocument')->name('projectStep.upload');
    // Installment
    Route::post('document/upload/{installment}', 'InstallmentController@uploadDocument')->name('installment.upload');
    Route::get('installment/review/{installment}', 'InstallmentController@reviewDocuments')->name('installments.review');
    Route::get('installment/download/{document}', 'InstallmentController@downloadFile')->name('installments.download');
});
