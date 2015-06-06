<!-- File: /app/Model/Group.php -->

<?php

    App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

    class Group extends AppModel {
        public $actsAs = array('Acl' => array('type' => 'requester'));
       
        public $validate = array(
            'descripcion' => array(
                'required' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'A groupname is required'
                )
            )
        );
        
        public function parentNode() {
            return null;
        }
    }
?>
