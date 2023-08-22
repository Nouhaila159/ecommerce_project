<?php

use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\InfoSiteController;
use App\Http\Controllers\FrontProduitController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/Route::get('/', function () {
    return view('master');
});
Route::get('/category', function () {
    return view('frontend.category');
});
Route::get('/account', function () {
    return view('frontend.account');
});
Route::get('/cart', function () {
    return view('frontend.cart');
});
Route::get('/product', function () {
    return view('frontend.product');
});
Route::get('/index', function () {
    return view('frontend.index');
});
Route::get('/contact', function () {
    return view('frontend.contact');
});
Route::get('/', [HomeController::class, 'index'])->name('home.index');


// Routes protégées nécessitant une authentification
Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


    Route::get('/orders', function () {
        return view('orders');
    });
    
    
    Route::get('/produit', [ProduitController::class, 'index']);

    Route::get('/settings', function () {
        return view('settings');
    });
    
    Route::get('/out-of-stock', function () {
        return view('out-of-stock');
    });
    
    Route::get('/in-stock', function () {
        return view('settings');
    });

    Route::get('/categorie', function () {
        return view('categorie');
    });
    
    Route::get('/users', function () {
        return view('users');
    });
    
    Route::get('/brands', function () {
        return view('brands');
    });

    Route::get('/materiel', function () {
        return view('materiel');
    });
    
    Route::get('/categorie', function () {
        return view('categorie');
    });
    
    Route::get('/vente', function () {
        return view('vente');
    });
    

 

//CRUD MARQUE
Route::post('/brands', [MarqueController::class, 'store'])->name('brands.store');
Route::get('/brands', [MarqueController::class, 'index'])->name('brands.index');
Route::get('/brands/{id}/delete', [MarqueController::class, 'showForm'])->name('brands.delete');
Route::delete('/brands/{id}', [MarqueController::class, 'destroy'])->name('brands.destroy');
Route::get('/update_brands/{id}', [MarqueController::class, 'updateMarque']);
Route::post('/updateMarque/traitement', [MarqueController::class, 'updateMarqueTraitement']);

//CRUD MATERIEL
Route::post('/materiel', [MaterielController::class, 'store'])->name('materiel.store');
Route::get('/materiel', [MaterielController::class, 'index'])->name('materiel.index');
Route::get('/materiel/{id}/delete', [MaterielController::class, 'showForm'])->name('materiel.delete');
Route::delete('/materiel/{id}', [MaterielController::class, 'destroy'])->name('materiel.destroy');
Route::get('/update_materiel/{id}', [MaterielController::class, 'updateMateriel']);
Route::post('/updateMateriel/traitement', [MaterielController::class, 'updateMaterielTraitement']);

//CRUD CATEGORIE
Route::post('/categorie', [CategorieController::class, 'store'])->name('categorie.store');
Route::get('/categorie', [CategorieController::class, 'index'])->name('categorie.index');
Route::get('/categorie/{id}/delete', [CategorieController::class, 'showForm'])->name('categorie.delete');
Route::delete('/categorie/{id}', [CategorieController::class, 'destroy'])->name('categorie.destroy');
Route::get('/update_categorie/{id}', [CategorieController::class, 'updateCategorie']);
Route::post('/updateCategorie/traitement', [CategorieController::class, 'updateCategorieTraitement']);

//CRUD PRODUIT
Route::get('/produit', [ProduitController::class, 'index'])->name('produits.index');
Route::post('/produit', [ProduitController::class, 'store'])->name('produits.store');
Route::put('/produits/{id}/update-statut', [ProduitController::class, 'updateStatut'])->name('updateStatut');
Route::get('/updateProduit/{id}', [ProduitController::class, 'editProduit']);
Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::get('/detailProduit/{id}', [ProduitController::class, 'detailProduit'])->name('produits.detail');
Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');

//CRUD REFERENCE
Route::get('/reference/{id}', [ReferenceController::class, 'index'])->name('reference.index');
Route::post('/ajouterReference',[ReferenceController::class, 'ajouterReference'])->name('ajouter_reference');
Route::get('/updateReference/{idR}/{idP}', [ReferenceController::class, 'editReference'])->name('reference.edit');
Route::post('/reference/{id}', [ReferenceController::class, 'updateReference'])->name('reference.update');
Route::delete('/supprimer-reference/{id}', [ReferenceController::class, 'supprimerReference'])->name('reference.supprimer');


//CRUD STOCK
Route::get('/in-stock', [StockController::class, 'indexStock'])->name('in-stock.index'); 

//CRUD RUPTURE
Route::get('/out-of-stock', [StockController::class, 'indexRupture'])->name('out-of-stock.index'); 

//CRUD COMMANDE
Route::get('/orders', [CommandesController::class, 'index'])->name('orders.index');
Route::put('/commandes/{id}/update-statut', [CommandesController::class, 'updateStatut'])->name('updateStatut');
Route::put('/commandes/{id}/update-statutLivraison', [CommandesController::class, 'updateStatutLivraison'])->name('updateStatutLivraison');
Route::get('/detailCommande/{id}', [CommandesController::class, 'detailCommande']);

//FACTURE
Route::get('/facture/{id}', [VenteController::class, 'genererFactureV']);
Route::get('/telechargerFacture/{id}', [VenteController::class,'telechargerFactureV'])->name('telechargerFactureV');

//CHANGEMENT VALIDATION & STATUT
Route::post('/updateValidation/{id}', [CommandesController::class,'updateValidation'])->name('updateValidation');
Route::post('/updateValidationV/{id}', [VenteController::class,'updateValidationV'])->name('updateValidationV');
Route::put('/commandes/{id}/update-statutV', [VenteController::class, 'updateStatutV'])->name('updateStatutV');
Route::put('/commandes/{id}/update-statutLivraisonV', [VenteController::class, 'updateStatutLivraisonV'])->name('updateStatutLivraisonV');

//CRUD VENTE
Route::get('/vente', [VenteController::class, 'index'])->name('orders.index');
Route::get('/detailVente/{id}', [VenteController::class, 'detailVente'])->name('vente.detail');
Route::get('/ajouterVente', [VenteController::class,'ajouterVente'])->name('ajouterVente');
Route::post('ajouterVente', [VenteController::class,'ajouterVentePost'])->name('ajouterVente.post');
Route::get('/vente', [VenteController::class,'ajouterVentePost']);
Route::get('/vente', [VenteController::class, 'index'])->name('vente');
Route::delete('/commande/{id}', [VenteController::class, 'destroy'])->name('destroy');
Route::get('/updateVente/{id}', [VenteController::class, 'showUpdateForm'])->name('updateVente');
Route::put('/updateVente/{id}', [VenteController::class,'updateVente'])->name('updateVente');
Route::get('/search-client', [VenteController::class, 'searchClient'])->name('search-client');
//test


//CRUD DETAIL VENTE
Route::get('/ajouter_referenceVente/{id}', [VenteController::class, 'ajouter_referenceVente_index'])->name('venteDetail.index');
Route::get('/get-reference-image/{id}', [VenteController::class, 'getReferenceImage']);
Route::get('/get-reference-sizes/{id}', [VenteController::class, 'getReferenceSizes'])->name('get-reference-sizes');
Route::get('/get-max-quantity/{sizeId}', [VenteController::class, 'getMaxQuantityForSize'])->name('get-max-quantity');
Route::post('/ajouter_referenceVente',[VenteController::class, 'ajouter_referenceVente'])->name('venteDetail.add');
Route::delete('/supprimerLigneCommande/{id}', [VenteController::class, 'supprimerLigneCommande'])->name('venteDetail.delete');
//updateDétailVente

Route::get('/updateDetailVente/{idLigne}', [VenteController::class, 'showUpdateDetailVente'])->name('updateDetailVente');
Route::put('/updateDetailVente/{idLigne}', [VenteController::class, 'updateDetailVente'])->name('update');
//Crud setting
Route::get('/settings', [InfoSiteController::class, 'index'])->name('settings.index');
Route::put('/settings/{id}', [InfoSiteController::class, 'updateInfoSite'])->name('settings.update');

//crud category 
Route::get('/category', [FrontProduitController::class, 'index'])->name('frontend.category');


//CRUD USER
Route::get('/users', [HomeController::class, 'indexUsers'])->name('users.index');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();
