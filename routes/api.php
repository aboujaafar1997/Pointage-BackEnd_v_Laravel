<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login','API\AuthController@login');
Route::get('hre', 'test@hre');
Route::middleware('jwt.auth')->post('me', 'API\AuthController@me');

//profil route :
Route::middleware('jwt.auth')->post('profil/ajouter', 'ProfilController@ajouterProfil');
Route::middleware('jwt.auth')->post('profil/list', 'ProfilController@listProfil');
Route::middleware('jwt.auth')->post('profil/list/{id}', 'ProfilController@listProfilById');
Route::middleware('jwt.auth')->post('profil/supprimer/{id}', 'ProfilController@deleteProfilById');
Route::middleware('jwt.auth')->post('profil/get/{id}', 'ProfilController@getProfilByName');
/************************************************************************************ */


//privs route :
Route::middleware('jwt.auth')->post('Privs/ajouter', 'PrivController@ajouterpriv');
Route::middleware('jwt.auth')->post('Privs/list', 'PrivController@listpriv');
Route::middleware('jwt.auth')->post('Privs/list/{id}', 'PrivController@getprivByName');
Route::middleware('jwt.auth')->post('Privs/supprimer/{id}', 'PrivController@deleteprivById');
Route::middleware('jwt.auth')->post('Privs/get/{id}', 'PrivController@listprivById');
/************************************************************************************ */

//ProfilPrivs route :
Route::middleware('jwt.auth')->post('ProfilPrivs/ajouter/{id1}/{id2}', 'Priv_profilController@ajouterPriv_profil');
Route::middleware('jwt.auth')->post('ProfilPrivs/supprimer/{id1}/{id2}', 'Priv_profilController@deletePriv_profilById');
/************************************************************************************ */

//user route :
Route::post('Utilisateur/ajouter', 'UserController@ajouterUser');
Route::middleware('jwt.auth')->post('Utilisateur/list', 'UserController@listUser');
Route::middleware('jwt.auth')->post('Utilisateur/list/{id}', 'UserController@listUserById');
Route::middleware('jwt.auth')->post('Utilisateur/supprimer/{id}', 'UserController@deleteUserById');
Route::middleware('jwt.auth')->post('Utilisateur/get/{id}', 'UserController@getUserByName');
/************************************************************************************ */



//Session route :
Route::middleware('jwt.auth')->post('Session/ajouter', 'SessionController@ajouterSession');
Route::middleware('jwt.auth')->post('Session/list', 'SessionController@listSession');
Route::middleware('jwt.auth')->post('Session/list/{id}', 'SessionController@listSessionById');
Route::middleware('jwt.auth')->post('Session/supprimer/{id}', 'SessionController@deleteSessionById');
Route::middleware('jwt.auth')->post('Session/get/{id}', 'SessionController@getSessionByName');
/************************************************************************************ */


//Journal route :
Route::middleware('jwt.auth')->post('Journal/ajouter', 'JournalController@ajouterJournal');
Route::middleware('jwt.auth')->post('Journal/list', 'JournalController@listJournal');
Route::middleware('jwt.auth')->post('Journal/list/{id}', 'JournalController@listJournalById');
Route::middleware('jwt.auth')->post('Journal/supprimer/{id}', 'JournalController@deleteJournalById');
Route::middleware('jwt.auth')->post('Journal/get/{id}', 'JournalController@getJournalByName');
/************************************************************************************ */

//Taxi route :
Route::middleware('jwt.auth')->post('Taxi/ajouter', 'TaxiController@ajouterTaxi');
Route::middleware('jwt.auth')->post('Taxi/list', 'TaxiController@listTaxi');
Route::middleware('jwt.auth')->post('Taxi/list/{id}', 'TaxiController@listTaxiById');
Route::middleware('jwt.auth')->post('Taxi/supprimer/{id}', 'TaxiController@deleteTaxiById');
Route::middleware('jwt.auth')->post('Taxi/get/{id}', 'TaxiController@getTaxiByName');
Route::middleware('jwt.auth')->post('Taxi/upload', 'TaxiController@import');
/************************************************************************************ */

//Cheuffeus route :
Route::middleware('jwt.auth')->post('Chauffeur/ajouter', 'ChauffeursController@ajouterChauffeur');
Route::middleware('jwt.auth')->post('Chauffeur/list', 'ChauffeursController@listChauffeur');
Route::middleware('jwt.auth')->post('Chauffeur/list/{id}', 'ChauffeursController@listChauffeurById');
Route::middleware('jwt.auth')->post('Chauffeur/supprimer/{id}', 'ChauffeursController@deleteChauffeurById');
Route::middleware('jwt.auth')->post('Chauffeur/get/{id}', 'ChauffeursController@getChauffeurByName');
/************************************************************************************ */


//Permis route :
Route::middleware('jwt.auth')->post('Permis/ajouter', 'PermisController@ajouterPermis');
Route::middleware('jwt.auth')->post('Permis/list', 'PermisController@listPermis');
Route::middleware('jwt.auth')->post('Permis/list/{id}', 'PermisController@listPermisById');
Route::middleware('jwt.auth')->post('Permis/supprimer/{id}', 'PermisController@deletePermisById');
Route::middleware('jwt.auth')->post('Permis/get/{id}', 'PermisController@getPermisByName');
Route::middleware('jwt.auth')->post('PermisDeConfiance/affiche/{id}', 'PermisController@getChauffeurFromPermis');
Route::post('PermisDeConfiance/pdf/{id}/{permis}','PermisController@export');
/************************************************************************************ */


//Pointage route :
Route::middleware('jwt.auth')->post('Pointage/ajouter/tab', 'PointageController@ajouterPointage');
Route::middleware('jwt.auth')->post('Pointage/list', 'PointageController@listPointage');
Route::middleware('jwt.auth')->post('Pointage/list/{id}', 'PointageController@listPointageById');
Route::middleware('jwt.auth')->post('Pointage/supprimer/{id}', 'PointageController@deletePointageById');
Route::middleware('jwt.auth')->post('Pointage/get/{id}', 'PointageController@getPointageByName');
/************************************************************************************ */

//statistique route :
Route::middleware('jwt.auth')->post('statistique/1', 'StatistiqueController@statistique');
/*

                                *********    *******   ******     ******     
                                *               *        * *         *
                                *               *        *  *       *
                                *********       *        *   *     *     
                                *               *        *    *   *
                                *               *        *     * *
                                *            *******   *****    *
                                */ 
