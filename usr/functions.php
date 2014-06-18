<?php

function cutstr_html($string,$length=0,$ellipsis='…'){
	$string=strip_tags($string);
	$string=preg_replace('/\n/is','',$string);
	$string=preg_replace('/ |　/is','',$string);
	$string=preg_replace('/&nbsp;/is','',$string);
	preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/",$string,$string);
	if(is_array($string)&&!empty($string[0])){
		if(is_numeric($length)&&$length){
			$string=join('',array_slice($string[0],0,$length)).$ellipsis;
		}else{
			$string=implode('',$string[0]);
		}
	}else{
		$string='';
	}
	return $string;
}

//function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
//    $url = 'http://www.gravatar.com/avatar/';
//    $url .= md5( strtolower( trim( $email ) ) );
//    $url .= "?s=$s&d=$d&r=$r";
//    if ( $img ) {
//        $url = '<img src="' . $url . '"';
//        foreach ( $atts as $key => $val )
//            $url .= ' ' . $key . '="' . $val . '"';
//        $url .= ' />';
//    }
//    return $url;
//}

 function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts ='') {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$e = ROOT_PATH . '/usr/avatar/'.md5( strtolower( trim( $email ) ) ).'.jpg';
        $i='http://'.$_SERVER['HTTP_HOST'].'/yyxblog/usr/avatar/'.md5( strtolower( trim( $email ) ) ).'.jpg';
	$t = 1209600; 
	$url .= "?s=$s&d=$d&r=$r";
	if ( !is_file($e) || (time() - filemtime($e)) > $t ){//当头像不存在或文件超过14天才更新
		copy($url , $e);//拷贝到本地，一般主机都支持这个函数
	}
	$url=$i;
	if ( $img ) {
		$url = '<img src="' . $url . '" alt="'.$atts.'" width="50"/>';
	}
	return $url;
}
//return get_gravatar($row['mail'],'80','wavatar','g',false);

?>