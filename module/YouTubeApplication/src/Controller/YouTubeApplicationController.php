<?php


namespace YouTubeApplication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class YouTubeApplicationController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}