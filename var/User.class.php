<?php

require_once 'DBAccess.class.php';
/**
 *
 * @author YanYuXing URL:yanyuxing.cn QQ:43368896
 * @name  管理员类
 * @version 1.0, 14/5/11
 *
 */
class User {

    public $uid; //用户ID
    public $username; //用户名
    public $nikename; //昵称
    public $userpass; //密码
    public $new_pass;
    public $mail; //用户邮箱
    public $url;
    public $registertime;
    public $updatetime;
    public $ip; //记录ip
    public $group;

    public function register() {
        if (empty($this->username) || empty($this->userpass) || empty($this->mail)) {
            return FALSE;
        }
        $db = new DBAccess("yyx_users", "uid");
        $data = array(
            "uid" => null,
            "username" => $this->username,
            "nikename" => $this->nikename,
            "userpass" => $this->userpass,
            "mail" => $this->mail,
            "url" => $this->url,
            "registertime" => date("Y-m-d h:i:s"),
            "updatetime" => date("Y-m-d h:i:s"),
            "ip" => $_SERVER['REMOTE_ADDR']
        );
        $userid = $db->Add($data);
        //print_r($re);
        return $userid;
    }

    /**
     *
     * 登录
     */
    public function login() {
        if (empty($this->username) || empty($this->userpass)) {
            return FALSE;
        }
        $db = new DBAccess("yyx_users", "uid");
        $result = $db->GetFieldValues("username", $this->username, array("userpass", "uid"));
        if ($result == null) {//username不存在
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('你好，该用户不存在!');";
            echo "window.location.href='login.php'";
            echo "</script>";
        } elseif ($result['userpass'] !== $this->userpass) {

            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('你好，你输入的密码不正确！');";
            echo "window.location.href='login.php'";
            echo "</script>";
        }
        if ($result['userpass'] === $this->userpass) {
            return $result['uid'];
        } else {
            return false;
        }
    }

    /**
     *
     * @param type $old_pass
     * @param type $new_pass
     * @return type 更新用户信息
     */
    public function chang_pass() {

        $db = new DBAccess("yyx_users", "uid");
        $result = $db->GetFieldValues("uid", $this->uid, array("userpass", "uid"));
        //print_r($result);
        //print_r( $db ) ; 
        //$old_pass,$new_pass

        if ($result == null) {//username不存在
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('你好，请输入原密码！’)";
            echo "window.location.href='admin_update_info.php?user_id={$result['uid']}'";
            echo "</script>";
        } elseif ($result['userpass'] !== $this->old_pass) {
            //print_r("$this->new_pass");
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('你好，你输入的原密码不正确！');";
            echo "window.location.href='admin_update_info.php?user_id={$result['uid']}'";
            echo "</script>";
        }
        elseif ($this->new_pass_c == null) {
            echo "<script language='javascript' type='text/javascript'>";
            echo "alert('你好，新密码不能为空！');";
            echo "window.location.href='admin_update_info.php?user_id={$result['uid']}'";
            echo "</script>";
        }
        else {

            //echo "old pass from db : " . $result['userpass'];
            //echo "old pass : " . $old_pass;
            $data = array(
                "uid" => $this->uid,
                "nikename"=>  $this->nikename,
                "userpass" => $this->new_pass,
                "mail" => $this->mail,
                "url"=>  $this->url
            );
            //print_r($data);
            $result = $db->Update($data);
            return $result;
        }
    }

    /**
     *
     * @param type $user_id
     * @return type 删除用户
     */
//    public function delete($user_id) {
//        if (empty($userid) || !is_numeric($userid)) {
//            return false;
//        }
//
//        $db = new DBAccess("user", "userid");
//        return $db->Delete($userid);
//    }

    /*
     * 查看用户列表
     */

    public function GetList($uid) {
        $db = new DBAccess("yyx_users", "uid");
        return $db->GetList("where uid");
    }
 
    /**
     *
     * @param type $userid
     * @return type 取得用户详情
     */
    public function GetDetails($uid) {
        if (empty($uid) || !is_numeric($uid)) {
            return false;
        }

        $db = new DBAccess("yyx_users", "uid");
        return $db->GetDetails($uid);
    }
    /**
     * 用户名检测
     * @param type $fieldValue
     * @return boolean
     */
    public function CUser($fieldValue){
          if (empty($fieldValue)) {
            return false;
        }
         $db = new DBAccess("yyx_users", "username");
        return $db->CheakUser("uid", $fieldValue);
    }

}

?>