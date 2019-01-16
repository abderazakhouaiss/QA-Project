<?php

namespace App\Http\Controllers\login;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        return view('login.page-login');
    }

    public function loginCheck(Request $request)
    {
        $email = $request->get('email');
        $pass = $request->get('pass');
        $url = 'http://localhost:3000/api/query/users';
        $client = new Client();
        $user = ['email' => $email, 'password' => $pass];
        $res = $client->post($url, [RequestOptions::JSON => ['query' => $user]]);

        $rec = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
        if (count($rec) > 0) {
            $_id = $rec[0]->_id;
            Session::put('_id', $_id);
            return redirect('/account');
        }else{
            return view('login.page-login',['msg'=>'Email ou mot de passe incorrect.']);
        }
    }
}
