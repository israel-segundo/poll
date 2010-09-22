<?php    
    echo $html->css('/poll/css/poll', false);
    echo $html->script('/poll/js/jquery-validate/jquery.validate', false);
    echo $html->script('/poll/js/questions_script', false);
?>
<div class="users form">

    <h2><?php echo $title_for_layout; ?></h2>

    <?php echo $form->create(null, array('url' => array('plugin' => 'poll','controller' => 'polls', 'action' => 'admin_add_store'))); ?>

        <?php
            echo $form->input('Poll.question', array(
				'label' => __('Question',true),
                                'type'  => 'textarea',
                                'class' => 'required'
			));

            echo $form->input('Poll.expiration');

            echo $form->input('Poll.active', array(
                    'label' => 'Active',
                    'type'  => 'checkbox'
            ));
            ?>
            <br/>
            <h3>Answers</h3>

            <?php
                echo $html->link('Add answer', '/', array('id'=>'add_answer', 'div' => false));
            ?>

            <ol id="answers-list">

                <li class="answer-element">
                    <?php
                        echo $form->input('PollNewAnswers.0.answer',array(
                                            'type'  => 'text',
                                            'div' => false,
                                            'label'=>false,
                                            'class' => 'required',
                                            'size'  => 40));
                    ?>
                    <?php
                        echo $html->link('Eliminar', '/', array('class'=>'delete_button', 'div' => false));
                    ?>
                </li>

                <li class="answer-element">
                    <?php
                        echo $form->input('PollNewAnswers.1.answer',array(
                                            'type'  => 'text',
                                            'div' => false,
                                            'label'=>false,
                                            'class' => 'required',
                                            'size'  => 40));
                    ?>
                    <?php
                        echo $html->link('Eliminar', '/', array('class'=>'delete_button', 'div' => false));
                    ?>
                </li>
            </ol>

    <?php echo $form->submit('Enviar');?>
    <?php echo $form->end();?>
    
</div>
