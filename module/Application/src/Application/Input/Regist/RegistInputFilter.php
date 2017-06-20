<?php
namespace Application\Input\Regist;

use Zend\InputFilter\InputFilter;

class RegistInputFilter extends InputFilter
{
    use InputFilterTrait;

    public function init()
    {
        $this->addLoginId();
    }
}
?>
