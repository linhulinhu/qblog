<?php
/**
 *
 * @author YanYuXing URL:yanyuxing.cn QQ:43368896
 * @name  数据库访问类
 * @version 1.0, 14/5/11
 *
 */
class DBAccess {

    private $link;
    private $tableName;
    private $primaryKeyName;
    private $pageSize;
    public $id;

 /**
  *
  * @param type $tableName
  * @param type $primaryKeyName
  * @param type $pageSize 
  * 初始化
  */
    public function __construct($tableName, $primaryKeyName, $pageSize=10) {

        $this->link = $this->OpenDb();
        $this->tableName = $tableName;
        $this->primaryKeyName = $primaryKeyName;
        $this->pageSize = $pageSize;
    }

    /**
     * 断开连接
     */
    public function __destruct() {

        if (!empty($this->link)) {
            $this->CloseDb($this->link);
        }
    }

/**
 *
 * @param type $data
 * @return type 
 * 添加一条记录
 */
    public function Add($data) {
        $fields = array_keys($data);
        $fields = implode(',', $fields);
        $values = array_values($data);
        $values = implode(',', $values);
        $values = "'" . str_replace(',', "','", $values) . "'";
        $query = "insert into `{$this->tableName}` ({$fields}) values ({$values})";
        mysql_query($query, $this->link) or die("SQL语句执行失败:" . mysql_error() . "<br>$query"); //数据库执行
        return mysql_insert_id();
    }

/**
 *
 * @param type $data
 * @return type 
 * 更新记录
 */
    public function Update($data) {
        if (empty($data[$this->primaryKeyName])) {
            return FALSE;
        }
        $setstr = '';

        foreach ($data as $key => $value) {
            if ($key === $this->primaryKeyName) {
                continue;
            }

            $setstr.="$key='" . $value . "',";
        }
        $setstr = substr($setstr, 0, strlen($setstr) - 1);
        $query = "UPDATE {$this->tableName} SET {$setstr} WHERE {$this->primaryKeyName}='{$data[$this->primaryKeyName]}'";
        mysql_query($query);
        return true;
    }

    /**
     * 取得所有记录或者是按分页的大小取出记录
     * @param int $pageStart 第x页起点
     * @return array 一个二维数组，其中一维存储n条记录；第二维存储单条记录的信息
     */
    public function GetList($where=null, $pageStart=0) {
        if (empty($pageStart)) {
            // 取出所有记录
            $query = "SELECT * FROM {$this->tableName}";
        } else {
            if (!is_numeric($pageStart) || $pageStart < 1) {
                return null;
            } else {
                // 按页码取得相应的记录
                $query = "SELECT * FROM {$this->tableName} LIMIT {$pageStart},{$this->pageSize}";
            }
        }
        $query.=" " . $where;
        //echo $query;
        $result = mysql_query($query, $this->link);
        $list = array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $list[] = $row;
        }
        mysql_free_result($result);
        return $list;
    }

    /**
     * 根据主键字段的值，去表中找出那条记录的信息
     * @param int $id 主键字段的值
     * @return array 如果失败返回false；成功返回数组：$data["字段名"]="字段值"
     */
    public function GetDetails($id) {
        if (empty($id) || !is_numeric($id)) {
            return false;
        }
        $query = "SELECT * FROM {$this->tableName} WHERE {$this->primaryKeyName}='{$id}'";
        $result = mysql_query($query);
        //$record = array();
        $record = mysql_fetch_array($result, MYSQL_ASSOC);
        return $record;
    }
    //根据字段获取分类列表
    public function GetCat($KeyName){
        $query = "SELECT * FROM {$this->tableName} WHERE {$this->primaryKeyName}='{$KeyName}'";
        $result = mysql_query($query, $this->link);
        $list = array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $list[] = $row;
        }
        mysql_free_result($result);
        return $list;
    }
    /**
     * 获取评论列表
     * @return type
     */
    public function GetCommentsList($pid){
        $query = "SELECT * FROM {$this->tableName} WHERE pid='{$pid}'";
        $result = mysql_query($query, $this->link);
        $list = array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $list[] = $row;
        }
        mysql_free_result($result);
        return $list;
    }

    /**
     * 
     * @param type $pid
     * @param type $type
     * @return type根据日志PID获取分类名
     */
    public function GetPostIdCat($pid,$type){
        $query = "SELECT * FROM yyx_metas AS m RIGHT JOIN yyx_relationships AS r ON m.mid = r.mid WHERE r.pid =".$pid." AND m.type='$type'";
        $result = mysql_query($query, $this->link);
        $list = array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $list[] = $row;
        }
        mysql_free_result($result);
        return $list;
        
    }
    /**
     * 
     * @param type $cid
     * @return type根据分类mid获取该分类下的日志
     */
    public function GetPostCidList($mid,$where=null,$pageStart=0){
        if (empty($pageStart)) {
            // 取出所有记录
            $query = "SELECT * FROM yyx_metas AS m RIGHT JOIN yyx_relationships AS r ON m.mid = r.mid JOIN yyx_posts AS p ON r.pid = p.pid WHERE r.mid =".$mid;
        } else {
            if (!is_numeric($pageStart) || $pageStart < 1) {
                return null;
            } else {
                // 按页码取得相应的记录
           $query = "SELECT * FROM yyx_metas AS m RIGHT JOIN yyx_relationships AS r ON m.mid = r.mid JOIN yyx_posts AS p ON r.pid = p.pid WHERE r.mid ={$mid} LIMIT {$pageStart},{$this->pageSize}";
            }
        }
        $query.=" " . $where;
        $result = mysql_query($query, $this->link);
        $list = array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $list[] = $row;
        }
        mysql_free_result($result);
        return $list;
    }

    /**
     * 用户登录
     */
    public function UserLogin($userid) {
        if (empty($userid) || !is_numeric($userid)) {
            return false;
        }

        $query = "SELECT * FROM {$this->tableName} WHERE {$this->primaryKeyName}='{$userid}'";
        $result = mysql_query($query);
        $record = mysql_fetch_array($result, MYSQL_ASSOC);
        return $record;
    }

    /**
     * 根据主键字段的值，删除表中的一条记录
     * @param int $id
     * @return bool 如果成功，返回true；否则，返回false
     */
    public function Delete($id) {
        if (empty($id) || !is_numeric($id)) {
            return false;
        }

        $query = "DELETE FROM {$this->tableName} WHERE {$this->primaryKeyName}='{$id}'";
        mysql_query($query);
        return true;
    }

    /**
     * 根据字段名，取得相应字段的值（可能不只一个），
     * @param <type> $fieldName 字段名
     * @param <type> $pKeyValue 主键字段的值
     * @return <type> 一维数组
     */
    public function GetFieldValue($fieldName, $pKeyValue=0) {
        if (empty($filedName)) {
            return null;
        }

        $query = "SELECT {$fieldName} FROM {$this->tableName}";
        if (!empty($pKeyValue) && is_numeric($pKeyValue)) {
            $query = $query . " WHERE {$this->primaryKeyName}=$pKeyValue";
        }
        //echo $query;
        $result = mysql_query($query, $this->link);
        $list = array();
        while ($row = mysql_fetch_array($result)) {
            $list[] = $row[0];
        }
        mysql_free_result($result);

        return $list;
    }

    public function GetFieldValues($fieldName, $fieldValue, $needFields) {
        if (empty($fieldName)) {
            return false;
        }
        $query = "SELECT " . implode(',', $needFields) . " FROM $this->tableName WHERE $fieldName='{$fieldValue}'";
        $result = mysql_query($query);
        $arr = mysql_fetch_assoc($result);
        mysql_free_result($result);
        return $arr;
    }
    /**
     * 检测用户名
     * @param type $fieldName
     * @param type $fieldValue
     */
    public function CheakUser($fieldName, $fieldValue){
        $query = "SELECT {$fieldName} FROM {$this->tableName} WHERE {$this->primaryKeyName}='{$fieldValue}'";
        $res=mysql_query($query);
                if(mysql_num_rows($res)!=0)
                {
             echo "true";
                }else
              {
                 echo "false";
               }
    }

    //建立连接并选择数据库
    private function OpenDb() {

        $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("连接服务器错误：" . mysql_error());
        $db = mysql_select_db(DB_NAME) or die("选择数据库失败:" . mysql_error());
        mysql_query("SET NAMES 'utf8'") or die("设置编码失败:" . mysql_error());
        return $link;
    }

    //关闭数据库连接
    private function CloseDb() {
        mysql_close($this->link); //关闭数据库服务器链接=>关
    }

    /*
      函数名称：inject_check()
      函数作用：检测提交的值是不是含有SQL注射的字符，防止注射，保护服务器安全
      参        数：$sql_str: 提交的变量
      返 回 值：返回检测结果，ture or false
     */

    function Inject_Check($sql_str) {
        return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str);    // 进行过滤
    }

    /*
      函数名称：verify_id()
      函数作用：校验提交的ID类值是否合法
      参        数：$id: 提交的ID值
      返 回 值：返回处理后的ID
     */

    function Verify_Id($id=null) {
        if (!$id) {
            exit('没有提交参数！');
        }    // 是否为空判断
        elseif (Inject_Check($id)) {
            exit('提交的参数非法！');
        }    // 注射判断
        elseif (!is_numeric($id)) {
            exit('提交的参数非法！');
        }    // 数字判断
        $id = intval($id);    // 整型化

        return $id;
    }

}
?>