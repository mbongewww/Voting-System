<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoterModel;
use App\Models\CandidateModel;
use App\Models\PositionModel;
use App\Models\VotesModel;
use App\Mail\VoterMail;
use Auth;
use Hash;
use Mail;

class HomeController extends Controller
{
   public function landing_page(){

    $data['header_title'] = "Voting system";
   
    return view('frontend.login', $data);

   }

   public function home(){

    $data['header_title'] = "Voting system - Home";
    // $data['getCandidates'] = CandidateModel::getRecordByPosition($id);
    $data['getPositions'] = PositionModel::getRecord();
    $data['checkIfHasVoted'] = VotesModel::checkIfHasVoted(Auth::user()->id);
    $data['checkCand'] = VotesModel::checkCand(Auth::user()->id);
   
    return view('frontend.app', $data);

   }

   public function login_voter(Request $request){
        
       $voter = VoterModel::loginVoter($request->voter_id, $request->password);
      

      $password = $voter->password;
      dd($password);

       if(!empty($voter)){
            if(Hash::check($request->password, $voter->password)){
                
                $json['status'] = true;
                $json['url'] = '/home';
                $json['message'] = "welcome back";
                echo json_encode($json);
            }else{
                
                $json['status'] = false;
                $json['message'] = "please input correct login credential";
                echo json_encode($json);
            }
       }else{

            $json['status'] = false;
            $json['message'] = "please input correct login credential";
            echo json_encode($json);
       }
       
       
   }


        public function create_vote(Request $request) {

            $output = $request->all();
        
            // Check for empty request (optional)
            if (empty($output)) {
            return redirect()->back()->withErrors(['message' => 'No data submitted in the form']);
            }
        
            $voter_id = Auth::user()->id;
        
            foreach ($output as $key => $cand_id) {
                $getPositionId = PositionModel::getPositionId($key);
            
                if (!empty($getPositionId)) {
                    $vote = new VotesModel;
                    $vote->voter_id = $voter_id;
                    $vote->position_id = $getPositionId->id;
                    $vote->candidate_id = $cand_id;
                    $vote->save();
                }
            }
               $userEmail = Auth::user()->email;
               $checkCand = VotesModel::checkCand(Auth::user()->id);
            try {
                Mail::to($userEmail)->send(new VoterMail($checkCand));
            } catch (\Throwable $th) {
                //throw $th;
            }
        
            return redirect()->back();
        }

  

}
