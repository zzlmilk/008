<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of plan_business
 *
 * @author Administrator
 */
class plan_business extends Basic{
        function plan_business($id=null) {
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
