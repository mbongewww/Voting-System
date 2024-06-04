<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PositionModel;

class PositionsController extends Controller
{
   public function position(){
        $data['header_title'] = "Admin Positions";
        $data['getPositions'] = PositionModel::getRecord();
        return view('admin.position', $data);
   }

   public function create_position(Request $request){
      $position = new PositionModel;
      $position->position = trim($request->position);
      $position->maximum_vote = trim($request->maximum_vote);
      $position->save();

      // return redirect()->back()->with('success', 'position created successfully');
      $json['status'] = true;
      $json['message'] = "position created successfully.";
      echo json_encode($json);
   }

   public function getPosition(Request $request){
      $position = PositionModel::getSingle($request->id);
      $response['id'] = $position->id;
      $response['position'] = $position->position;
      $response['maximum_vote'] = $position->maximum_vote;
      echo json_encode($response);
      
   }

  public function update_position(Request $request){

      $position = PositionModel::getSingle($request->id);;
      $position->position = trim($request->position);
      $position->maximum_vote = trim($request->maximum_vote);
      $position->save();

     
      $json['status'] = true;
      $json['message'] = "position updated successfully.";
      echo json_encode($json);
        
  } 

  public function delete_position(Request $request){

   $position = PositionModel::getSingle($request->id);
   $position->delete();

  
   $json['status'] = true;
   $json['message'] = "position delete successfully.";
   echo json_encode($json);
     
} 
}

