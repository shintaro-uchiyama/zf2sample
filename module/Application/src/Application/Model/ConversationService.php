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

    public function set($postData, $cvid)
    {
        $conversationTable = $this->getConversationTable();
        $dataSerialize = serialize($postData);
        if ($conversationTable->findById($cvid)) {
            $conversationTable->updateCvdata($dataSerialize, $cvid);
        } else {
            $conversationTable->save($dataSerialize, $cvid);
        }
    }

    public function get($id)
    {
        $conversationTable = $this->getConversationTable();
        $dataSerialized = $conversationTable->findById($id); 
        return unserialize($dataSerialized['data']);
    }

    private function getConversationTable()
    {
        return $this->getServiceLocator()->get('ConversationTable');
    }
}
