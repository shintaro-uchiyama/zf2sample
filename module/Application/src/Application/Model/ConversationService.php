<?php

namespace Application\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

/**
 * Conversationの存在チェック、読み書きを管理する。
 */
class ConversationService implements ServiceLocatorAwareInterface 
{
    use ServiceLocatorAwareTrait;

    public function save($postData)
    {
        $conversationTable = $this->getConversationTable();
        $conversationTable->save($postData);
    }

    public function getData($id)
    {
    }

    private function getConversationTable()
    {
        return $this->getServiceLocator()->get('ConversationTable');
    }
}
