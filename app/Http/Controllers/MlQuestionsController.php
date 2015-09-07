<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Ml\Meli;

session_start();

class MlQuestionsController extends Controller
{

    private $meli; 
    private $list;
    private $code;
 
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->code = $_GET['code'];
        $url = 'http://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=4883595089076522';
        echo "<a href='$url'>Refresh Token: </a>";
        $this->meli   = new Meli('4883595089076522', 'EKXklKN4kVoNJTEvEeWOEEID0tEWnWjI');
        $oAuth = $this->meli->authorize($this->code, 'http://www.abdonor.com.br/wdna/redirect.php');
        $_SESSION['access_token'] = $oAuth['body']->access_token;
        $params = array();
        $result = $this->meli->get('/my/received_questions/search?item=MLB-700312960&access_token='.$_SESSION['access_token'], $params);
        $this->list = $result['body']->questions;
        $this->list = array('list' =>  $this->list);
        return view('mlquestions', $this->list );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        echo "no function create ";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $url = 'http://auth.mercadolibre.com.ar/authorization?response_type=code&client_id=4883595089076522';

        echo "<a href='$url'>Refresh Token: </a>";
        $this->meli   = new Meli('4883595089076522', 'EKXklKN4kVoNJTEvEeWOEEID0tEWnWjI');
        $oAuth = $this->meli->authorize($_POST['code'], 'http://www.abdonor.com.br/wdna/redirect.php');
        $_SESSION['access_token'] = $oAuth['body']->access_token;
         
        $answer = array(
          "question_id" => $_POST['id'],
          "text" => $_POST['comment']
        );
        $item = $this->meli->post("/answers", $answer, array('access_token' => $_SESSION['access_token']));
    
        return redirect($url);
         

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        echo "no function show" . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        echo "no function edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
       echo "no function update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        echo "no function destroy";
    }

 
}
