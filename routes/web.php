<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Cars
    Route::delete('cars/destroy', 'CarsController@massDestroy')->name('cars.massDestroy');
    Route::resource('cars', 'CarsController');

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventsController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');

    Route::get('search-car', 'BookingsController@searchCar')->name('searchCar');
    Route::post('book-car', 'BookingsController@bookCar')->name('bookCar');

    Route::get('my-credits', 'BalanceController@index')->name('balance.index');
    Route::post('add-balance', 'BalanceController@add')->name('balance.add');

    Route::resource('transactions', 'TransactionsController')->only(['index']);
});
