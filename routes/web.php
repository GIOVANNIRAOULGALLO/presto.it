<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\AnnounceController;

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
// public area
Route::get('/', [PublicController::class, 'index'])->name('homepage');
Route::get('/search', [PublicController::class, 'search'])->name('search');
Route::get('/category/{name}/{id}/announces', [PublicController::class, 'announcesByCategory'])->name('announce.category');
// announce area
Route::get('/inserisciAnnuncio', [AnnounceController::class, 'create'])->name('announce.create');
Route::post('/createAnnounce',[AnnounceController::class,'store'])->name('announce.store');
Route::get('/category/detail/{announce}',[AnnounceController::class, 'show'])->name('announce.detail');
Route::get('/edit/{announce}',[AnnounceController::class, 'edit'])->name('announce.edit');
Route::post('/update/{announce}',[AnnounceController::class,'update'])->name('announce.update');


Route::delete('/deleteAnnounce/{announce}',[AnnounceController::class,'destroy'])->name('announce.destroy');


// revisor area
Route::get('/revisor/home', [RevisorController::class, 'index'])->name('revisor.home');
Route::post('/revisor/announce/{id}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');
Route::post('/revisor/announce/{id}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');
Route::get('/revisor/basket', [RevisorController::class, 'basket'])->name('revisor.basket');
Route::post('/revisor/announce/{id}/restore', [RevisorController::class, 'restore'])->name('revisor.restore');
Route::delete('/revisor/deleteAnnounce/{announce}',[RevisorController::class,'destroy'])->name('revisor.announce.destroy');
//mail area
Route::get('/LavoraConNoi',[MailController::class,'create'])->name('mail.create');
Route::post('/LavoraConNoi/send',[MailController::class,'sendMail'])->name('mail.send');

//dropzone
Route::delete('/announce/images/remove',[AnnounceController::class,'removeImage'])->name('announce.images.remove');
Route::post('/announce/images/upload',[AnnounceController::class,'uploadImages'])->name('announce.images.upload');
Route::get('/announce/images',[AnnounceController::class,'getImages'])->name('announce.images');

//  languages
Route::post('/locale/{locale}', [PublicController::class, 'locale'])->name('locale');