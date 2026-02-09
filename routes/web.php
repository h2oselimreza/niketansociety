<?php

use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\ModuleGroupController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('users',[UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users-data', [UserController::class, 'getUsers'])->name('users.data.index');

    Route::get('user-groups',[UserGroupController::class, 'index'])->name('admin.user-groups.index');
    Route::get('/user-groups-data', [UserGroupController::class, 'getUserGroups'])->name('user-groups.data.index');

    Route::get('/module-group',[ModuleGroupController::class, 'index'])->name('admin.module-group.index');
    Route::get('/module-group-data', [ModuleGroupController::class, 'getModuleGroupData'])->name('module-group.data.index');
    Route::get('/module-group-create',[ModuleGroupController::class, 'create'])->name('admin.module-group.create');
    Route::post('/module-group-store',action: [ModuleGroupController::class, 'store'])->name('admin.module-group.store');
    Route::get('/module-group-show',action: [ModuleGroupController::class, 'show'])->name('admin.module-group.show');
    Route::get('/module-group-edit/{id}',action: [ModuleGroupController::class, 'edit'])->name('admin.module-group.edit');
    Route::put('/module-group-update/{id}',action: [ModuleGroupController::class, 'update'])->name('admin.module-group.update');
    Route::delete('/module-group-destroy/{id}',action: [ModuleGroupController::class, 'destroy'])->name(name: 'admin.module-group.destroy');

    Route::resource('modules', ModuleController::class)
    ->names('admin.modules');
    Route::get('/modules-data', [ModuleController::class, 'getModulesData'])->name('modules.data.index');
    Route::get('/module-groups/{panel}', [ModuleController::class, 'selectModuleData'])->name('select.modules.data');

                        
});

require __DIR__.'/auth.php';
