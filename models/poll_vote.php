<?php

class PollVote extends PollAppModel {

    var $name     = 'PollVote';
    var $useTable = 'poll_votes';

    public function makeVote( $answer_id, $ip ){

        if( ! $this->voteExists($answer_id, $ip) ){

            $this->create();
            $this->set(array(
                'poll_answer_id' => $answer_id,
                'voter_ip'       => $ip
            ));
            $this->save();
        }

    }

    public function voteExists( $answer_id, $ip ){

        $previous_vote_exists = $this->find('first',
                                    array( 'conditions' => array( 'PollVote.poll_answer_id' => $answer_id,
                                                                  'PollVote.voter_ip'       => $ip)));
        return $previous_vote_exists;
    }
}
?>