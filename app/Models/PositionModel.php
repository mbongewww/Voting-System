<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionModel extends Model
{
    use HasFactory;
    protected $table = 'position';

    static public function getRecord(){
        return self::select('position.*')
                ->orderBy('position.id', 'asc')
                ->paginate(20);      
    }

    static public function getPositionId($str){
        return self::select('position.*')
                    ->where("position.position", '=', $str)
                    ->first();
    }

    static public function getSingle($id){
        return self::find($id);
        
      }

      public function getCandidates(){
        return $this->hasMany(CandidateModel::class, 'position_id')->get();
      }
  
}
