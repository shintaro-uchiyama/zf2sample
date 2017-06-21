<?php

namespace Application\Model\Member\Regist;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\InputFilter\Input;
use Zend\Filter\StringTrim;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\StringLength;

/**
 * 会員登録フォームの仕様
 * @package Application\Model\Member
 */
class InputSpec implements InputFilterProviderInterface
{
    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [
            $this->loginId(),
            //$this->password(),
        ];
    }

    /**
     * ログインID
     * @return \Zend\InputFilter\InputInterface
     */
    public function loginId()
    {
        $input = new Input('login_id');

        $input->getFilterChain()
            ->attach(new StringTrim());

        $input->getValidatorChain()
            ->attach(new StringLength(['max' => 4]))
            ->attach(new Alnum());

/*            ->attach(
                Validators::callback(function ($id) {
                    return !$this->service->loginIdExists($id);
                })->setMessage('既に使用されています。')
            );*/
        return $input;
    }

}
