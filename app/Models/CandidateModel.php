<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateModel extends Model
{
    use HasFactory;
    protected $table = 'candidate';

    static public function getRecord(){
        return self::select('candidate.*', 'position.position as position_name')
                ->join('position', 'position.id', '=', 'candidate.position_id')
                ->orderBy('candidate.id', 'asc')
                ->paginate(20);      
    }

    static public function getSingle($id){
        return self::find($id);
        
      }

      static public function getRecordByPosition($id){
        return self::select('candidate.*')
                    ->where('candidate.position_id','=', $id)
                    ->orderBy('candidate.id', 'asc')
                    ->get(); 
      }

      public function getPhoto(){
        if(!empty($this->photo) && file_exists('upload/candidate/'.$this->photo)){
               return url('upload/candidate/'.$this->photo);
        }else{
            return "";
        }
    }    
}
