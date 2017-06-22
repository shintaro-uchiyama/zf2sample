<?php

namespace Application\Resource\Db;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class ConversationTable extends AbstractTableGateway
{

    const EXPIRE_DATE = '1 hour';

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
    public function save($row, $cvid)
    {
        $exdt = date("Y-m-d H:i:s",strtotime(self::EXPIRE_DATE));

        $values = array(
            'id' => $cvid,
            'data' => $row,
            'expired_at' => $exdt,
        );
        $result = $this->insert($values);
        return $result;
    }

    public function updateCvdata($row, $cvid)
    {
        $exdt = date("Y-m-d H:i:s",strtotime(self::EXPIRE_DATE));
        $values = array(
            'data' => $row,
            'expired_at' => $exdt,
        );
        $where= array(
            'id' => $cvid,
        );
        $result = $this->update($values, $where);
        return $result;
    }
}

