<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use Hash;
// use App\Models\VoterModel;
use App\Models\User;

class VoterController extends Controller
{
    public function voters(){

        $data['header_title'] = "Admin Voters";
        $data['getVoters'] = User::getRecordVoter();
        return view('admin.voters', $data);
    }

    public function create_voter(Request $request){
     
        $voter = new User;
       
        $voter->firstname = trim($request->firstname);
        $voter->lastname = trim($request->lastname);
        $voter->email = trim($request->email);
        $voter->password = Hash::make($request->password);
        $randomStr = $voter->id.Str::random(20);
        $voter->voter_id = strtolower($randomStr).'.'.$request->firstname;
        
        $voter->save();
  
          // saving  image
          if(!empty($request->file('photo'))){
          
           $file = $request->file('photo');
           $ext = $file->getClientOriginalExtension();
           $randomStr = $voter->id.Str::random(20);
           $filename = strtolower($randomStr).'.'.$ext;
  
           $file->move('upload/admin/', $filename);
           $voter->photo = trim($filename);
           $voter->save();
           
       }
  
       // end of saving  image
  
        // return redirect()->back()->with('success', 'position created successfully');
        $json['status'] = true;
        $json['message'] = "Candidate created successfully.";
        echo json_encode($json);
     }
  
        public function getVoter(Request $request){
         
           $voter = User::getSingle($request->id);
           $response['id'] = $voter->id;
           $response['firstname'] = $voter->firstname;
           $response['lastname'] = $voter->lastname;
           $response['email'] = $voter->email;
         //   $response['password'] = $voter->password;
          
           echo json_encode($response);
  
        }

    
  
     public function update_voter(Request $request){
  
        $voter = User::getSingle($request->id);
        $voter->email = trim($request->email);
        $voter->firstname = trim($request->firstname);
        $voter->lastname = trim($request->lastname);
      
        $voter->save();
  
        
        $json['status'] = true;
        $json['message'] = "Voter updated successfully.";
        echo json_encode($json);
           
     } 
  
     public function delete_voter(Request $request){
  
        $voter = User::getSingle($request->id);
        $voter->delete();
  
     
        $json['status'] = true;
        $json['message'] = "Voter delete successfully.";
        echo json_encode($json);
        
     } 
  
     public function update_voter_photo(Request $request){
  
        $voter = User::getSingle($request->id);
  
         // saving  image
         if(!empty($request->file('photo'))){
          
           $file = $request->file('photo');
           $ext = $file->getClientOriginalExtension();
           $randomStr = $voter->id.Str::random(20);
           $filename = strtolower($randomStr).'.'.$ext;
  
           $file->move('upload/admin/', $filename);
           $voter->photo = trim($filename);
           $voter->save();
           
       }
  
       // end of saving  image
  
     
        $json['status'] = true;
        $json['message'] = "Voter Image Update  successfully.";
        echo json_encode($json);
        
     } 
}
