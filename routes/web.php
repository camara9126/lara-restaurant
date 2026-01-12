<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use App\Models\Menu;
use App\Models\User;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

// page d'accueil
Route::get('/', function () {
    $menus= Menu::all();
    $articles= Article::all();
    return view('home.index', compact('menus','articles'));
})->name('home');

Route::get('/doc/{id}', function ($id) {
   $menu= menu::findOrFail($id);
    $articles= Article::where('menu_id', $menu->id)->get();
    return view('home.test2', compact('articles'));
});


//apropos
Route::get('/about', function () {
   // $categorie= Categorie::all();
    return view('home.about');
})->name('about');

//contact
Route::get('/contact', function () {
   // $categorie= Categorie::all();
    return view('home.contact');
})->name('contact');

//service
Route::get('/service', function () {
   // $categorie= Categorie::all();
    return view('home.service');
})->name('service');

//menu
Route::get('/menu', function () {
   $menus= Menu::all();
    return view('home.menu', compact('menus'));
})->name('menu');

//reservation
Route::get('/reservation', function () {
   // $categorie= Categorie::all();
    return view('home.reservation');
})->name('reservation');

//equipe
Route::get('/equipe', function () {
   // $categorie= Categorie::all();
    return view('home.equipe');
})->name('equipe');

//temoignage
Route::get('/temoignage', function () {
   // $categorie= Categorie::all();
    return view('home.temoignage');
})->name('temoignage');

//Route connexion
Route::resource('/login', UserController::class);

//Route deconnexion
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//Route panier
Route::resource('/panier',CardController::class);
//Route::post('/ajout/panier', [CardController::class, 'store'])->name('panier.store');
//Route::delete('/ajout/{rowId}', [CardController::class, 'destroy'])->name('panier.destroy');
Route::delete('/ajout/{rowId}', [CardController::class, 'delete'])->name('delete');

// Route mise a jour commande panier
Route::get('/panier/plus/{rowId}', [CardController::class, 'plus'])->name('panier.plus');
Route::get('/panier/moins/{rowId}', [CardController::class, 'moins'])->name('panier.moins');

//Route personnel
Route::resource('/personnel', PersonnelController::class);

//Article
Route::resource('/darticle', ArticleController::class)->middleware(['auth','verified']);
//Route::get('/article/{id}',[ArticleController::class, 'show'])->name('article.show');
//Route::get('/darticle/{id}/edit',[ArticleController::class, 'edit'])->middleware(['auth','verified'])->name('darticle.edit');
//Route::patch('/darticle/{id}',[ArticleController::class, 'update'])->middleware(['auth','verified'])->name('darticle.update');


//Dashboard
Route::get('/dhome', function () {
    $menus= Menu::orderBy('nom','ASC');
    $articles= Article::all();

    return view('dashboard.home', compact('menus','articles'));

})->middleware(['auth','verified'])->name('dhome');

//Menu
Route::resource('/dmenu', MenuController::class)->middleware(['auth','verified']);
Route::get('/menu/{id}',[MenuController::class, 'show'])->name('menu.show');
//Route::patch('/dmenu/{id}/edit',[MenuController::class, 'edit'])->middleware(['auth','verified'])->name('dmenu.edit');
//Route::patch('/dmenu/{id}',[MenuController::class, 'update'])->middleware(['auth','verified'])->name('dmenu.update');

//Route whatsapp
Route::get('/whatsapp', [CardController::class, 'whatsapp'])->name('cart.whatsapp');

