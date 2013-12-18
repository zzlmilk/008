<?php

class listp extends Basic {

    function listp($id=null) {
        $this->child_name = strtolower(__CLASS__);
        $this->dbname = '008v1';
        parent::__constructor($this->child_name);
        if ($id) {
            $obj['id'] = $id;
            $this->initialize($obj);
        }
    }

}

?>