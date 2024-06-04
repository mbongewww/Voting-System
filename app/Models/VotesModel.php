<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotesModel extends Model
{
    use HasFactory;
    protected $table = 'votes';

    

    static public function getRecord(){
        return self::select('votes.*') 
                ->orderBy('votes.id', 'asc')
                ->paginate(20);      
    }

    static public function checkIfHasVoted($voter_id){
        return self::select('votes.*') 
            ->where('votes.voter_id', '=', $voter_id) 
            ->orderBy('votes.id', 'asc')
            ->get(); 
    }

    static public function checkCand($voter_id){
        return self::select('votes.*', 'candidate.firstname as canfname', 'candidate.lastname as canlname', 'position.position as pname')
            ->join('candidate', 'candidate.id', '=', 'votes.candidate_id') 
            ->join('position', 'position.id', '=', 'votes.position_id')
            ->where('votes.voter_id', '=', $voter_id) 
            ->orderBy('votes.id', 'asc')
            ->get(); 
    }
    

    static public function getSingle($id){
        return self::find($id);
        
      }

     
}
