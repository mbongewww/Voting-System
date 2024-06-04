<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;

class AuthController extends Controller
{
    public function login_admin(){
        $data['header_title'] = "Admin";
        return view('admin.login', $data);
    }


    public function auth_login_admin(Request $request){
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1])){
          return redirect('admin/dashboard'); 
        }else{
           return redirect()->back()->with('error', "Please enter correct emall and password");
        }
  }

    public function logout_admin(){
        Auth::logout();
        return redirect(url('/admin'));
    }

    public function update_admin(Request $request){
        
        $user = User::getSingleAdmin();
        
        if(Hash::check($request->curr_password, $user->password)){
          
            $user->email = trim($request->email);
            $user->firstname = trim($request->firstname);
            $user->lastname = trim($request->lastname);
            $user->password = Hash::make($request->password);
            $user->save();

            // saving  image
            if(!empty($request->file('photo'))){
        
                $file = $request->file('photo');
                $ext = $file->getClientOriginalExtension();
                $randomStr = $user->id.Str::random(20);
                $filename = strtolower($randomStr).'.'.$ext;

                $file->move('upload/admin/', $filename);
                $user->photo = trim($filename);
                $user->save();
                
            }

            // end of saving  image

            $json['status'] = true;
            $json['message'] = "Your account has been update successfully.";

        }else{
            $json['status'] = false;
            $json['message'] = "this email already exist please choose another";
        }

        echo json_encode($json);
       
    }

    public function auth_login(Request $request){
       
        if(Auth::attempt(['voter_id' => $request->voter_id, 'password' => $request->password]))
        {
            
            $json['status'] = true;
            $json['url'] = 'http://127.0.0.1:8000/home';
            $json['message'] = "welcome back";
     
          
        }else{

             $json['status'] = false;
             $json['message'] = "Please enter correct emall and password";
           
          }

          echo json_encode($json);
         
     }

     public function auth_register(Request $request){
        $checkEmail = User::checkEmail($request->email);
        if(empty($checkEmail)){

            $user = new User;
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->password = Hash::make($request->password);
            $user->save();
            
            try {
                Mail::to($user->email)->send(new RegisterMail($user));
            } catch (\Throwable $th) {
                //throw $th;
            }

            $user_id = $user->id;
            $url = url('admin/customer/list');
            $message = "New Customer Register #".$request->name;
            NotificationModel::insertRecord($user_id, $url, $message);

            $json['status'] = true;
            $json['message'] = "Your account is successfully created. Please verify your email address";

        }else{
            $json['status'] = false;
            $json['message'] = "this email already exist please choose another";
        }
        echo json_encode($json);
     }

     public function logout_user(){
        Auth::logout();
        return redirect(url(''));
    }
}
