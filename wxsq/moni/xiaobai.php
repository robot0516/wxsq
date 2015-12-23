<?php

/*第一步 微信公众平台登陆*/

/*配置开始*/
header("content-Type: text/html; charset=utf-8");
/*判断get到id没*/
$username=USER; 
$pwd=PASS;
$siurl=UR;//注意com后面不能带有斜线 上传后的地址
/*配置结束*/
$xuanze="SELECT * FROM  `weixin_cookie`";
$chaxun=mysql_query($xuanze) or die(mysql_error());
$array=mysql_fetch_row($chaxun);


//$array=login($username,$pwd);
$cookie=$array[0];
$cookies=$array[1];
$token=$array[2];
//var_dump($cookie);
/*第二步 微信公众平台登陆函数获取
cookie cookies token
以数组方式输出*/
//var_dump($token);
//if($action == 'cj'){
//	if(file_exists("cj.php"))
//	 {
//			 include './cj.php';
//	}
//	 }
function login($username,$pwd,$verify = '',$codecookie = '')
    {
    $ch = curl_init("https://mp.weixin.qq.com/cgi-bin/login");

    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "X-Requested-With: XMLHttpRequest",
        "Referer: https://mp.weixin.qq.com/",
        "Origin: https://mp.weixin.qq.com",
    ));

    $body_parameters = array(
        "username" => $username,
        "pwd" => md5($pwd),
        "imgcode" => "",
        "f" => "json",
    );
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body_parameters));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    $output = curl_exec($ch);

    list($header, $body) = explode("\r\n\r\n", $output);  
    preg_match_all("/set\-cookie:([^\r\n]*)/i", $header, $matches);
    $cookie = $matches[1][0].$matches[1][1].$matches[1][2].$matches[1][3].$matches[1][4];
    $cookie = str_replace(array('Path=/',' ; Secure; HttpOnly','=;'),array('','','=;'), $cookie);
    $cookie = 'Tue, 06 May 2014 08:54:45 GMT;'.$cookie;
    $data = json_decode($body,true);
    $result = explode('token=',$data[redirect_url]);

    $array=array(
        $cookie,
        $output,
        $result[1],
    );

    curl_close($ch);

    return $array;
}

function getimgver($username)
	{
		$rand = time().rand(100,999);
		    $url = "https://mp.weixin.qq.com/cgi-bin/verifycode?username=$username&r=".$rand;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
						        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在

	curl_setopt($ch, CURLOPT_HEADER,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.63 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	$output = curl_exec($ch);
	curl_close($ch);
	list($header, $body) = explode("\r\n\r\n", $output); 
	preg_match_all("/set\-cookie:([^\r\n]*)/i", $header, $matches);
	$cookie = $matches[1][0];
	$cookie = str_replace(array('Path=/',' ; Secure; HttpOnly','=;'),array('','','=;'), $cookie);
	$imgcodeurl = makeimg($body,"code_".$rand);
	
	return $imgcode= array(
			'imgcodeurl' =>$imgcodeurl,
			'cookie' => $cookie
	);

}
function getmessage($token,$cookie,$cookies)
	{    
    $url = "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=20&day=7&token=$token&lang=zh_CN";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
					        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&token=$token&lang=zh_CN&pagesize=10&pageidx=0&type=0&groupid=0");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	$output = curl_exec($ch);
    //var_dump($output);//全部消息
	curl_close($ch);
    $u_msg=substr($output,(strpos($output,"{\"msg_item\":")+14));
    $abc=substr($u_msg,(strpos($u_msg,"{\"msg_item\":[\":")+1));
	//var_dump($u_msg);
	$b=array();
	$i = 0;
    foreach (explode('},{',$u_msg) as $u_msg){
	$u_msg=preg_replace('/["]+/i','',$u_msg);
		foreach (explode(',',$u_msg) as $u_msg){
			list($k,$v)=explode(':',$u_msg);
			$b[$i][$k]=$v;
		}
	$i++;
	}

	return $b;
	}
//var_dump(getmessage($token,$cookie,$cookies));//测试是否成功抓取最新一条消息



/*第四步 微信公众平台获取用户详细信息*/
function sixi($token,$fakeid,$cookie,$cookies)
	{
     $url = "https://mp.weixin.qq.com/cgi-bin/getcontactinfo";
	$post= "token=$token&lang=zh_CN&t=ajax-getcontactinfo&fakeid=$fakeid";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
					        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER,$cookies);  //设置头信息的地方  
    curl_setopt($ch, CURLOPT_HEADER, 0);   
    curl_setopt($ch, CURLOPT_COOKIE, $cookie); 
	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=20&day=7&token=$token&lang=zh_CN");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);	
	$output = curl_exec($ch);
	//var_dump($output);
   	curl_close($ch);
 $deng= preg_replace('/[\{]+/i','',$output);
                $deng= preg_replace('/[\}]+/i','',$deng);
                $deng= preg_replace('/[\[]+/i','',$deng);
                $deng= preg_replace('/[\]]+/i','',$deng);
                $aaa=preg_replace('/["]+/i','',$deng);
                $aaaq=str_replace(',','&',$aaa);
                $aaaq =str_replace(':','=',$aaaq);
                $aaaq="?$aaaq";
                $ab=trim($aaaq);
                $bb=str_replace(" ","",$ab);
                $bb=str_replace("\r\n","",$bb);
                $bb=str_replace("\n","",$bb); 
  
	return $bb;
	}


	/*第五步 微信公众平台获取用户头像*/
function gethead($token,$fakeid,$cookie)
	{  
      
      
		$url = "http://mp.weixin.qq.com/misc/getheadimg?token=".$token."&fakeid=".$fakeid;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
						        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER,$cookies);  //设置头信息的地方  
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
		curl_setopt($ch, CURLOPT_REFERER, "http://mp.weixin.qq.com/cgi-bin/getmessage?t=wxm-message&token=".$token."&lang=zh_CN&count=50");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
		$output = curl_exec($ch);
      curl_close($ch);
	  //var_dump($output);
      $img=$output;
      return $img;//storge中的头像地址
	}
//var_dump(gethead($token,"135825155",$cookie));	
	/*第六步 微信公众平台获取用户图片*/
function getimages($token,$messageid,$cookie)
	{  
      
		$url = "https://mp.weixin.qq.com/cgi-bin/getimgdata?token=$token&msgid=$messageid&mode=large&source=&fileId=0";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
						        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
		curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=20&day=7&token=".$token."&lang=zh_CN");
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
		$output = curl_exec($ch);
      curl_close($ch);
      $images=$output;
       return $images;
	}
//var_dump(getimages($token,$messageid,$cookie));	
/*新增时间戳*/
function datetime($token,$cookie,$cookies)
	{    
    $url = "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&count=20&day=7&token=$token&lang=zh_CN";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
					        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);    
	curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/cgi-bin/contactmanage?t=user/index&token=$token&lang=zh_CN&pagesize=10&pageidx=0&type=0&groupid=0");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1521.3 Safari/537.36");
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
	$output = curl_exec($ch);
      // var_dump($output);//全部消息
	curl_close($ch);
    $u_msg=substr($output,(strpos($output,"{\"msg_item\":")+13));
    $abc=substr($u_msg,(strpos($u_msg,"{\"msg_item\":[\":")+1));
    $u=stripos($abc,"}");
    $aaaa=substr($abc,0,$u);
      // var_dump($aaaa);
      $u_m=str_replace(',','&',$aaaa);
      $u_m=str_replace("\"","",$u_m);
      $u_m=str_replace(":","=",$u_m);
$u_m="?$u_m";
      //$u_m=substr($u_m,(strpos($u_m,"?")+1));
      parse_str($u_m); 
      //var_dump(1);
      $date=$date_time;
      return $date;
    }

//var_dump(datetime($token,$cookie,$cookies));

function makeimg($img,$name){
         /*以下为获取头像*/
      //exit('a');
      //exit(dirname(dirname(__FILE__)).'/head/'.$name);
      $filename ="{$name}.jpg";//要生成的图片名字
      $jpg = $img;//得到post过来的二进制原始数据
      //以下为sae的sotrage
      $domain = '/head/';
      /*$filename = $filename;
      $file_contents = $jpg;
      $s = new SaeStorage();
      $s->write($domain, $filename ,$file_contents);
      $imgurl=$s->getUrl($domain, $filename );*/
      $filename=dirname(dirname(__FILE__)).$domain."{$name}.jpg";
      
      $fp=fopen($filename,"w");
      if($fp)
      {
         fwrite($fp,$jpg);
         fclose($fp);
      }
      $imgurl=$domain."{$name}.jpg";
      //exit($imgurl);
      /*获取结束*/
      return $imgurl;
   }

?>