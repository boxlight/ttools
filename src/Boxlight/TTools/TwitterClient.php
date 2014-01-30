<?php

namespace Boxlight\TTools;

use Boxlight\TTools\TTools;
use Boxlight\TTools\Exception\TToolsApiException;

class TwitterClient {

    private $ttools;

    public function __construct(array $config)
    {
        $this->ttools = new TTools($config);
    }

    public function getLastReqInfo()
    {
        return $this->ttools->getLastReqInfo();
    }

    public function get($path, $params = array(), $config = array())
    {
        $ret = $this->ttools->makeRequest('/' . TTools::API_VERSION . $path, $params, 'GET', $config);
        if (isset($ret['error']))
            throw new TToolsApiException($ret);
        else
            return $ret;
    }

    public function post($path, $params, $multipart = false, $config = array())
    {
        $ret = $this->ttools->makeRequest('/' . TTools::API_VERSION . $path, $params, 'POST', $multipart, $config);
        if (isset($ret['error']))
            throw new TToolsApiException($ret);
        else
            return $ret;
    }

    public function getCredentials()
    {
        return $this->get('/account/verify_credentials.json',
            array('include_entities' => false, 'skip_status' => true)
        );
    }

    public function getRemainingCalls()
    {
        return $this->get('/account/rate_limit_status.json');
    }

    public function getTimeline($limit = 10)
    {
        return $this->get('/statuses/home_timeline.json',array("count"=>$limit));
    }

    public function getUserTimeline($user_id = null, $screen_name = null, $limit = 10)
    {
        return $this->get(
            '/statuses/user_timeline.json',
            array(
                "count"       => $limit,
                "user_id"     => $user_id,
                "screen_name" => $screen_name,
            )
        );
    }

    public function getMentions($limit = 10)
    {
        return $this->get('/statuses/mentions_timeline.json',array("count"=>$limit));
    }

    public function getFavorites($limit = 10)
    {
        return $this->get('/favorites/list.json',array("count"=>$limit));
    }

    public function getTweet($tweet_id)
    {
        return $this->get('/statuses/show/' . $tweet_id . '.json');
    }

    public function update($message, $in_reply_to = null)
    {
        $message = strip_tags($message);

        return $this->post('/statuses/update.json', array(
            'status'      => $message,
            'in_reply_to_status_id' => $in_reply_to
        ));
    }

    public function updateWithMedia($image, $message, $in_reply_to = null)
    {
        $meta = getimagesize($image);
        $message = strip_tags($message);

        return $this->post('/statuses/update_with_media.json', array(
            'status'  => $message,
            'media[]' => '@' . $image . ';type=' . $meta['mime']
        ), true);
    }

    public function getInfos($user_id = null, $screen_name = null) {
        return $this->get(
            '/users/show.json',
            array(
                "user_id"     => $user_id,
                "screen_name" => $screen_name,
            )
        );
    }

}
