<?php

class PollsComponent extends Object {

    public function startup(&$controller) {
    }

    public function beforeRender(&$controller) {

        $controller->loadModel('Poll.Poll');
        $poll = $controller->Poll->find('first', array( 'conditions' => array( 'Poll.active' => 1 ) ));
        
        $hasVoted = $controller->Poll->ip_has_voted( $poll['Poll']['id'], $controller->RequestHandler->getClientIP() );

        $controller->set( compact( 'poll', 'hasVoted') );
    }

    public function shutdown(&$controller) {
    }



}
?>