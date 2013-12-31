<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of recommend
 *
 * @author Administrator
 */
class recommend extends Basic {

    function recommend($id=null) {
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
