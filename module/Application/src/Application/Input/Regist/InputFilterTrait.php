<?php
namespace Application\Input\Regist;

use Zend\InputFilter\InputFilter;

trait InputFilterTrait 
{
    private function addLoginId()
    {
        $this->add([
            'name' => 'login_id',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StringTrim'    
                ]
            ],
            'validators' => [               
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 4,        
                        'max' => 10,
                        'encoding' => 'UTF-8',
                        'messages' => [
                            'stringLengthTooShort' => '短すぎる', 
                            'stringLengthTooLong' => '長すぎる'  
                        ],
                    ],
                ],
            ],
        ]);
    }
}
?>
