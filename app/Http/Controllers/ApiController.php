<?php

namespace App\Http\Controllers;
use App\Models\Option;
use App\Models\Product;
use App\Models\product_option;
use App\Models\Variant;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    

    // function to register users
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['success' =>'User register successfully','token' => $token], 200);
    }
    
    // function to login
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    // function logout 
    public function logout(){   
        if (Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(['success' =>'logout_success'],200); 
        }else{
            return response()->json(['error' =>'api.something_went_wrong'], 500);
        }
    }

        //function to return all products
        public function getProducts()
        {
             return Product::with('varians')->get();
        }
        //function return product with information and details
        public function getProduct($id)
        {
            return Product::with('varians')->find($id);
        }
    

}
