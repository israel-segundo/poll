<?php

class PollHelper extends AppHelper {

    public $helpers = array(
        'Html',
        'Layout',
    );

    public function printCurrentPoll( ){
        echo $this->Layout->View->element('poll', array('plugin'=>'poll', 'poll' => $this->Layout->View->viewVars['poll'] ) );
    }

    public function showCurrentPollResults(){
        echo $this->Layout->View->element('show_results', array('plugin'=>'poll', 'poll' => $this->Layout->View->viewVars['poll'] ) );
    }
}
?>