<?php

class PollsController extends PollAppController {

    var $name = 'Polls';	
    var $uses = array('Poll.Poll','Poll.PollAnswer','Poll.PollVote');


    public function beforeFilter() {
           parent::beforeFilter();
           // CSRF Protection
           if ( in_array($this->params['action'], array('admin_add_store'))) {
               $this->Security->validatePost = false;
           }
    }

    function admin_index() {

        $polls = $this->Poll->find('all');
        
        $this->set('title_for_layout', __('Polls', true));
        $this->set(compact('polls'));

    }

    function admin_add() {
        $this->set('title_for_layout', __('Add Poll', true));
    }

    public function admin_add_store() {

        if( empty( $this->data ) ){
            $this->redirect( $this->referer() );
            return;
        }

        if( ! $this->Poll->save( $this->data ) ){

            $this->redirect_with_message(
                    $this->referer(),
                    __('Poll could not be saved', true)
            );
            return;
        }

        $this->redirect_with_message(
                array( 'plugin'=>'poll','controller'=>'polls', 'action'=>'admin_index'),
                __('Poll saved', true)
        );
    }


    function admin_edit($id = null) {

        $poll = $this->Poll->findById($id);

        if(!$poll){
            $this->redirect($this->referer());
            return;
        }

        $this->set(compact('poll'));
        $this->set('title_for_layout', __('Edit Poll', true));
        
    }

    function admin_delete($id = null) {

        $message = ( $this->Poll->delete($id, true) ) ? 'Poll deleted' : 'Error, try again';

        $this->redirect_with_message(
                array( 'plugin'=>'poll','controller'=>'polls', 'action'=>'admin_index'),
                __( $message, true)
        );
        
    }

    function vote(){
        
        $poll_answer_id = $this->params['form']['answer_id'];
        $this->PollVote->makeVote( $poll_answer_id, $this->RequestHandler->getClientIP() );

        $poll_answer = $this->PollAnswer->findById($poll_answer_id);
        $poll = $this->Poll->findById( $poll_answer['PollAnswer']['poll_id'] );

        $this->set( compact('poll'));
    }
}
?>