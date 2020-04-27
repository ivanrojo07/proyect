<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    //
    public $http,$token_url,$client,$rules;

    public function __construct()
    {
    	$this->token_url = url('/oauth/token');
    	$this->client = Client::find(2);
    	$this->http = new GuzzleClient;
    	$this->rules = [
    		'email' => 'required|string|email',
    		'password' => 'required|string'
    	];
    }


    public function login(Request $request){
    	$request->validate($this->rules);
    	$credenciales = request(['email','password']);
    	if (!Auth::attempt($credenciales)) {
    		return response()->json(['message'=>'Unauthorized'],401);
    	}
    	else{
    		$user = Auth::user();
    		foreach($user->tokens as $token){
    			$token->update(['revoked'=>true]);
    		}
    		$email = $request->email;
    		$password = $request->password;
            try {
                $response = $this->http->post(
                        $this->token_url,
                        [
                            'form_params'=>[
                                'grant_type' => 'password',
                                'client_id' => $this->client->id,
                                'client_secret' => $this->client->secret,
                                'username' => $email,
                                'password' => $password,
                                'scope' => ''
                            ]
                        ]);
                return response()->json(['response'=>json_decode($response->getBody())],201);
            } catch (ClientException $e) {
                if ($e->hasResponse()) {
                    return response()->json(['errors'=>$e->getResponse()],422);
                }
                else{
                    return response()->json(['errors'=>$e],500);
                }
            }
    		

    	}
    	
    }
}
