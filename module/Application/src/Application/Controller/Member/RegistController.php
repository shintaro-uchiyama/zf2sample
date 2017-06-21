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
use Zend\Session\Container;

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

        /* sessionを使うとき用
        $sessionManager = $this->getSessionManager();
        $container = new Container('userStateContainer', $sessionManager);
        $container->page = '333';
         */

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
        /* sessionを使うとき用
        $sessionManager = $this->getSessionManager();
        $container = new Container('userStateContainer', $sessionManager);
        var_dump($sessionManager->getId(), $container->page);
         */

        $inputs = $this->createInputFilter();
        $inputs->setData($this->params()->fromPost());

        if ($inputs->isValid()) {
            $viewModel = new ViewModel();
            $viewModel->setVariables(['inputs' => $inputs->getInputs()]);
            return $viewModel;
        } else {
            var_dump($inputs->getMessages());exit;
        }
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
        $spec = $this->getRegistService()->getInputSpec();
        $factory = new Factory();
        $inputs = $factory->createInputFilter($spec);
        return $inputs;
    }

    /**
     * @return SessionManager
     */
    private function getSessionManager()
    {
        return $this->getServiceLocator()->get('SessionManager');
    }

    /**
     * @return SessionManager
     */
    private function getRegistService()
    {
        return $this->getServiceLocator()->get('RegistService');
    }
}
