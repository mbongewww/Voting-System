<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function votes(){
        $data['header_title'] = "Admin Votes";
        return view('admin.votes', $data); 
    }
}
