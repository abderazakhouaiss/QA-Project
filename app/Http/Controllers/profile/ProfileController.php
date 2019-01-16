<?php

namespace App\Http\Controllers\profile;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $phoneIndicatif = 'https://gist.githubusercontent.com/Goles/3196253/raw/9ca4e7e62ea5ad935bb3580dc0a07d9df033b451/CountryCodes.json';
        $client0 = new Client();
        $ph = $client0->get($phoneIndicatif);
        $ph1 = \GuzzleHttp\json_decode($ph->getBody()->getContents());
        $tags = array();
        $questions = array();
        $id = Session::get('_id');
        if ($id) {
            $url = 'http://localhost:3000/api/users/';
            $url2 = 'http://localhost:3000/api/relations';
            $url3 = 'http://localhost:3000/api/tags/';
            $client = new Client();
            $res = $client->get($url . $id);
            if ($res->getStatusCode() != 200) {
                redirect('login');
            }
            $user = json_decode($res->getBody()->getContents())->result;
            if(isset($user->tags)){
                $res2 = $client->get($url2,[RequestOptions::JSON => ['id1' => $id,'typeI'=>'interets']]);
                $relations = \GuzzleHttp\json_decode($res2->getBody()->getContents())->result;
                for ($i=0;$i<count($relations);$i++){
                    $tt = $client->get($url3.$relations[$i]->_end);
                    array_push($tags,json_decode($tt->getBody()->getContents())->result);
                }
            }
            $res = $client->get($url2,[RequestOptions::JSON => ['id1' => $id,'typeI'=>'question_de']]);
            $relationQU = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            for ($i = 0;$i < count($relationQU);$i++){
                $tags1 = array();
                $res = $client->get('http://localhost:3000/api/questions/'.$relationQU[$i]->_end);
                $question = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
                $res = $res = $client->get($url2,[RequestOptions::JSON => ['id1' => $question->_id,'typeI'=>'interets_question']]);
                $relationQT = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
                for ($k=0;$k<count($relationQT);$k++){
                    $res = $client->get($url3.$relationQT[$k]->_end);
                    $tag = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
                    array_push($tags1,$tag);
                }
                $question->tags = $tags1;
                array_push($questions,$question);
            }
            //dd($questions);
            return view('profile.page-profile', ['user' => $user, 'pi' => $ph1, 'questions' => $questions,'tags'=>$tags]);
        } else {
            return redirect('login');
        }
    }

    public function continueRegister(Request $request)
    {
        $id = Session::get('_id');
        $data = $request->all();
        $tags = $data['tags'];
        unset($data['tags']);
        if (count($tags) > 0) {
            /*$urlT = 'http://localhost:3000/api/tags/';
            $urlR = 'http://localhost:3000/api/relations/';

            for ($i=0; $i < count($tags); $i++){
                $ress = $clientt->post($urlT,[RequestOptions::JSON =>['item'=>['name'=>$tags[$i]]]]);
                $idT = json_decode($ress->getBody()->getContents())->result;
                $clientt->post($urlR,[RequestOptions::JSON =>['id1'=>$id,'id2'=>$idT,'typeI'=>'interets']]);
            }*/
            $client = new Client();
            $urlT = 'http://localhost:3000/api/tags/';
            $res = $client->get($urlT);
            $tgs = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            $urlR = 'http://localhost:3000/api/relations/';
            $clientt = new Client();
            for ($i=0; $i < count($tags); $i++){
                $iid = 0;
                for ($j=0;$j<count($tgs);$j++) {
                    if ($tgs[$j]->name == $tags[$i]){
                        $iid = $tgs[$j]->_id;
                    }
                }
                if ($iid == 0){
                    $ress = $clientt->post($urlT,[RequestOptions::JSON =>['item'=>['name'=>$tags[$i]]]]);
                    $idT = json_decode($ress->getBody()->getContents())->result;
                    $clientt->post($urlR,[RequestOptions::JSON =>['id1'=>$id,'id2'=>$idT,'typeI'=>'interets']]);
                }else{
                    $clientt->post($urlR,[RequestOptions::JSON =>['id1'=>$id,'id2'=>$iid,'typeI'=>'interets']]);
                }
            }
        }
        $data['tags'] = count($tags);
        $url = 'http://localhost:3000/api/users/';

        $client0 = new Client();
        $res0 = $client0->get($url . $id);
        $user = json_decode($res0->getBody()->getContents())->result;

        $client = new Client();
        $res = $client->put($url . $id, [RequestOptions::JSON => ['newItem' => $data, 'oldItem' => $user]]);

        if ($res->getStatusCode() == 200) {
            return redirect('account');
        } else {
            return redirect('account')->with(['msg' => 'Une erreur est survenue Réessayez.']);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $id = Session::get('_id');
        $data = $request->all();
        $url = 'http://localhost:3000/api';
        $client = new Client();
        $res = $client->get($url.'/users/'.$id);
        $user = json_decode($res->getBody()->getContents())->result;
        $res = $client->put($url.'/users/'. $id, [RequestOptions::JSON => ['newItem' => $data, 'oldItem' => $user]]);
        if ($res->getStatusCode() == 200) {
            return redirect('account');
        } else {
            return redirect('account')->with(['msg' => 'Une erreur est survenue Réessayez.']);
        }
    }

    public function follow($id)
    {
        $idUser = Session::get('_id');
        die($id . ' ' . $idUser);
    }
}
