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
            $search = preg_replace('/[^A-Za-z0-9\-]/', '', $search);

            $videoData = $this->getYoutubeVideos($search);

            if($videoData){
                $this->getResponse()->setStatusCode(200);
                $this->getResponse()->setContent(json_encode(array('result'=>'true', 'data'=>$videoData)));
                return $this->getResponse();
            }

            $this->getResponse()->setStatusCode(200);
            $this->getResponse()->setContent(json_encode(array('result'=>'false', 'message'=>'Something is not correct, we are working to fix it ASAP!')));
            return $this->getResponse();

        }
    }

    protected function getYoutubeVideos($keyword){
        $apikey = 'PAST_YOUR_API_KEY_HERE';
        $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=' . 10 . '&key=' . $apikey . '&regionCode=IE';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($response);
        $value = json_decode(json_encode($data), true);

        return $value;
    }
}