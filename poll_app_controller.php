<?php
class PollAppController extends AppController {

    function redirect_with_message( $url, $message ){
        $this->Session->setFlash($message);
        $this->redirect( $url );
    }
}
?>