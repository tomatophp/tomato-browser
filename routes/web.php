<?php


use Illuminate\Support\Facades\Route;

Route::middleware(['web','splade', 'verified'])->name('admin.')->group(function () {
    Route::get('/admin/browser', [\TomatoPHP\TomatoBrowser\Http\Controllers\BrowserController::class, 'index'])->name('browser.index');
    Route::post('/admin/browser', [\TomatoPHP\TomatoBrowser\Http\Controllers\BrowserController::class, 'index'])->name('browser.index');
    Route::get('/admin/browser/upload/file',function (){
        return redirect()->route('admin.browser.index');
    })->name('browser.get');
    Route::post('/admin/browser/upload/file', [\TomatoPHP\TomatoBrowser\Http\Controllers\BrowserController::class, 'upload'])->name('browser.upload');
    Route::post('/admin/browser/upload', [\TomatoPHP\TomatoBrowser\Http\Controllers\BrowserController::class, 'store'])->name('browser.store');
    Route::delete('/admin/browser/destroy', [\TomatoPHP\TomatoBrowser\Http\Controllers\BrowserController::class, 'destroy'])->name('browser.destroy');
});
