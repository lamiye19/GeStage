<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\MaitreController;
use App\Http\Controllers\RenouvellerController;
use App\Http\Controllers\StageController;
use App\Mail\SendEmail;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [DemandeController::class, "ajouter"])->name("ajouter-demande");
Route::post('/', [DemandeController::class, "create"])->name("demande.create");

Route::get('/soumission-rapport', [StageController::class, "renduDoc"])->name("rendu-stage");
Route::post('/soumission-rapport', [StageController::class, "verification"])->name("stage.verification");
Route::put('/soumission-rapport', [StageController::class, "rendre"])->name("stage.rendre");
Route::get('/renouveller-stage', [StageController::class, "renduDoc"])->name("rendu-stage");
Route::post('/renouveller-stage', [RenouvellerController::class, "create"])->name("renouveller.create");

Auth::routes();


Route::prefix('user-connect')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
});
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('', function () {
            return view('welcome');
        })->name("admin");
        Route::middleware('isAdmin')->group(function () {

            //Routes Service
            Route::prefix('services')->group(function () {
                Route::get('', [ServiceController::class, "index"])->name("services");
                Route::get('/create', [ServiceController::class, "ajouter"])->name("ajouter-service");
                Route::post('/create', [ServiceController::class, "create"])->name("service.create");
                Route::delete('/delete/{service}', [ServiceController::class, "delete"])->name("service.delete");
                Route::put('/update/{service}', [ServiceController::class, "update"])->name("service.update");
                Route::get('/update/{service}', [ServiceController::class, "modifier"])->name("modifier-service");
            });

            //Routes Maitre
            Route::prefix('maitres')->group(function () {
                Route::get('', [MaitreController::class, "index"])->name("maitres");
                Route::get('/create', [MaitreController::class, "ajouter"])->name("ajouter-maitre");
                Route::post('/create', [MaitreController::class, "create"])->name("maitre.create");
                Route::delete('/delete/{maitre}', [MaitreController::class, "delete"])->name("maitre.delete");
                Route::put('/update/{maitre}', [MaitreController::class, "update"])->name("maitre.update");
                Route::get('/update/{maitre}', [MaitreController::class, "modifier"])->name("modifier-maitre");
            });

            //Routes demande
            Route::prefix('demandes')->group(function () {
                Route::get('', [DemandeController::class, "index"])->name("demandes");
                Route::put('/update/{demande}/{status}', [DemandeController::class, "update"])->name("demande.update");
                Route::get('/consulter/{demande}', [DemandeController::class, "consulter"])->name("consulter-demande");
                Route::get('/accept/{demande}', [StageController::class, "ajouter"])->name("accept-demande");
                Route::post('/accept', [StageController::class, "create"])->name("stage.create");
            });

            //Routes demande
            Route::prefix('renouvellement')->group(function () {
                Route::get('', [RenouvellerController::class, "index"])->name("renouvellement");
                Route::put('/update/{renew}', [RenouvellerController::class, "update"])->name("renew.update");
                Route::get('/accept/{renew}', [StageController::class, "ajouterRenew"])->name("accept-renew");
                Route::post('/accept/{renew}', [StageController::class, "createRenew"])->name("stageRenew.create");
            });

            //Routes stagiaire
            Route::prefix('stagiaires')->group(function () {
                Route::get('', [StagiaireController::class, "index"])->name("stagiaires");
            });

            //Routes stage
            Route::prefix('stages')->group(function () {
                Route::get('', [StageController::class, "index"])->name("stages");
                Route::put('/update/{stage}', [StageController::class, "update"])->name("stage.update");
            });
        });

        Route::middleware('isNotAdmin')->group(function () {
        Route::get('/{user:name}/mes-stagiaires', [StagiaireController::class, "mine"])->name("mes-stagiaires");
        Route::get('/{user:name}/mes-stages', [StageController::class, "mine"])->name("mes-stages");
        });
    });
});


/* Route::get('/admin/send-email', [StageController::class, "Email"])->name("send");

 
});  */

//Routes stagiaire
/* Route::get('/admin/stagiaires/create', [StagiaireController::class, "ajouter"])->name("ajouter-stagiaire");
Route::post('/admin/stagiaires/create', [StagiaireController::class, "create"])->name("stagiaire.create");
Route::delete('/admin/{stagiaire}', [StagiaireController::class, "delete"])->name("stagiaire.delete");
Route::put('/admin/stagiaires/update/{stagiaire}', [StagiaireController::class, "update"])->name("stagiaire.update");
Route::get('/admin/stagiaires/update/{stagiaire}', [StagiaireController::class, "modifier"])->name("modifier-stagiaire"); */

//Routes obj
/* Route::get('/admin/objs', [objController::class, "index"])->name("objs");
Route::get('/admin/objs/create', [objController::class, "ajouter"])->name("ajouter-obj");
Route::post('/admin/objs/create', [objController::class, "create"])->name("obj.create");
Route::delete('/admin/{obj}', [objController::class, "delete"])->name("obj.delete");
Route::put('/admin/objs/update/{obj}', [objController::class, "update"])->name("obj.update");
Route::get('/admin/objs/update/{obj}', [objController::class, "modifier"])->name("modifier-obj"); */
