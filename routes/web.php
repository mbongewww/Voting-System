<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CandidatesController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotesController;

use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.login');
// });

Route::get('/', [HomeController::class, 'landing_page']);
Route::post('/login_voter', [AuthController::class, 'auth_login']);

Route::get('/admin', [AuthController::class, 'login_admin']);
Route::post('/admin', [AuthController::class, 'auth_login_admin']);

Route::group(['middleware'=>'admin'], function(){

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/logout', [AuthController::class, 'logout_admin']);
    Route::get('admin/votes', [VotesController::class, 'votes']);
    Route::get('admin/voters', [VoterController::class, 'voters']);
    Route::get('admin/positions', [PositionsController::class, 'position']);

    Route::get('admin/candidates', [CandidatesController::class, 'candidates']);
    Route::get('admin/ballot-position', [CandidatesController::class, 'ballot_position']);
    Route::post('update_admin', [AuthController::class, 'update_admin']);

    Route::post('admin/create_position', [PositionsController::class, 'create_position']);
    Route::post('admin/getposition', [PositionsController::class, 'getPosition']);
    Route::post('admin/update_position', [PositionsController::class, 'update_position']);
    Route::post('admin/delete_position', [PositionsController::class, 'delete_position']);

    
    Route::post('admin/create_candidate', [CandidatesController::class, 'create_candidate']);
    Route::post('admin/getCandidate', [CandidatesController::class, 'getCandidate']);
    Route::post('admin/update_candidate', [CandidatesController::class, 'update_candidate']);
    Route::post('admin/delete_candidate', [CandidatesController::class, 'delete_candidate']);
    Route::post('admin/update_candidate_photo', [CandidatesController::class, 'update_candidate_photo']);

    Route::post('admin/create_voter', [VoterController::class, 'create_voter']);
    Route::post('admin/getVoter', [VoterController::class, 'getVoter']);
    Route::post('admin/update_voter', [VoterController::class, 'update_voter']);
    Route::post('admin/delete_voter', [VoterController::class, 'delete_voter']);
    Route::post('admin/update_voter_photo', [VoterController::class, 'update_voter_photo']);
  
    

  

});


Route::group(['middleware'=>'user'], function(){

    Route::get('/home', [HomeController::class, 'home']);
    Route::get('/logout', [AuthController::class, 'logout_user']);
    Route::post('/home', [HomeController::class, 'create_vote']);
   
    

});