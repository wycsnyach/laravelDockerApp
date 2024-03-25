<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserAuthenticationController extends Controller
{
        /*
|--------------------------------------------------------------------------
| START OF ADD OR STORE FUNCTION
|--------------------------------------------------------------------------
*/ 

    public function register(Request $request) {
       
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $email = strtolower($request->input('email'));
        $password = $request->input('password');
        $active = $request->input('active');

        $user = User::create([
           
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'email' => $email,
            'active' => $active,
            'password' => Hash::make($password)
        ]);

        $token = $user->createToken('auth_token') -> plainTextToken;

        return response() -> json([
            'message' => 'user Account created Successfully',
            'access_token' => $token,
            'token_type' => 'Bearer', 
        ], 201);
    }

    /*
|--------------------------------------------------------------------------
| START OF LOGIN OR ACCESS FUNCTION
|--------------------------------------------------------------------------
*/ 
    public function login(Request $request) {
        $email = strtolower($request -> input('email'));
        $password = $request->input('password');

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        if(!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid login credentials'
            ], 401);
        
        }

        $user = User::where('email', $request['email']) -> firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        $user->update([
            'api_token' => $token
        ]);

        return response() -> json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'User signed in Successfully'
        ], 200);
    }

        /*
|--------------------------------------------------------------------------
| START OF LOGOUT FUNCTION
|--------------------------------------------------------------------------
*/ 

    public function logout() {
        auth()->user()->tokens() -> delete();

        return response() -> json([
            'message' => 'Succefully logged out'
        ]);
    }


           /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO LIST ALL RECORDS
|--------------------------------------------------------------------------
*/ 

        public function index()
    {
        $users = User::all();
        $total = $users->count();
        return response()->json([
            'data' => $users,
            'total users' =>$total,
            'message' => 'Users Data Fetched Successfully'],200);
    }

        /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO SEARCH A RECORD
|--------------------------------------------------------------------------
*/  
                public function search($name)
                {
                    $result = User::where('email', 'LIKE', '%'. $name. '%')->get();
                    if(count($result)){
                     return Response()->json($result);
                    }
                    else
                    {
                    return response()->json(['Result' => 'No Data not found'], 404);
                  }
                }

        /*
|--------------------------------------------------------------------------
| START OF FUNCTION TO UPDATE A RECORD
|--------------------------------------------------------------------------
*/  
        public function update(Request $request, User $user)
            {
                $input = $request->all();

                $validator = Validator::make($input, [
                    'first_name' => 'required',
                    //'middle_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required',
                    'active' => 'required',
                ]);

                if($validator->fails()){
                    return $this->sendError($validator->errors());       
                }

                $user->first_name = $input['first_name'];
                $user->middle_name = $input['middle_name'];
                $user->last_name = $input['last_name'];
                $user->email = $input['email'];
                $user->active = $input['active'];
                $user->save();
                
                return response()->json([
                    'data' => $user,
                    'message' => 'Record Updated Successfully'
                ],200);
            }

        /*
|--------------------------------------------------------------------------
| TOTAL USERS
|--------------------------------------------------------------------------
*/  
        public function users_count()
            {
                $total_users = User::count();
           
            return response()->json([
            'total users' =>$total_users,
            'message' => 'Fetched Successfully'],200);            

            }
   /*
|--------------------------------------------------------------------------
| TOTAL ACTIVE USERS
|--------------------------------------------------------------------------
*/   
       public function total_active_users()
        {
            //
           $total_active_users = User:: where('active', '=', '1')->count();
           
            return response()->json([
            'total active users' =>$total_active_users,
            'message' => 'Fetched Successfully'],200);
          
        }

 /*
|--------------------------------------------------------------------------
| TOTAL INACTIVE USERS
|--------------------------------------------------------------------------
*/   
       public function total_inactive_users()
        {
            //
           $total_inactive_users = User:: where('active', '=', '0')->count();
           
            return response()->json([
            'total inactive users' =>$total_inactive_users,
            'message' => 'Fetched Successfully'],200);
        }

 /*
|--------------------------------------------------------------------------
| AUTHENTICATION FAILURE
|--------------------------------------------------------------------------
*/ 

    public function authentication_failed()
    {
        return json_encode("Authentication Failed");
    }

 /*
|--------------------------------------------------------------------------
| END
|--------------------------------------------------------------------------
*/ 

}
