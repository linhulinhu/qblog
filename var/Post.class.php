<?php

require_once 'DBAccess.class.php';

/**
 *
 * @author YanYuXing URL:yanyuxing.cn QQ:43368896
 * @name  日志类
 * @version 1.0, 14/5/11
 *
 */
class Post {

    public $pid; //pid
    public $title; //标题
    public $slug;  //别名
    public $status; //发布
    public $content; //内容
    public $posttime; //发表时间
    public $lasttime; //最后修改时间
    public $ip; //记录ip
    public $clicknum; //点击数
    public $authorid;  //作者ID
    public $post; //安全检查

    /*
     * @添加内容
     */

    public function add_posts() {

        if (empty($this->title) && empty($this->content)) {
            return FALSE;
        }
        $db = new DBAccess("yyx_posts", "pid");
        $data = array(
            "pid" => null,
            "title" => $this->title,
            "slug" => $this->slug,
            "status" => $this->status,
            "content" => $this->content,
            "posttime" => date("Y-m-d h:i:s"),
            "lasttime" => date("Y-m-d h:i:s"),
            "ip" => $_SERVER['REMOTE_ADDR'],
            "clicknum" => $this->clicknum,
            "authorid" => $this->authorid
        );
     //   echo "<pre>";
      //  print_r($data);
      //  echo "</pre>";
        //print_r($_SERVER);
        $id = $db->Add($data);
        return $id;
    }

    /*
     * @更新内容
     */

    public function update_posts($pid) {

        if (empty($this->title) && empty($this->content)) {
            return FALSE;
        }
        $data = array(
            "pid" => $this->pid,
            "title" => $this->title,
            "slug" => $this->slug,
            "status" => $this->status,
            "content" => $this->content,
            "lasttime" => date("Y-m-d h:i:s")
        );
        $db = new DBAccess("yyx_posts", "pid");
        //print_r($data);
        $result = $db->Update($data);
        return $result;
    }

    /**
     *
     * @param type $categoryid
     * @param type $page
     * @param type $keyword
     * @return type 后台列表
     */
    public function GetList($categoryid, $page = 0, $keyword = null) {
        $db = new DBAccess("yyx_posts", "pid");
        return $db->GetList("where cid=" . $categoryid);
    }

  
    /**
     *
     * @param type $id
     * @return type 前台列表
     */
    public function ShowList($categoryid) {
        $db = new DBAccess("yyx_posts", "pid");
        return $db->GetList("where cid=" . $categoryid);
    }

    public function ShowPageList($categoryid, $pageSize = 3, $pageIndex = 1) {
        $db = new DBAccess("yyx_posts", "pid");
        $totalNumber = count($db->GetList("where cid=" . $categoryid));
        $startIndex = ($pageIndex - 1) * $pageSize;
        return $db->GetList("where cid=" . $categoryid . " LIMIT $startIndex,$pageSize");
    }
    /**
     * 
     * @param type $categoryid
     * @param type $pageSize
     * @param type $pageIndex
     * @return type 获取全部日志
     */
    
        public function ShowPageListAll($pageSize = 3, $pageIndex = 1) {
        $db = new DBAccess("yyx_posts", "pid");
        $totalNumber = count($db->GetList());
        $startIndex = ($pageIndex - 1) * $pageSize;
        return $db->GetList(" order by pid desc LIMIT $startIndex,$pageSize");
    }
    /**
     * 日志总数统计
     * @return type
     */
    public function ShowLogtotalNumber(){
        $db = new DBAccess("yyx_posts", "pid");
        $totalNumber = count($db->GetList());
        return $totalNumber;
    }

    /**
     * 
     * @param type $pid
     * @param type $type
     * @return type显示pid下的分类名字
     */
    public function ShowPostIdCat($pid, $type){
        $db = new DBAccess("yyx_posts", "pid");
        return $db->GetPostIdCat($pid, $type);
    }
    /**
     * 获取分类下的内容
     * @return type
     */
    public function ShowCatPost($mid,$pageSize = 3, $pageIndex = 1){
        //过滤分类提交ID
           if (empty($mid) || !is_numeric($mid)) {
             return false;
           // echo '非法字符';
        }
        $db = new DBAccess("yyx_posts", "pid");
        $totalNumber = count($db->GetPostCidList($mid));
        $startIndex = ($pageIndex - 1) * $pageSize;
        return $db->GetPostCidList($mid," LIMIT $startIndex,$pageSize");
    }
   /**
    * 按数量显示最新日志
    * @param type $num
    * @return type
    */
    public function ShowPostNum($num){
        $db = new DBAccess("yyx_posts", "pid");
        //$totalNumber = count($db->GetList());
        return $db->GetList(" order by pid desc LIMIT $num");
    }

    /**
     * 取得详情
     * @param <type> $id
     */
    public function GetDetails($id) {
        if (empty($id) || !is_numeric($id)) {
            return false;
        }

        $db = new DBAccess("yyx_posts", "pid");
        return $db->GetDetails($id);
    }

    /**
     * 删除日志
     * @param <type> $id
     */
    public function Delete($id) {
        if (empty($id) || !is_numeric($id)) {
            return false;
        }

        $db = new DBAccess("yyx_posts", "pid");
        return $db->Delete($id);
    }

    /*
      函数名称：post_check()
      函数作用：对提交的编辑内容进行处理
      参    数：$post: 要提交的内容
      返 回 值：$post: 返回过滤后的内容
     * 
     */

    public function post_check($post) {
        if (!get_magic_quotes_gpc()) {    // 判断magic_quotes_gpc是否为打开
            $post = addslashes($post);    // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤
        }
        //$post = str_replace("_", "\_", $post);    // 把 '_'过滤掉
        $post = str_replace("%", "\%", $post);    // 把' % '过滤掉
        $post = str_replace("\'", "\'", $post);     //把‘‘’过滤掉
        $post = str_replace("", "\"", $post);     //把‘“’过滤掉
        $post = str_replace(",", "，", $post);     //把‘“’过滤掉
        $post = nl2br($post);    // 回车转换
        //  $post = htmlspecialchars($post);    // html标记转换
        return $post;
    }

}

?>