<?php

require_once 'DBAccess.class.php';
/**
 *
 * @author YanYuXing URL:yanyuxing.cn QQ:43368896
 * @name  用户留言类
 * @version 1.0, 14/5/11
 *
 */
class Comment {

    public $coid; //id
    public $pid; //
    public $time; //时间
    public $user;
    public $mail;
    public $url;
    public $content; //内容
    public $ip;
    public $agent;
    public $post; //安全检查

    /*
     * @添加留言内容
     */

    public function AddCom() {

        if (empty($this->pid) || empty($this->user) || empty($this->mail) || empty($this->content)) {
            return FALSE;
        }
        $db = new DBAccess("yyx_comments", "coid");
        $data = array(
            "coid" => null,
            "pid" => $this->pid,
            "time" => date("Y-m-d h:i:s"),
            "user" => $this->user,
            "mail" => $this->mail,
            "url" => $this->url,
            "content" => $this->content,
            "ip" => $_SERVER['REMOTE_ADDR'],
            "agent" => $this->post_check($_SERVER['HTTP_USER_AGENT'])
        );
        $id = $db->Add($data);
        return $id;
    }

    /*
     * @更新留言
     */

    public function UpdateBook($coid) {

        if (empty($this->user) && empty($this->content)) {
            return FALSE;
        }
        $data = array(
            "coid" => null,
            "pid" => $this->pid,
            "time" => date("Y-m-d h:i:s"),
            "user" => $this->user,
            "mail" => $this->mail,
            "url" => $this->url,
            "content" => $this->content,
        );
        $db = new DBAccess("yyx_comments", "coid");
        $result = $db->Update($data);
        return $result;
    }
  /**
   * 显示单篇日志评论
   * @return type
   */
    public function ShowPostIdComments($pid){
        $db = new DBAccess("yyx_comments", "coid");
        return $db->GetCommentsList($pid);
    }

    /**
     *
     * @return type 留言列表
     */
    public function ShowBookList() {
        $db = new DBAccess("yyx_comments", "coid");
        return $db->GetList();
    }
    /**
     * 统计留言数
     * @return type
     */
        public function ShowCommentstotalNumber(){
        $db = new DBAccess("yyx_comments", "coid");
        $totalNumber = count($db->GetList());
        return $totalNumber;
    }
    /**
     * 显示几条评论信息
     * @param type $num
     * @return type
     */
        public function ShowCommentsNum($num){
        $db = new DBAccess("yyx_comments", "coid");
        return $db->GetList(" order by coid desc LIMIT $num");
    }
    /**
     *
     * @param type $id
     * @return type 留言详细信息
     */
    public function GetBookDetails($coid) {
        if (empty($coid) || !is_numeric($coid)) {
            return false;
        }

        $db = new DBAccess("yyx_comments", "coid");
        return $db->GetDetails($coid);
    }

    /**
     *
     * @param type $id
     * @return type 删除留言
     */
    public function DeleteBook($coid) {
        if (empty($coid) || !is_numeric($coid)) {
            return false;
        }
        $db = new DBAccess("yyx_comments", "coid");
        return $db->Delete($coid);
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