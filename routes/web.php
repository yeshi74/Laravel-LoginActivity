<?php
use App\Http\Controllers\Admin\MyUsersController;

Route::redirect('/', '/login')->name('admin.userlogin');

Route::redirect('/home', '/admin');

Auth::routes();

Route::get('admin/users/list', [MyUsersController::class, 'index'])->name('myusers.index');
Route::get('admin/create', [MyUsersController::class, 'create'])->name('myusers.create');
Route::get('admin/edit/{id}', [MyUsersController::class, 'edit'])->name('myusers.edit');
Route::post('admin/users/update/{id}', [MyUsersController::class, 'update'])->name('myusers.update');
Route::post('admin/save', [MyUsersController::class, 'store'])->name('myusers.store');
Route::delete('admin/{id}', [MyUsersController::class, 'destroy'])->name('myusers.delete');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

});

