<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\ConnectionLog;

class LoginController extends Controller
{

    protected function getLocation() {
        
              // Initialize cURL.
              $ch = curl_init();

              // Set the URL that you want to GET by using the CURLOPT_URL option.
              curl_setopt($ch, CURLOPT_URL, 'https://ipgeolocation.abstractapi.com/v1/?api_key=b055e2aef06747cb853ea7967ebae5be');

              // Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

              // Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

              // Execute the request.
              $data = curl_exec($ch);

              // Close the cURL handle.
              curl_close($ch);

              return json_decode($data);
              
    }
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
        $info = $this->getLocation();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        $auth = Auth::login($user);

        // if($info){
        //     ConnectionLog::create([
        //         'user_id' => Auth::user()->id,
        //         'ip_address' => $info->ip_address,
        //         'country' => $info->country,
        //         'city' => $info->city,
        //     ]);
        // }

        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        return redirect()->intended();
    }
}
