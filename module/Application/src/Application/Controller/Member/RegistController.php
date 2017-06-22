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
    const VIEW_INPUT = '/member/regist/input/';
    const VIEW_CONFIRM = 'confirm/';
    const INPUT_FILTER_MEMBER_REGIST = 'Regist/RegistInputFilter';

     /**
     * 入力画面表示
     * @return ViewModel
     */
    public function inputAction()
    {
        $inputs = $this->createInputFilter();
        $form = [];

        // conversationTableに格納
        $cvid = $this->params()->fromRoute('cvid');
        // 初期表示
        if (is_null($cvid)) {
            // cvid発行
            $cvid = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            // 完了からの戻り
            $cvData = $this->getConversationService()->get($cvid);
            $inputs->setData($cvData);
            
            $form['isValid'] = $inputs->isValid() ? true : false;
        }

        $form = array_merge($form, $inputs->getInputs());

        $viewModel = new ViewModel();
        $viewModel->setVariables([
            'inputs' => $form,
            'cvid' => $cvid,
        ]);
        return $viewModel;
    }

     /**
     * 確認画面表示
     * @return ViewModel
     */
    public function confirmAction()
    {
        $inputs = $this->createInputFilter();
        $postData = $this->params()->fromPost();
        $inputs->setData($postData);

        // conversationTableに格納
        $cvid = $this->params()->fromRoute('cvid');
        $this->getConversationService()->set($postData, $cvid);

        if ($inputs->isValid()) {
            $viewModel = new ViewModel();
            $viewModel->setVariables([
                'inputs' => $inputs->getInputs(),
                'cvid' => $cvid,
            ]);
            return $viewModel;
        } else {
            return $this->redirect()->toUrl(self::VIEW_INPUT. $cvid);
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
     * @return RegistService
     */
    private function getRegistService()
    {
        return $this->getServiceLocator()->get('RegistService');
    }

    /**
     * @return ConversationService
     */
    private function getConversationService()
    {
        return $this->getServiceLocator()->get('ConversationService');
    }
}
