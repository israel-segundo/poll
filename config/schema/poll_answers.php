<?php

class PollAnswersSchema extends CakeSchema{

    var $name = 'PollAnswers';

    function before($event = array()) {}
    function after($event = array()) {}

    var $poll_answers = array(
        'id'                => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
        'poll_id'           => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11),
        'answer'            => array('type' => 'string',    'null' => false, 'default' => '','lenght'=>255),
        'displayed'         => array('type' => 'integer',   'null' => false, 'default' => 1, 'length' => 1),
        'created'           => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'updated'           => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'tableParameters'   => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
    );
}

?>