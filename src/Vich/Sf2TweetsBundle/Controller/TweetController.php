<?php

namespace Vich\Sf2TweetsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\View;
use Vich\Sf2TweetsBundle\Entity\Tweet;

/**
 * TweetController.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class TweetController extends Controller
{
    /**
     * The get tweets action.
     * 
     * @View
     */
    public function getTweetsAction()
    {
        $manager = $this->get('vich_sf2tweets.tweet_manager');
        $tweets = $manager->findCurrentTweets();
 
        return array('tweets' => $tweets);
    }
    
    /**
     * The post tweets action.
     * 
     * @View
     */
    public function postTweetsAction()
    {
        $form = $this->get('vich_sf2tweets.form.tweet');
        $handler = $this->get('vich_sf2tweets.form.handler.tweet');
        
        $success = $handler->handle();
        if ($success) {
            return array('tweet' => $form->getData());
        }
        
        return array('form' => $form);
    }
}