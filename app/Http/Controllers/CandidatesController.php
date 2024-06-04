<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CandidateModel;
use App\Models\PositionModel;
use Str;

class CandidatesController extends Controller
{
   public function candidates(){
    $data['header_title'] = "Admin Candidates";
    $data['getCandidates'] = CandidateModel::getRecord();
    $data['getPositions'] = PositionModel::getRecord();
    return view('admin.candidates', $data);
   }

   public function ballot_candidate(){
    $data['header_title'] = "Admin Candidates";
    return view('admin.ballot', $data);
   }
   

   public function create_candidate(Request $request){
     
      $candidate = new CandidateModel;
      $candidate->position_id = trim($request->position);
      $candidate->firstname = trim($request->firstname);
      $candidate->lastname = trim($request->lastname);
      $candidate->description = trim($request->description);
      $candidate->save();

        // saving  image
        if(!empty($request->file('photo'))){
        
         $file = $request->file('photo');
         $ext = $file->getClientOriginalExtension();
         $randomStr = $candidate->id.Str::random(20);
         $filename = strtolower($randomStr).'.'.$ext;

         $file->move('upload/candidate/', $filename);
         $candidate->photo = trim($filename);
         $candidate->save();
         
     }

     // end of saving  image

      // return redirect()->back()->with('success', 'position created successfully');
      $json['status'] = true;
      $json['message'] = "Candidate created successfully.";
      echo json_encode($json);
   }

      public function getCandidate(Request $request){
         $candidate = CandidateModel::getSingle($request->id);
         $response['canid'] = $candidate->id;
         $response['firstname'] = $candidate->firstname;
         $response['lastname'] = $candidate->lastname;
         $response['description'] = $candidate->description;
         $response['position_id'] = $candidate->position_id;
         echo json_encode($response);

      }

   public function update_candidate(Request $request){

      $candidate = CandidateModel::getSingle($request->id);
      $candidate->position_id = trim($request->position);
      $candidate->firstname = trim($request->firstname);
      $candidate->lastname = trim($request->lastname);
      $candidate->description = trim($request->description);
      $candidate->save();

      
      $json['status'] = true;
      $json['message'] = "Candidate updated successfully.";
      echo json_encode($json);
         
   } 

   public function delete_candidate(Request $request){

      $candidate = CandidateModel::getSingle($request->id);
      $candidate->delete();

   
      $json['status'] = true;
      $json['message'] = "Candidate delete successfully.";
      echo json_encode($json);
      
   } 

   public function update_candidate_photo(Request $request){

      $candidate = CandidateModel::getSingle($request->id);

       // saving  image
       if(!empty($request->file('photo'))){
        
         $file = $request->file('photo');
         $ext = $file->getClientOriginalExtension();
         $randomStr = $candidate->id.Str::random(20);
         $filename = strtolower($randomStr).'.'.$ext;

         $file->move('upload/candidate/', $filename);
         $candidate->photo = trim($filename);
         $candidate->save();
         
     }

     // end of saving  image

   
      $json['status'] = true;
      $json['message'] = "Candidate Image Update  successfully.";
      echo json_encode($json);
      
   } 
}
