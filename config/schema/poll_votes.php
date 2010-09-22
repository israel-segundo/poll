<?php

class PollVotesSchema extends CakeSchema{

    var $name = 'PollVotes';

    function before($event = array()) {}
    function after($event = array()) {}

    var $poll_votes = array(
        'id'                => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
        'poll_answer_id'    => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11),
        'voter_ip'          => array('type' => 'string',    'null' => false, 'default' => '','lenght'=>255),
        'created'           => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'updated'           => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'tableParameters'   => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
    );
}

?>