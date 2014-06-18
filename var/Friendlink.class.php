<?php
/**
 *
 * @author YanYuXing URL:yanyuxing.cn QQ:43368896
 * @name  友情链接类
 * @version 1.0, 14/5/11
 *
 */
class Friendlink {

    public $lid;
    public $lname;
    public $lurl;
	public $description;
    /**public $linkimg;**/

    /**
     *
     * @return type 
     * 添加友情链接
     */
    public function AddUrl() {
        if (empty($this->lname) && empty($this->lurl)) {
            return FALSE;
        }
        $db = new DBAccess("yyx_links", "lid");
        $data = array(
            "lid" => NULL,
            "lname" => $this->lname,
            "lurl" => $this->lurl,
			"description"=> $this->description
        );
        $result = $db->Add($data);
        return $result;
    }

    /**
     *
     * @param type $id
     * @return type 更新友情链接
     */
    public function UpdateUrl($lid) {

        if (empty($this->linkname) && empty($this->linkurl)) {
            return FALSE;
        }
        $db = new DBAccess("yyx_links", "lid");
        $data = array(
            "lid" => $lid,
            "lname" => $this->lname,
            "lurl" => $this->lurl,
			"description"=> $this->description
        );
        $result = $db->Update($data);
        return $result;
    }

    /**
     * 显示友情链接
     */
    public function ShowUrl() {
        $db = new DBAccess("yyx_links", "lid");
        return $db->GetList();
    }

    /**
     * 删除链接
     */
    public function DeleteUrl() {
        if (empty($lid) || !is_numeric($lid)) {
            return false;
        }
        $db = new DBAccess("yyx_links", "lid");
        return $db->Delete($lid);
    }

}

?>
