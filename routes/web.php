<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\UserController;
use App\Models\Article;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

// page d'accueil
Route::get('/', function () {
    $menus= Menu::all();
    $plats= Menu::where('description','plats')->get();
    $articles= Article::all();
    return view('home.index', compact('menus','articles','plats'));
})->name('home');

Route::get('/doc/{id}', function ($id) {
   $menu= menu::findOrFail($id);
    $articles= Article::where('menu_id', $menu->id)->get();
    return view('home.test2', compact('articles'));
});

//contact
Route::get('/contact', function () {
   // $categorie= Categorie::all();
    return view('home.contact');
})->name('contact');


//menu
Route::get('/menu', function () {
   $menus= Menu::all();
    return view('home.menu', compact('menus'));
})->name('menu');


//Route connexion
Route::resource('/login', UserController::class);

//Route deconnexion
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//Route panier
Route::resource('/panier',CardController::class);
Route::delete('/ajout/{rowId}', [CardController::class, 'delete'])->name('delete');

// Route mise a jour commande panier
Route::get('/panier/plus/{rowId}', [CardController::class, 'plus'])->name('panier.plus');
Route::get('/panier/moins/{rowId}', [CardController::class, 'moins'])->name('panier.moins');

//Route personnel
Route::resource('/personnel', PersonnelController::class)->middleware(['auth','verified']);

//Article
Route::resource('/darticle', ArticleController::class)->middleware(['auth','verified']);
//Route::get('/article/{id}',[ArticleController::class, 'show'])->name('article.show');


//Dashboard
Route::get('/dhome', function () {
    $menus= Menu::orderBy('nom','ASC');
    $articles= Article::all();

    return view('dashboard.home', compact('menus','articles'));

})->middleware(['auth','verified'])->name('dhome');

//Menu
Route::resource('/dmenu', MenuController::class)->middleware(['auth','verified']);
Route::get('/menu/{id}',[MenuController::class, 'show'])->name('menu.show');

//Route whatsapp
Route::get('/whatsapp', [CardController::class, 'whatsapp'])->name('cart.whatsapp');
Route::post('/commande', [CardController::class, 'commande'])->name('commande.speciale');

