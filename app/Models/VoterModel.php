<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoterModel extends Model
{
    use HasFactory;
    protected $table = 'voter';

    static public function getRecord(){
        return self::select('voter.*') 
                ->orderBy('voter.id', 'asc')
                ->paginate(20);      
    }
    static public function loginVoter($voter_id){
        return self::select('voter.*')
                ->where('voter.voter_id', '=', $voter_id) 
                ->orderBy('voter.id', 'asc')
                ->get();      
    }

    static public function getSingle($id){
        return self::find($id);
        
      }

      public function getPhoto(){
        if(!empty($this->photo) && file_exists('upload/voter/'.$this->photo)){
               return url('upload/voter/'.$this->photo);
        }else{
            return "";
        }
    }    
}
