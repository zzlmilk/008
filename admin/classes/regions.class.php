<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of regions
 *
 * @author Administrator
 */
class regions extends Basic{
        function regions($id=null) {
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
