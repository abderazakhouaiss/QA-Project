<?php

namespace App\Http\Controllers\reg;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function register(Request $request){
        $phoneIndicatif = 'https://gist.githubusercontent.com/Goles/3196253/raw/9ca4e7e62ea5ad935bb3580dc0a07d9df033b451/CountryCodes.json';
        $client0 = new Client();
        $ph = $client0->get($phoneIndicatif);
        $ph1 = \GuzzleHttp\json_decode($ph->getBody()->getContents());


        $url = 'http://localhost:3000/api/users';
        $client = new Client();
        $res = $client->get($url);
        $data1 = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
        if($request->request->all()){
            $url = 'http://localhost:3000/api/users';
            $data = $request->request->all();
            array_pop($data);
            $email = $data['email'];
            for ($i = 0; $i < count($data1); $i++){
                if($data1[$i]->email == $email){
                    return view('reg.registration',['msg'=>'L\'email existe déja!','pi'=>$ph1]);
                }
            }
            $client = new Client();
            $res = $client->post($url,[RequestOptions::JSON =>['item'=>$data]]);
            $_id = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            Session::put('_id', $_id);
            return redirect('/account');
        }

        return view('reg.registration',array('pi'=>$ph1));
    }
}
