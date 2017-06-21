<?php

namespace Application\Model\Member\Regist;

use Zend\InputFilter\InputFilterInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * 会員登録サービス
 */
class RegistService
{
    /**
    ¦* 入力フォーム仕様を取得する。
    ¦* @return InputSpec
    ¦*/
    public function getInputSpec()
    {
        return  new InputSpec($this);
    }
}
