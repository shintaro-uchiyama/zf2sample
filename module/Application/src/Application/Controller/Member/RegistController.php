<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller\Member;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\InputFilter\Factory;

class RegistController extends AbstractActionController
{

     const INPUT_FILTER_MEMBER_REGIST = 'Regist/RegistInputFilter';

     /**
     * 入力画面表示
     * @return ViewModel
     */
    public function inputAction()
    {
        $inputs = $this->createInputFilter();

        $viewModel = new ViewModel();
        $viewModel->setVariables(['inputs' => $inputs->getInputs()]);
        return $viewModel;
    }

     /**
     * 確認画面表示
     * @return ViewModel
     */
    public function confirmAction()
    {
        $inputs = $this->createInputFilter();
        $inputs->setData($this->params()->fromPost());

        $viewModel = new ViewModel();
        $viewModel->setVariables(['inputs' => $inputs->getInputs()]);
        return $viewModel;
    }

     /**
     * 仮登録画面表示
     * @return ViewModel
     */
    public function provCompleteAction()
    {
        return new ViewModel();
    }

     /**
     * メール確認画面表示
     * @return ViewModel
     */
    public function checkEmailAction()
    {
        return new ViewModel();
    }

    /**
     * @return InputFilterInterface
     */
    private function createInputFilter()
    {
        $factory = new Factory();
        $inputs = $factory->createInputFilter(array(
            'login_id' => array(
                'name'       => 'login_id',
                'required'   => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                    array(
                        'name' => 'string_length',
                        'options' => array(
                            'min' => 4
                        ),
                    ),
                ),
            ),
        ));
        return $inputs;
    }
}
