<!-- File: /app/Model/User.php -->

<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    public $belongsTo = array(
        "Group" => array(
            "foreignKey" => "groups_id"
        )
    );

    public $actsAs = array('Acl' => array('type' => 'requester', 'enabled' => false));

    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data['User']['password'] = $passwordHasher->hash(
                $this->data['User']['password']
            );
        }
        return true;
    }

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data["User"]["groups_id"])) {
            $groups_id = $this->data["User"]["groups_id"];
        } else {
            $groups_id = $this->field("groups_id");
        }
        if (!$groups_id) {
            return null;
        } else {
            return array('Group' => $groups_id);
        }
    }

    public function bindNode($user) {
        return array('model' => "Group", "foreign_key" => $user["User"]["groups_id"]);
    }
}
?>
