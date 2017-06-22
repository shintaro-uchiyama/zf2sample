<?php

namespace Application\Resource\Db;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class ConversationTable extends AbstractTableGateway
{

    public function __construct()
    {
         $this->table = 'conversation';
         $this->featureSet = new Feature\FeatureSet();
         $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
         $this->initialize();
    }

    /**
     * カンバセーションを指定して
     * @param string $id カンバセーションID
     * @return array|null
     */
    public function findById($id)
    {
        return $this->select(['id' => $id])->current();
    }

    /**
     * Conversationデータを保存する
     * @param array $row 行データ,
     */
    public function save($row)
    {
        var_dump($row);exit;
        $this->delete(['id' => $row['id']]);
        $this->insert($row);
    }
}

