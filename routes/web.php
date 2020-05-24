<?php

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

// Route::get('/playerbytag/{tag}', 'HomeController@player');

Route::get('changelanguage/{lang}', 'LanguageController@setLanguage')->name('changeLang');
Auth::routes();

// OAuth
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'Tournaments\TournamentController@index')->name('home');

Route::resource('tournaments', 'Tournaments\TournamentController');
Route::get('tournaments/show/{tournament}/{activeTab?}', 'Tournaments\TournamentController@show2')->name('tournaments.show2');
Route::name('tournaments.')->prefix('tournaments')->namespace('Tournaments')->group(function () {
    Route::post('/registerForTournament', 'TournamentTeamController@registerTeam')->name('registerForTournament');
    Route::get('/approveTeam/{team}', 'TournamentController@approveTeam')->name('approveTeam');
    Route::get('/removeTeam/{team}', 'TournamentController@removeTeam')->name('removeTeam');
    Route::delete('/rejectTeam/{team}', 'TournamentController@rejectTeam')->name('rejectTeam');
    Route::post('/addModerator/{tournament}', 'TournamentController@addModerator')->name('addModerator');
    Route::post('/removeModerator', 'TournamentController@removeModerator')->name('removeModerator');
    Route::post('/sponsorUpload/{tournament}', 'TournamentController@sponsorUpload')->name('sponsorUpload');
    Route::get('/startTournament/{tournament}', 'TournamentController@start')->name('start');
    Route::get('/gameDetails/{game}', 'GameController@editGameDetails')->name('gameDetails.edit');
    Route::post('/gameDetails/{game}', 'GameController@storeGameDetails')->name('gameDetails.store');
    Route::get('/teams/{team}', 'TournamentTeamController@show')->name('team.show');
});

Route::post('ajax/tournaments/setGameResult', 'Tournaments\TournamentController@setGameResult')->name('ajax.tournaments.setGameResult');
