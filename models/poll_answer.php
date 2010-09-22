<?php

class PollAnswer extends PollAppModel {

    var $name     = 'PollAnswer';
    var $useTable = 'poll_answers';

    var $hasMany = array(
        'PollVote' => array(
            'className'     => 'Poll.PollVote',
            'foreignKey'    => 'poll_answer_id'
        )
    );

    public function voteExists( $answer_id, $ip ){
        return $this->PollVote->voteExists( $answer_id, $ip );
    }

    public function get_total_votes( $answer_id ){
        $answer = $this->findById( $answer_id );
        return count( $answer['PollVote']);
    }
}
?>