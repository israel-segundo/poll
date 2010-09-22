<?php

class Poll extends PollAppModel {

    var $name = 'Poll';
    var $useTable = 'polls';

    var $hasMany = array(
        'PollAnswer' => array(
            'className'     => 'Poll.PollAnswer',
            'foreignKey'    => 'poll_id',
            'order'         => 'PollAnswer.created DESC',
            'dependent'     => true
        )
    );
    
    public function  save($data = null, $validate = true, $fieldList = array()) {

        $created = parent::save($data, $validate, $fieldList);

        if( ! $created ){
            return false;
        }

        if( isset( $data['PollAnswers'] ) ){
            
            $answers_to_be_deleted = $this->getListOfAnswerIds();

            
            foreach( $data['PollAnswers'] as $poll_answer_id => $poll_answer ){

                $poll_exists = $this->PollAnswer->findById( $poll_answer_id );

                if( $poll_exists ){
                    
                    $this->PollAnswer->id = $poll_answer_id;
                    $this->PollAnswer->set(array(
                        'poll_id' => $this->id,
                        'answer'  => $poll_answer['answer']
                    ));
                    $this->PollAnswer->save();

                    unset( $answers_to_be_deleted[$poll_answer_id] );
                }

            }

            // Delete answers
            foreach( $answers_to_be_deleted as $answer){
                $this->PollAnswer->delete($answer);
            }

            
        }
        
        // Agregar preguntas
        if( isset( $data['PollNewAnswers'] ) ){

            foreach( $data['PollNewAnswers'] as $new_answer ){

                $this->PollAnswer->create();

                $this->PollAnswer->set(array(
                    'poll_id' => $this->id,
                    'answer'  => $new_answer['answer']
                ));

                $this->PollAnswer->save();
            }
        }

        return true;
    }

    public function delete($id = null, $cascade = true) {
        parent::delete($id, $cascade);

        $this->PollAnswer->deleteAll( array( 'PollAnswer.poll_id' => $id ) );
        
        return true;
    }

    public function getListOfAnswerIds( $poll_id=null ){

        $poll_id = ( $poll_id != null) ? $poll_id : $this->id;
        
        $actualPolls = $this->PollAnswer->find('list', 
                        array(  'fields'=> array('PollAnswer.id'),
                                'conditions' => array('PollAnswer.poll_id' => $poll_id)));

        return $actualPolls;
    }


    public function get_total_votes( $poll_id ){

        $total_votes = 0;
        $answer_ids = $this->getListOfAnswerIds($poll_id);

        foreach( $answer_ids as $answer_id){
            $total_votes += $this->PollAnswer->get_total_votes( $answer_id );
        }
        return $total_votes;
    }

    public function ip_has_voted( $poll_id, $ip){
        
        $answer_ids = $this->getListOfAnswerIds($poll_id);

        foreach( $answer_ids as $answer_id){

            if( $this->PollAnswer->voteExists( $answer_id, $ip ) ){
                return true;
            }
        }
        return false;
    }

    public function  afterFind($results, $primary = false) {
        parent::afterFind($results, $primary);


        foreach( $results as &$result ){

            $result['Poll']['total_votes'] = $this->get_total_votes( $result['Poll']['id'] );

            foreach( $result['PollAnswer'] as &$answer){
                $answer['total_votes'] = $this->PollAnswer->get_total_votes( $answer['id'] );
            }

        }

        return $results;
    }
}
?>