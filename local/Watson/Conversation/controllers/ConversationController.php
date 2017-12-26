<?php

class  Watson_Conversation_ConversationController extends Mage_Core_Controller_Front_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function retornaDadosAction()
    {
        $this->getResponse()->setHeader('Content-Type', 'application/json');

//Id loja "f6bc4709-670b-4c95-ac3e-5db4ed7c49b0"
//Id pizzaria "8d224b18-8fa4-4e80-aeae-ddb4214b313d";
        $workspace = "0e3d9904-78a3-4dd6-b9e3-0f3977198cd7";
//Dados Lucas
        $username = "704c0b46-36a9-4bc3-a4dd-64648ace9e07";
        $password = "h7PmTVP3Hqm1";

//Meus dados
//$username = "3944ccfa-a121-4a27-a3bb-c8d0f4136a3c";
//$password = "h3dXGBYambRt";


        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/" . $workspace;
        $urlMessage = $url . "/message?version=2017-12-08";

        $dados =  json_encode($_REQUEST);

        $headers = array('Content-Type:application/json');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlMessage);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $retorno = curl_exec($ch);

        curl_close($ch);
        $retorno = json_decode($retorno);

       $body = json_encode($retorno, JSON_PRETTY_PRINT);

       $this->getResponse()->setBody($body);

    }

}

