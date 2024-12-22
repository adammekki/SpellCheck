<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



use function Pest\Laravel\json;

class productsController extends Controller
{
    /// USER APIS ///

    /**
     * Display a listing of the resource.
     */
    public function indexUsers()
    {
        //import the products model
        $users=User::all();
        return response()->json($users);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeUsers(Request $request)
    {
        $validatedData=$request->validate([
            'username'=>'required',
            'password'=>'required',
            'credit'=>'numeric',
            'startDate'=>'required',
            'endDate'=>'required',
            'type'=>'required'
        ]);
        $user=User::create($validatedData);
        return response()->json($user,201);
    }

    /**
     * Display the specified resource.
     */
    public function showUsers(string $username)
    {
        $user = User::where('username', $username)->first();
        if(!$user){
            return response()->json(['message'=>'user not found'],404);
        }      
            return response()->json($user);           
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateUsers(Request $request, string $username)
    {
        $user = User::where('username', $username)->first();
        if(!$user){
            return response()->json(['message'=>'user not found'],404);

        }
        $validatedData=$request->validate([
            'password'=>'required',
            'credit'=>'numeric'

        ]);
        $user->update($validatedData);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyUsers(string $username)
    {
        $user = User::where('username', $username)->first();
        if(!$user){
            return response()->json(['message'=>'user not found'],404);

        }
        $user->delete();
        return response()->json(['message'=>'user deleted successfully']);
    }
    public function login(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to find the user by username
        $user = User::where('username', $validatedData['username'])->first();

        // Check if user exists and passwords match
        if ($user && $user->password === $validatedData['password']) {
            // Optionally, you can call the existing showUsers method to get user data
            return $this->showUsers($user->username);
        }

        // If authentication fails, return an unauthorized response
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
    /// SCORE APIS ///

    /**
     * Display a listing of the resource.
     */
    public function indexScores()
    {
        //import the products model
        $scores=Score::all();
        return response()->json($scores);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function storeScores(Request $request)
    {
        $validatedData=$request->validate([
            'user_id'=>'required',
            'username'=>'required',
            'score'=>'numeric'
        ]);
        $score=Score::create($validatedData);
        return response()->json($score,201);
    }

    /**
     * Display the specified resource.
     */
    public function showScores(string $username)
    {
        $score = Score::where('username', $username)->first();
        if(!$score){
            return response()->json(['message'=>'score not found'],404);
        }      
            return response()->json($score);           
    }


    /**
     * Update the specified resource in storage.
     */
    public function updateScores(Request $request, string $username)
    {
        $score = Score::where('username', $username)->first();
        if(!$score){
            return response()->json(['message'=>'score not found'],404);

        }
        $validatedData=$request->validate([
            'score'=>'numeric'

        ]);
        $score->update($validatedData);
        return response()->json($score);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyScores(string $username)
    {
        $score = Score::where('username', $username)->first();
        if(!$score){
            return response()->json(['message'=>'score not found'],404);

        }
        $score->delete();
        return response()->json(['message'=>'Score deleted successfully']);
    }
}
