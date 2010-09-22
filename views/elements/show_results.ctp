<?php
    echo $this->Html->css('/poll/css/poll_module', false);
?>
<div class="poll-results">

    <div class="poll-question">
        <?php echo $poll['Poll']['question']; ?>
    </div>
    
    <div class="poll-answers">
        <?php
            foreach( $poll['PollAnswer'] as $answer ){
                echo '<div class="result-answer-module">';
                    echo '<div class="result-answer">';
                    echo $answer['answer'];
                    echo '</div>';

                    echo '<div class="result-answer-percentage">';
                    echo round(100*$answer['total_votes'] / $poll['Poll']['total_votes']).'%';
                    echo '</div>';
                    
                    echo '<div style="width:'.round(250*$answer['total_votes'] / $poll['Poll']['total_votes']).'px;background-color:#000000;height:10px;">';
                    echo '</div>';
                    
                echo '</div>';
            }
        ?>
    </div>    
</div>
