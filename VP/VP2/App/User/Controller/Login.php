<?php

namespace VP2;


class User_Controller_Login extends Base_Controller_Abstract
{
    function mainAction()
    {
        echo 'We are here';
    }

    function testAction()
    {
        $userModel = User_Model_DB::getModelById(1);
        User_Model_DB::saveUser($userModel);
        $this->view->user = $userModel;


        $footerView = clone $this->view;
        $footerView->conters = [1,2,3];
        $footerView->setTemplatePath('');
        $this->view->footerTpl = $footerView->render('footer.phtml');
    }
}