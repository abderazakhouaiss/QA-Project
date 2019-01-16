<?php

namespace App\Http\Controllers\reg;


use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
    }

    public function googleData($provider)
    {
        $url = 'http://localhost:3000/api/users';
        $client0 = new Client();
        $res = $client0->get($url);
        $data1 = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
        $user = Socialite::driver($provider)->user();
        if ($provider == 'facebook') {
            //unset($user->user);
            for ($i = 0; $i < count($data1); $i++) {
                if ($data1[$i]->email == $user['email']) {
                    Session::put('_id', $data1[$i]->_id);
                    return redirect('account');
                }
            }
        } else {
            //unset($user->user);
            for ($i = 0; $i < count($data1); $i++) {
                if ($data1[$i]->email == $user->email) {
                    Session::put('_id', $data1[$i]->_id);
                    return redirect('account');
                }
            }
        }
        $user->user = \GuzzleHttp\json_encode($user->user);
        //dd($user);
        $client = new Client();
        $res = $client->post($url, [RequestOptions::JSON => ['item' => $user]]);
        if ($res->getStatusCode() == 200) {
            $_id = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            Session::put('_id', $_id);
            return redirect('account');
        }
        return redirect('/register');
    }
}
