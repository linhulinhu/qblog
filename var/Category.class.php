<?php

require_once 'DBAccess.class.php';
/**
 *
 * @author YanYuXing URL:yanyuxing.cn QQ:43368896
 * @name  分类
 * @version 1.0, 14/5/11
 *
 */

class Category {

    public $mid; //分类ID
    public $name; //分类名称
    public $slug;  //分类别名
    public $type;  //分类或者标签
    public $description; //分类描述
    public $count; //分类统计

    public function add_category() {

        if (empty($this->name)) {
            return false;
        }
        $db = new DBAccess("yyx_metas", "mid");
        $data = array(
            "mid" => NULL,
            "name" => $this->name,
            "slug" => $this->slug,
            "type" => $this->type,
            "description" => $this->description,
            "count" => $this->count
        );
        $category_id = $db->Add($data);
        return $category_id;
    }

    /*
     * @获取分类列表
     */

    public function get_cat_list() {

//        if (empty($this->name)) {
//            return false;
//        }
        $db = new DBAccess("yyx_metas", "type");
        return $db->GetCat("category");
    }
    /**
     * 获取标签列表
     * @return type
     */
        public function get_tag_list() {

//        if (empty($this->name)) {
//            return false;
//        }
        $db = new DBAccess("yyx_metas", "type");
        return $db->GetCat("tag");
    }

    /*
     * @更新分类列表信息
     */

    public function update($mid) {

        if (empty($this->name)) {
            return false;
        }
        $db = new DBAccess("yyx_metas", "mid");
        $data = array(
            "mid" => NULL,
            "name" => $this->name,
            "slug" => $this->slug,
            "type" => $this->type,
            "description" => $this->description
        );
        $category_id = $db = new Update($data);
        return $category_id;
    }

    /*
     * @删除分类
     */

    public function delete($cid) {

        if (empty($this->name)) {
            return false;
        }
        $db = new DBAccess("yyx_metas", "mid");
        return $db->Delete($mid);
    }

    /*
     * @查询分类
     */

    public function get_details($cid) {

        if (empty($this->cname)) {
            return false;
        }
        $db = new DBAccess("yyx_metas", "mid");
        return $db->GetDetails($mid);
    }

}

?>