<?php

    $poll     = $this->Layout->View->viewVars['poll'];
    $hasVoted = $this->Layout->View->viewVars['hasVoted'];
    
    if( $hasVoted){
        echo $this->element('show_results', array('plugin'=>'poll', 'poll' => $poll ) );
    }else{
        echo $this->Html->css('/poll/css/poll_module', false);

?>
    <div id="poll-structure" class="poll-structure">

        <div class="poll-question">
            <?php echo $poll['Poll']['question']; ?>
        </div>

        <div class="poll-answers">

            <?php


                $options    = array();
                $attributes = array( 'separator' => '<br/>', 'id'=>'poll_answer', 'legend'=>false);

                foreach( $poll['PollAnswer'] as $answer ){
                    $options[$answer['id']] = $answer['answer'];
                }

                echo '<div class="poll-options">';
                echo $form->radio('vote', $options, $attributes);
                echo '</div>';

                echo '<div class="poll-vote">';
                echo $html->link('Vote!', '/', array('id'=>'poll_vote_button'));
                echo '</div>';
            ?>

        </div>
    </div>
    <?php
        echo $this->Html->script('/poll/js/poll_box');
    ?>
<?php } ?>