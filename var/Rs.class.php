<?php

require_once 'DBAccess.class.php';
/**
 *
 * @author YanYuXing URL:yanyuxing.cn QQ:43368896
 * @name  关系类
 * @version 1.0, 14/5/11
 *
 */
class Rs {

    public $pid; //POST ID
    public $mid; //分类ID

    public function add_rs() {

        if (empty($this->pid)) {
            return false;
        }
        $db = new DBAccess("yyx_relationships","pid");
        $data = array(
            "pid" => $this->pid,
            "mid" => $this->mid
        );
        $pm = $db->Add($data);
        return $pm;
    }

    /*
     * @更新分类列表信息
     */

    public function update($pid) {

        if (empty($this->pid)) {
            return false;
        }
        $db = new DBAccess("yyx_relationships", "pid");
        $data = array(
            "mid" => $this->pid,
            "name" => $this->mid
        );
        $pm = $db = new Update($data);
        return $pm;
    }

}

?>