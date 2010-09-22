<?php

class PollsSchema extends CakeSchema{

    var $name = 'Polls';

    function before($event = array()) {}
    function after($event = array()) {}

    var $polls = array(
        'id'                => array('type' => 'integer',   'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
        'question'          => array('type' => 'string',    'null' => false, 'default' => '','lenght'=>255),
        'expiration'        => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'active'            => array('type' => 'integer',   'null' => false, 'default' => 0, 'length' => 1),
        'created'           => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'updated'           => array('type' => 'timestamp', 'null' => false, 'length' => NULL),
        'tableParameters'   => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
    );
}

?>