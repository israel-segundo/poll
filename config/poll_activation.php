<?php

class PollActivation {

    public function beforeActivation(&$controller) {
        return true;
    }

    public function onActivation(&$controller) {
        
       	$controller->Croogo->addAco('Polls');
        $controller->Croogo->addAco('Polls/admin_index');
        $controller->Croogo->addAco('Polls/admin_edit');
        $controller->Croogo->addAco('Polls/admin_add_store');
        $controller->Croogo->addAco('Polls/vote', array('registered','public'));
        $controller->Croogo->addAco('Polls/index',array('registered','public'));
        $this->createBlock($controller);
        $this->createDatabaseSchemas($controller);
    }

    public function beforeDeactivation(&$controller) {
        return true;
    }

    public function onDeactivation(&$controller) {
        $controller->Croogo->removeAco('Polls');
        $this->removeBlock($controller);
    }

    public function createDatabaseSchemas(&$controller){

        App::Import('CakeSchema');
        $CakeSchema = new CakeSchema();
        $db =& ConnectionManager::getDataSource('default');

        $schema_files = array(
            'polls.php',
            'poll_answers.php',
            'poll_votes.php'
        );
        
        foreach($schema_files as $schema_file) {
        	$class_name = Inflector::camelize(substr($schema_file, 0, -4)).'Schema';
        	$table_name = substr($schema_file, 0, -4);

        	if(!in_array($table_name, $db->_sources)) {
	        	include_once(APP.'plugins'.DS.'poll'.DS.'config'.DS.'schema'.DS.$schema_file);
	        	$ActivateSchema = new $class_name;
	        	$created = false;
				if(isset($ActivateSchema->tables[$table_name])) {
					$db->execute($db->createSchema($ActivateSchema, $table_name));
				}
			}
        }
    }
    public function createBlock(&$controller){

        $controller->loadModel('Block');
        $controller->Block->create();
        $controller->Block->set(array(
            'visibility_roles' => $controller->Node->encodeData(array("1","2","3","4","5","6")),
            'visibility_paths' => '',
            'region_id'        => 4, // Right
            'title'            => 'Poll',
            'alias'            => 'poll_plugin',
            'body'             => '[element:poll plugin="poll"]',
            'show_title'       => 1,
            'status'           => 1
        ));
        $controller->Block->save();
    }

    public function removeBlock(&$controller){

        $controller->loadModel('Block');
        $block = $controller->Block->find('first', array('conditions'=>array('Block.alias'=>'poll_plugin')));

        if( $block ){
            $controller->Block->delete($block['Block']['id']);
        }

    }
}
?>