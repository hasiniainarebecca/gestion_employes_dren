<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Mail\TestEmail;

Route::get('/',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
Route::post('/',[AuthController::class,'handleLogin'])->name('handleLogin');
Route::get('/validate-account/{email}',[AdminController::class,'defineAccess']);
Route::post('/validate-account/{email}',[AdminController::class,'submitDefineAccess'])->name('submitDefineAccess');

//Route sécurisé
Route::middleware('auth')->group(function(){
    Route::get('dashboard',[AppController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingController::class, 'show'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::prefix('services')->group(function(){
        Route::get('/',[ServiceController::class,'index'])->name('services.index');
        Route::get('/create',[ServiceController::class,'create'])->name('services.create');
        Route::post('/create',[ServiceController::class,'store'])->name('services.store');
        Route::get('/edit/{services}',[ServiceController::class,'edit'])->name('services.edit');
        
        //Route d'action
        Route::put('/update/{services}',[ServiceController::class,'update'])->name('services.update');
        Route::get('/{services}',[ServiceController::class,'delete'])->name('services.delete');
        Route::get('/services/{id}/employes', [ServiceController::class, 'showEmployes'])->name('services.employes');
    });

    Route::get('/employes/export', [ExportController::class, 'exportExcel'])->name('employes.export');
    Route::post('/employes/import', [ExportController::class, 'importExcel'])->name('employes.import');

    Route::prefix('employes')->group(function(){
        Route::get('/',[EmployeController::class,'index'])->name('employe.index');
        Route::get('/create',[EmployeController::class,'create'])->name('employe.create');
        Route::get('/edit/{employe}',[EmployeController::class,'edit'])->name('employe.edit');
        //Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
        
        //Route d'action
        Route::post('/store',[EmployeController::class,'store'])->name('employe.store');
        Route::put('/update/{employe}',[EmployeController::class,'update'])->name('employe.update');
        Route::get('/delete/{employe}',[EmployeController::class,'delete'])->name('employe.delete');
        Route::get('/employe/{id}/print', [EmployeController::class, 'print'])->name('employe.print');
    });

    Route::prefix('administrateurs')->group(function(){
        Route::get('/',[AdminController::class,'index'])->name('administrateurs');
        Route::get('/create',[AdminController::class,'create'])->name('administrateurs.create');
        Route::post('/create',[AdminController::class,'store'])->name('administrateurs.store');
        Route::get('/delete/{user}',[AdminController::class,'delete'])->name('administrateurs.delete');
    });

    Route::get('/send-test-email', function () {
        Mail::to('test@example.com')->send(new TestEmail());
        return 'E-mail envoyé avec succès ! Vérifiez votre Mailtrap.';
    });
});


