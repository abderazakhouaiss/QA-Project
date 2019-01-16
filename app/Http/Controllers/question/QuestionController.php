<?php

namespace App\Http\Controllers\question;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function index(Request $request){
        return view('questions.question');
    }
    public function addQuestion(Request $request){
        $data = $request->all();
        $video = $request->get('video');
        if($video[0] == null){
            unset($data['video']);
        }
        $image = $request->get('image');
        if($image[0] == null){
            unset($data['image']);
        }
        $date = date('H:i Y-m-d');
        $id = Session::get('_id');
        $url = 'http://localhost:3000/api/questions/';
        if(!$id){
            redirect('login');
        }else{
            $data = array_merge($data, ['date'=>$date]);
            $client = new Client();
            $tags = $data['tags'];
            unset($data['tags']);
            $res = $client->post($url,[RequestOptions::JSON =>['item'=>$data]]);
            $idQ = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            if (count($tags) > 0) {
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
                        $clientt->post($urlR,[RequestOptions::JSON =>['id1'=>$idQ,'id2'=>$idT,'typeI'=>'interets_question']]);
                    }else{
                        $clientt->post($urlR,[RequestOptions::JSON =>['id1'=>$idQ,'id2'=>$iid,'typeI'=>'interets_question']]);
                    }
                }
            }
            $url = 'http://localhost:3000/api/relations/';
            $res = $client->post($url,[RequestOptions::JSON =>['id1'=>$id,'id2'=>$idQ,'typeI'=>'question_de']]);
            if($res->getStatusCode() == 200){
                return redirect('account');
            }else{
                return redirect('question')->with(['msg'=>'Une erreur est survenue Réessayez.']);
            }
        }
    }
    public function updateQuestion(Request $request){
        /*$url3 = 'http://localhost:3000/api/tags/';
        $url = 'http://localhost:3000/api/relations';
        $questions = array();
        $id = Session::get('_id');
        $client = new Client();
        $res = $client->get($url,[RequestOptions::JSON => ['id1' => $id,'typeI'=>'question_de']]);
        $relations = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
        for ($i=0;$i<count($relations);$i++){
            $tt = $client->get($url3.$relations[$i]->_end);
            array_push($questions,json_decode($tt->getBody()->getContents())->result);
        }*/
        $url = 'http://localhost:3000/api';
        $questions = array();
        $id = Session::get('_id');
        $client = new Client();
        $res = $client->get($url.'/relations',[RequestOptions::JSON => ['id1' => $id,'typeI'=>'question_de']]);
        $relationQU = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
        for ($i = 0;$i < count($relationQU);$i++){
            $tags1 = array();
            $res = $client->get('http://localhost:3000/api/questions/'.$relationQU[$i]->_end);
            $question = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            $res = $res = $client->get($url.'/relations',[RequestOptions::JSON => ['id1' => $question->_id,'typeI'=>'interets_question']]);
            $relationQT = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
            for ($k=0;$k<count($relationQT);$k++){
                $res = $client->get($url.'/tags/'.$relationQT[$k]->_end);
                $tag = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
                array_push($tags1,$tag);
            }
            $question->tags = $tags1;
            array_push($questions,$question);
        }
        return view('questions.update',['questions'=>$questions]);
    }

    public function deleteQuestion(Request $request,$idQ){
        /*$url = 'http://localhost:3000/api/questions/';
        $client = new Client();
        $res = $client->delete($url.$id);
        if($res->getStatusCode() == 200){
            return redirect('/question/update')->with(['msg'=>'Questionne supprimée avec succés.']);
        }else{
            return redirect('/question/update')->with(['msg'=>'Problème survenue, essayez plus tard.']);
        }*/
        $url = 'http://localhost:3000/api';
        $client = new Client();
        $res = $client->get($url.'/relations',[RequestOptions::JSON => ['id1' => $idQ,'typeI'=>'']]);
        $relations = \GuzzleHttp\json_decode($res->getBody()->getContents())->result;
        $test = true;
        for ($i = 0;$i < count($relations);$i++){
            $res = $client->delete($url.'/relations/'.$relations[$i]->_id);
            if(\GuzzleHttp\json_decode($res->getBody()->getContents())->result == false){
                $test = false;
                break;
            }
        }
        if ($test == false){
            return redirect('/question/update')->with(['msg'=>'Problème survenue, essayez plus tard.']);
        }else{
            $res = $client->delete($url.'/questions/'.$idQ);
            if($res->getStatusCode() == 200){
                return redirect('/question/update')->with(['msg'=>'Questionne supprimée avec succés.']);
            }else{
                return redirect('/question/update')->with(['msg'=>'Problème survenue, essayez plus tard.']);
            }
            return redirect('/question/update')->with(['msg'=>'Questionne supprimée avec succés.']);
        }
    }

}
