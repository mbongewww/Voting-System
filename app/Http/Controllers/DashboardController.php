<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoterModel;
use App\Models\CandidateModel;
use App\Models\PositionModel;


class DashboardController extends Controller
{
   public function dashboard(){
    $data['header_title'] = "Admin Dashboard";
    $data['getVoters'] = VoterModel::getRecord();
    $data['getCandidates'] = CandidateModel::getRecord();
    $data['getPositions'] = PositionModel::getRecord();
    return view('admin.dashboard', $data);
   }
}
