<?php
    echo $html->css('/poll/css/poll', false);
    echo $html->script('/poll/js/jquery-validate/jquery.validate', false);
    echo $html->script('/poll/js/questions_script', false);
?>
<div class="users form">

    <h2><?php echo $title_for_layout; ?></h2>

    <?php echo $form->create(null, array('url' => array('plugin' => 'poll','controller' => 'polls', 'action' => 'admin_add_store'))); ?>

        <?php
            echo $form->input('Poll.id', array(
                                'value' => $poll['Poll']['id'],
                                'type'  => 'hidden'
                        ));

            echo $form->input('Poll.question', array(
				'label' => __('Question',true),
                                'type'  => 'textarea',
                                'class' => 'required',
                                'value' => $poll['Poll']['question']
			));

            echo $form->input('Poll.expiration', array(
                                'value' => $poll['Poll']['expiration']
                        ));

            echo $form->input('Poll.active', array(
                    'label'   => 'Active',
                    'type'    => 'checkbox',
                    'checked' => ($poll['Poll']['active'] == 1 ? true : false)
            ));
            ?>
            <br/>
            <h3>Answers</h3>

            <?php
                echo $html->link('Add answer', '/', array('id'=>'add_answer', 'div' => false));
            ?>

            <ol id="answers-list">

                <?php
                    foreach( $poll['PollAnswer'] as $poll_answer ){
                        echo '<li class="answer-element">';
                        echo $form->input('PollAnswers.'.$poll_answer['id'].'.answer',array(
                                            'type'  => 'text',
                                            'div'   => false,
                                            'label' => false,
                                            'class' => 'required',
                                            'value' => $poll_answer['answer'],
                                            'size'  => 40));
                        echo '&nbsp;';
                        echo $html->link('Eliminar', '/', array('class'=>'delete_button', 'div' => false));
                        echo '</li>';
                    }
                ?>
            </ol>

    <?php echo $form->submit('Enviar');?>
    <?php echo $form->end();?>

</div>
