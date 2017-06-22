<?php

namespace Application\Model\Member\Regist;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\InputFilter\Input;
use Zend\Filter\StringTrim;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\StringLength;
use Zend\Validator\Date;

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
            $this->mailAddress(),
            $this->password(),
        ];
    }

    /**
     * mail_address
     * @return \Zend\InputFilter\InputInterface
     */
    public function mailAddress()
    {
        $input = new Input('mail_address');

        $input->getFilterChain()
            ->attach(new StringTrim());

        $input->getValidatorChain()
            ->attach(new StringLength(['min' => 4]));

/*        $input->getValidatorChain()
            ->attach(
                Validators::callback(function ($value) {
                    return !$this->service->mailAddressExists($value);
                })
                ->setMessage('既に使用されています。')
            );
 */
        return $input;
    }

    public function password()
    {
        $input = new Input('password');
        $input->getValidatorChain()
            ->attach(new Alnum())
            ->attach(new StringLength(['max' => 4]));
        return $input;
    }
}
