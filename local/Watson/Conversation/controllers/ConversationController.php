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

        $workspace = Mage::getStoreConfig('conversation/credentials/workspace');
        $username = Mage::getStoreConfig('conversation/credentials/username');
        $password = Mage::getStoreConfig('conversation/credentials/password');

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

