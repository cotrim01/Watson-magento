<?php

class Watson_Conversation_Block_ChatBot extends Mage_Core_Block_Template{

    public function __construct(array $args = array())
    {
        $this->setTemplate('watson/conversation/interface.phtml');
    }
}