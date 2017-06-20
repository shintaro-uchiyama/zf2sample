<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegistController extends AbstractActionController
{
     /**
     * 入力画面表示
     * @return ViewModel
     */
    public function inputAction()
    {
        return new ViewModel();
    }

     /**
     * 確認画面表示
     * @return ViewModel
     */
    public function confirmAction()
    {
        return new ViewModel();
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
}
