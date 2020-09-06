<?php


namespace YouTubeApplication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class YouTubeApplicationController extends AbstractActionController
{
    public function indexAction()
    {
        $request = $this->getRequest();

        if($request->isPost()){
            $search = $request->getPost('search');
            $this->getResponse()->setStatusCode(200);
            $this->getResponse()->setContent(json_encode(array('result'=>'true', 'message'=>'good')));
            return $this->getResponse();

        }
    }




}