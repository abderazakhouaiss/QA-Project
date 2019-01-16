<?php

namespace App\Http\Controllers\actualite;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ActualiteController extends Controller
{
    public function home(Request $request)
    {
        $id = Session::get('_id');
        $users = array();
        $client = new Client();
        $url = 'http://localhost:3000/api/';
        $res = $client->get($url . 'questions');
        $usersFollow = array();
        $questions = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
        for ($i = 0; $i < count($questions); $i++) {
            $res = $client->get($url . 'relations', [RequestOptions::JSON => ['id1' => $questions[$i]->_id, 'typeI' => 'interets_question']]);
            $relations = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            $tags = array();
            for ($j = 0; $j < count($relations); $j++) {
                $res = $client->get($url . 'tags/' . $relations[$j]->_end);
                $tag = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
                array_push($tags, $tag);
            }

            $res = $client->get($url . 'relations', [RequestOptions::JSON => ['id1' => $questions[$i]->_id, 'typeI' => 'question_de']]);
            $relations = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;

            $res = $client->get($url . 'users/' . $relations[0]->_start);
            $user = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            array_push($users, $user);
            $questions[$i]->tags = $tags;

            $res = $client->get($url . 'relations', [RequestOptions::JSON => ['id1' => $questions[$i]->_id, 'typeI' => 'reponse_question']]);
            $relationQR = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            $answers = array();
            for ($k=0;$k<count($relationQR);$k++){
                $res = $client->get($url . 'answers/' . $relationQR[$k]->_start);
                $answer = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;

                $res = $client->get($url . 'relations', [RequestOptions::JSON => ['id1' => $answer->_id, 'typeI' => 'reponse_de']]);
                $relationRU = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
                $res = $client->get($url . 'users/' . $relationRU[0]->_end);
                $userR = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
                $answer->user = $userR;

                $res = $client->get($url . 'relations', [RequestOptions::JSON => ['id1' => $answer->_id, 'typeI' => 'reponse_vote']]);
                $relationUV = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
                $usersVotes = array();
                foreach ($relationUV as $rel){
                    array_push($usersVotes,$rel->_start);
                }
                $answer->userVotes = $usersVotes;
                array_push($answers, $answer);
            }
            $questions[$i]->answers = $answers;

            $res = $client->get($url.'relations',[RequestOptions::JSON => ['id1' => $id, 'typeI' => 'abonne_a']]);
            $abonnements = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            foreach ($abonnements as $ab){
                array_push($usersFollow,$ab->_end);
            }
        }
        return view('actualite.actualite', ['questions' => $questions, 'users' => $users,'abonnements'=>$usersFollow]);
    }

    public function addResponse(Request $request, $userId, $questionId)
    {
        $data = $request->all();
        unset($data['_token']);
        $video = $request->get('video');
        if ($video[0] == null) {
            unset($data['video']);
        }
        $image = $request->get('image');
        if ($image[0] == null) {
            unset($data['image']);
        }
        $date = date('H:i Y-m-d');
        $data = array_merge($data, ['date' => $date]);
        $url = 'http://localhost:3000/api';
        $client = new Client();
        $res = $client->post($url . '/answers', [RequestOptions::JSON => ['item' => $data]]);
        if ($res->getStatusCode() == 200) {
            $answerId = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;

            $res = $client->post($url . '/relations', [RequestOptions::JSON => ['id1' => $answerId, 'id2' => $questionId, 'typeI' => 'reponse_question']]);
            $res = $client->post($url . '/relations', [RequestOptions::JSON => ['id1' => $answerId, 'id2' => $userId, 'typeI' => 'reponse_de']]);
            if ($res->getStatusCode() == 200) {
                return redirect('/timeline')->with(['msg' => 'Succés! Réponse bien ajoutée.']);
            }else{
                return redirect('/timeline')->with(['msg' => 'erreur! Réessayer plus tard.']);
            }
        } else {
            return redirect('/timeline')->with(['msg' => 'erreur! Réessayer plus tard.']);
        }
    }

    public function voteResponse($idResponse){
        $id = Session::get('_id');
        $url = 'http://localhost:3000/api';
        $client = new Client();
        $res = $client->get($url.'/answers/'.$idResponse);
        $oldAnswer = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
        $newAnswer = $oldAnswer;
        if(isset($newAnswer->votes)){
            $newAnswer->votes = $newAnswer->votes + 1;
        }else{
            $newAnswer->votes = 1;
        }
        $res = $client->put($url.'/answers/'.$idResponse, [RequestOptions::JSON => ['newItem' => $newAnswer, 'oldItem' => $oldAnswer]]);
        if($res->getStatusCode() == 200){
            $res = $client->post($url.'/relations/',[RequestOptions::JSON =>['id1'=>$id,'id2'=>$newAnswer->_id,'typeI'=>'reponse_vote']]);
            if($res->getStatusCode() == 200){
                return redirect('/timeline');
            }
        }
    }

    public function follow($idF){
        $id = Session::get('_id');
        $url = 'http://localhost:3000/api';
        $client = new Client();
        $res = $client->post($url.'/relations/',[RequestOptions::JSON =>['id1'=>$id,'id2'=>$idF,'typeI'=>'abonne_a']]);
        return redirect('/timeline');
    }
}
