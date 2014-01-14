<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author Administrator
 */
class admin extends Basic {

    function admin($id=null) {
        $this->child_name = strtolower(__CLASS__);
        $this->dbname = '008v2';
        parent::__constructor($this->child_name);
        if ($id) {
            $obj['id'] = $id;
            $this->initialize($obj);
        }
    }

}

?>
