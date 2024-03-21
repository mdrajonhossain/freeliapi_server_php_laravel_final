<?php

namespace App\Http\Controllers\API;
namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller{


 


    public function check(Request $request){

        $user = Auth::guard('sanctum')->user();        
        return response()->json(['user' => $user]);
    }






    public function userregister(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }


    
 


    // public function login(Request $request){
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         // $accessToken = $user->createToken('AuthToken')->accessToken;
    //         $accessToken = $user->createToken('myToken')->plainTextToken;

    //         return response()->json(['access_token' => $accessToken], 200);
    //     }
    //  Welcome to Api

    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }


      public function user_loginmidleweare(Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // $accessToken = $user->createToken('AuthToken')->accessToken;
            $accessToken = $user->createToken('myToken')->plainTextToken;

            return response()->json(['messsage' => "Login Successfully", 'access_token' => $accessToken], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }












        

    public function login(Request $request){
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $companylist = ["ITL","ITS","ITE"];
            $user = User::where('email', $request->email)->first();
            
            if($request->company){
                $match = in_array($request->company, $companylist);

                if ($match) {
                    if ($user) {        
                        $accessToken = $user->createToken('myToken')->plainTextToken;
                        return response()->json([
                            'status' => true,                            
                            'message' => 'User Logged In Successfully',
                            "token" => $accessToken,
                            "data" => $user,
                            "current company" => $request->company,
                            "company List" => $companylist
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => false,
                            'message' => "company is not found",
                        ],100);
                    }
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => "company not found",
                    ],200);
                }                
            }



            if ($request->otp) {                            
                $otpNumber = User::where('id', $user->id)->where('otp', $request->otp)->first();
                            
                if ($otpNumber) {                                    
                    return response()->json([
                        'status' => true,
                        "company" => $companylist,
                        'message' => 'User Logged In Successfully',
                        "data" => $user,
                        // "data"  => $request->all(),
                    ], 200);
                }else{
                    return response()->json([
                        'status' => "otp not match"
                    ], 200);
                }
            }


            $otp_data = $randomNumber = random_int(10000000, 99999999);
            $affectedRows = User::where('id', $user->id)->update(['otp' => $otp_data]);
            $otp = User::where('id', $user->id)->value('otp');

            return response()->json([
                'status' => true,    
                "otp" => $otp,    
                "data" => $user,
                // "data"  => $request->all()
            ], 200);


        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }








}