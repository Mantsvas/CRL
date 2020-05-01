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


Auth::routes();

// OAuth
Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', 'Tournaments\TournamentController@index')->name('home');

Route::resource('tournaments', 'Tournaments\TournamentController')->except('edit');
Route::name('tournaments.')->prefix('tournaments')->namespace('Tournaments')->group(function () {
    Route::post('/registerForTournament', 'TournamentTeamController@registerTeam')->name('registerForTournament');
    Route::get('/approveTeam/{team}', 'TournamentController@approveTeam')->name('approveTeam');
    Route::get('/removeTeam/{team}', 'TournamentController@removeTeam')->name('removeTeam');
    Route::delete('/rejectTeam/{team}', 'TournamentController@rejectTeam')->name('rejectTeam');
    Route::post('/addModerator/{tournament}', 'TournamentController@addModerator')->name('addModerator');
    Route::post('/removeModerator', 'TournamentController@removeModerator')->name('removeModerator');
    Route::post('/sponsorUpload/{tournament}', 'TournamentController@sponsorUpload')->name('sponsorUpload');
    Route::get('/startTournament/{tournament}', 'TournamentController@start')->name('start');
});

Route::post('ajax/tournaments/setGameResult', 'Tournaments\TournamentController@setGameResult')->name('ajax.tournaments.setGameResult');
