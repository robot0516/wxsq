<?php
/**
 * 微信公众平台 PHP SDK
 *
 * @author NetPuter <netputer@gmail.com>
 */

  /**
   * 微信公众平台处理类
   */
  class Wechat {

    /**
     * 调试模式，将错误通过文本消息回复显示
     *
     * @var boolean
     */
    private $debug;

    /**
     * 以数组的形式保存微信服务器每次发来的请求
     *
     * @var array
     */
    private $request;
    /**
     * 数组配置的文件信息
     *
     * @var array
     */
    protected $xuanzezu;
    protected $weixin_name;
    /**
     * 初始化，判断此次请求是否为验证请求，并以数组形式保存
     *
     * @param string $token 验证信息
     * @param boolean $debug 调试模式，默认为关闭
     */
    public function __construct($token, $debug = FALSE) {
        
        if(!empty($_GET["version"])){
            $ver=new version();
            $ver->verSions();
        }
      if (!$this->validateSignature($token)) {
        exit('签名验证失败');
      }
      
      if ($this->isValid()) {
        // 网址接入验证
        exit($_GET['echostr']);
      }
      
      if (!isset($GLOBALS['HTTP_RAW_POST_DATA'])) {
        exit('缺少数据');
      }
      include ('../config.php');
      $this->xuanzezu =$xuanzezu;
      $this->weixin_name =$weixin_name;
      $this->debug = $debug;
      set_error_handler(array(&$this, 'errorHandler'));
      // 设置错误处理函数，将错误通过文本消息回复显示

      $xml = (array) simplexml_load_string($GLOBALS['HTTP_RAW_POST_DATA'], 'SimpleXMLElement', LIBXML_NOCDATA);
      $this->request = array_change_key_case($xml, CASE_LOWER);
      // 将数组键名转换为小写，提高健壮性，减少因大小写不同而出现的问题
    }

    /**
     * 判断此次请求是否为验证请求
     *
     * @return boolean
     */
    private function isValid() {
      return isset($_GET['echostr']);
    }

    /**
     * 验证此次请求的签名信息
     *
     * @param  string $token 验证信息
     * @return boolean
     */
    private function validateSignature($token) {
      if ( ! (isset($_GET['signature']) && isset($_GET['timestamp']) && isset($_GET['nonce']))) {
        return FALSE;
      }
      
      $signature = $_GET['signature'];
      $timestamp = $_GET['timestamp'];
      $nonce = $_GET['nonce'];

      $signatureArray = array($token, $timestamp, $nonce);
      sort($signatureArray,SORT_STRING);

      return sha1(implode($signatureArray)) == $signature;
    }

    /**
     * 获取本次请求中的参数，不区分大小
     *
     * @param  string $param 参数名，默认为无参
     * @return mixed
     */
    protected function getRequest($param = FALSE) {
      if ($param === FALSE) {
        return $this->request;
      }

      $param = strtolower($param);

      if (isset($this->request[$param])) {
        return $this->request[$param];
      }

      return NULL;
    }

    /**
     * 用户关注时触发，用于子类重写
     *
     * @return void
     */
    protected function onSubscribe() {}

    /**
     * 用户取消关注时触发，用于子类重写
     *
     * @return void
     */
    protected function onUnsubscribe() {}

    /**
     * 收到文本消息时触发，用于子类重写
     *
     * @return void
     */
    protected function onText() {
		
		}

    /**
     * 收到图片消息时触发，用于子类重写
     *
     * @return void
     */
    protected function onImage() {}

    /**
     * 收到地理位置消息时触发，用于子类重写
     *
     * @return void
     */
    protected function onLocation() {}

    /**
     * 收到链接消息时触发，用于子类重写
     *
     * @return void
     */
    protected function onLink() {}

    /**
     * 收到自定义菜单消息时触发，用于子类重写
     *
     * @return void
     */    
    protected function onClick() {}

    /**
     * 收到地理位置事件消息时触发，用于子类重写
     *
     * @return void
     */    
    protected function onEventLocation() {}

    /**
     * 收到语音消息时触发，用于子类重写
     *
     * @return void
     */        
    protected function onVoice() {}

    /**
     * 扫描二维码时触发，用于子类重写
     *
     * @return void
     */        
    protected function onScan() {}

    /**
     * 收到未知类型消息时触发，用于子类重写
     *
     * @return void
     */
    protected function onUnknown() {}
    /**
     * 表情处理
     *
     * @return void
     */
	protected function biaoqing($content){
			if(strstr($content,"/:")){
	$content = str_replace("'", "xb", $content);
			}
			
		return $content;
		}
    /**
     * 回复文本消息
     *
     * @param  string  $content  消息内容
     * @param  integer $funcFlag 默认为0，设为1时星标刚才收到的消息
     * @return void
     */
    protected function responseText($content, $funcFlag = 0) {
      exit(new TextResponse($this->getRequest('fromusername'), $this->getRequest('tousername'), $content, $funcFlag));
    }
    /**
     * 结束的小尾巴函数
     *
     * @return void
     */
    protected function endtail($reply) {
			$q = $this->sqlselect('flag',$this->getRequest('fromusername'));
		$end = new NewsResponseItem($this->xuanzezu[4],'',$q['avatar']);
		 array_push($reply,$end);

			return $reply;
    }
    /**
     * 重置函数
     *
     * @return void
     */
    protected function resetflag($weixin_name,$from) {
			$xieverify = $this->GetRandStr(4);
			 $sql_flag="replace`weixin_flag` (`openid`,`flag`,`vote`,`fakeid`,`verify`) VALUES ('$from','1','0','$from','{$xieverify}')";
			mysql_query($sql_flag);
			$reply = $this->VERYF($weixin_name,$xieverify);
			
			return $reply;
    }
     /**
     * 删除微信墙用户函数
     *
     * @return void
     */
	protected function deleteflag($from) 
	{ 	
		mysql_query("UPDATE  `weixin_flag` SET `flag` = '0'  WHERE  `openid`='$from'");
	} 

	 /**
     * 数据库选择函数
     *
     * @return void
     */
	protected function sqlselect($sql_name,$from,$type = '',$which = '') 
	{ 	
		if($which == ''){$which = 'openid';}
	    $sql_check = "SELECT * FROM `weixin_{$sql_name}` where `{$which}` = '{$from}'";
        $query_check = mysql_query($sql_check);
		if($type == "row"){
			$q = mysql_fetch_row($query_check);
				}else{
			$q = mysql_fetch_array($query_check);
		}
		return $q;
	} 
	 /**
     * 图片上墙的函数
     *
     * @return void
     */
	protected function replaypic($from,$time,$picurl) 
	{ 
			$q = $this->sqlselect('flag',$from);
				if($q['nickname'] != ''){
						$reply = $this->writeinwall($picurl,$time,$q,'pic');
					}else{
						$reply = $this->unkownerror();
						}
		return $reply;
	} 
	 /**
     * 发生未知错误
     *
     * @return void
     */
	protected function unkownerror() 
	{ 
		$reply = array(
			new NewsResponseItem("发生未知错误"),
			new NewsResponseItem('系统没有检测到您的昵称信息，请您发送"重置"重新获取信息。'),
		 );
		return $reply;
	} 
	 /**
     * 生成验证码
     *
     * @return void
     */
	protected function GetRandStr($len) 
	{ 
		$chars = array( 
			"0", "1", "2", "3", "4", "5", "6", "7", "8", "9" 
		); 
		$charsLen = count($chars) - 1; 
		shuffle($chars);   
		$output = ""; 
		for ($i=0; $i<$len; $i++) 
		{ 
			$output .= $chars[mt_rand(0, $charsLen)]; 
		}  
		return $output;  
	} 
    /**
     * 回复音乐消息
     *
     * @param  string  $title       音乐标题
     * @param  string  $description 音乐描述
     * @param  string  $musicUrl    音乐链接
     * @param  string  $hqMusicUrl  高质量音乐链接，Wi-Fi 环境下优先使用
     * @param  integer $funcFlag    默认为0，设为1时星标刚才收到的消息
     * @return void
     */
    protected function responseMusic($title, $description, $musicUrl, $hqMusicUrl, $funcFlag = 0) {
      exit(new MusicResponse($this->getRequest('fromusername'), $this->getRequest('tousername'), $title, $description, $musicUrl, $hqMusicUrl, $funcFlag));
    }

    /**
     * 回复图文消息
     * @param  array   $items    由单条图文消息类型 NewsResponseItem() 组成的数组
     * @param  integer $funcFlag 默认为0，设为1时星标刚才收到的消息
     * @return void
     */
    protected function responseNews($items, $funcFlag = 0) {
      exit(new NewsResponse($this->getRequest('fromusername'), $this->getRequest('tousername'), $items, $funcFlag));
    }
    /**
     * 转发至第三方借口
     * @return void
     */
    protected function sendxml($xmlData,$url,$token){
    		function randStr($len = 10){
    				for($i=0;$i<$len;$i++){
    				 $rand .= mt_rand(0,9);
    				}
    
    				return $rand;
    		}
    			$timestamp = time();
    			$nonce = randStr(10);
    			$signkey = array($token,$timestamp, $nonce);
    			sort($signkey, SORT_STRING);
    			$signString = implode($signkey);
    			$signString = sha1($signString);
    	if(strripos($url,'?')){
    		$url= $url."&timestamp=$timestamp&nonce=$nonce&signature=$signString";
    	}else{
    		$url= $url."?timestamp=$timestamp&nonce=$nonce&signature=$signString";
    	}
    	$header[] = "Content-type: text/xml";        //定义content-type为xml,注意是数组
    	$ch = curl_init ($url);
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
    	$response = curl_exec($ch);
    	if(curl_errno($ch)){
    		print curl_error($ch);
    	}
    	curl_close($ch);
    	
    	return $response;
    }

    /**
     * 分析消息类型，并分发给对应的函数
     *
     * @return void
     */
    public function run() {
        $xuanzezu = $this->xuanzezu;
        $from=$this->getRequest('fromusername');
         $check = $this->sqlselect('flag',$from,"row");
         
        if($xuanzezu[18] && $this->getRequest('content') != $xuanzezu[19] && !$check[2]){
            //直接回复第三方返回的xml
            exit($this->sendxml($GLOBALS['HTTP_RAW_POST_DATA'],$xuanzezu[20],$xuanzezu[21]));
        }else{
            if(!$check[2]){
                 $sql_check = "UPDATE  `weixin_flag` SET `flag` = '1'  WHERE  `openid` =  '{$from}'";
	        	mysql_query($sql_check);
            }
                switch ($this->getRequest('msgtype')) {
        
                case 'event':
                  switch ($this->getRequest('event')) {
        
                    case 'subscribe':
                      $this->onSubscribe();
                      break;
        
                    case 'unsubscribe':
                      $this->onUnsubscribe();
                      break;
        
                    case 'SCAN':
                      $this->onScan();
                      break;
        
                    case 'LOCATION':
                      $this->onEventLocation();
                      break;
        
                    case 'CLICK':
                      $this->onClick();
                      break;
        
                  }
        
                  break;
        
                case 'text':
                  $this->onText();
                  break;
        
                case 'image':
                  $this->onImage();
                  break;
        
                case 'location':
                  $this->onLocation();
                  break;
        
                case 'link':
                  $this->onLink();
                  break;
        
                case 'voice':
                  $this->onVoice();
                  break;
        
                default:
                  $this->onUnknown();
                  break;
        
              }

        }
       
    }

    /**
     * 自定义的错误处理函数，将 PHP 错误通过文本消息回复显示
     * @param  int $level   错误代码
     * @param  string $msg  错误内容
     * @param  string $file 产生错误的文件
     * @param  int $line    产生错误的行数
     * @return void
     */
    protected function errorHandler($level, $msg, $file, $line) {
      if ( ! $this->debug) {
        return;
      }

      $error_type = array(
        // E_ERROR             => 'Error',
        E_WARNING           => 'Warning',
        // E_PARSE             => 'Parse Error',
        E_NOTICE            => 'Notice',
        // E_CORE_ERROR        => 'Core Error',
        // E_CORE_WARNING      => 'Core Warning',
        // E_COMPILE_ERROR     => 'Compile Error',
        // E_COMPILE_WARNING   => 'Compile Warning',
        E_USER_ERROR        => 'User Error',
        E_USER_WARNING      => 'User Warning',
        E_USER_NOTICE       => 'User Notice',
        E_STRICT            => 'Strict',
        E_RECOVERABLE_ERROR => 'Recoverable Error',
        E_DEPRECATED        => 'Deprecated',
        E_USER_DEPRECATED   => 'User Deprecated',
      );

      $template = <<<ERR
PHP 报错啦！

%s: %s
File: %s
Line: %s
ERR;

      $this->responseText(sprintf($template,
        $error_type[$level],
        $msg,
        $file,
        $line
      ));
    }

  }

  /**
   * 用于回复的基本消息类型
   */
  abstract class WechatResponse {

    protected $toUserName;
    protected $fromUserName;
    protected $funcFlag;
    protected $template;

    public function __construct($toUserName, $fromUserName, $funcFlag) {
      $this->toUserName = $toUserName;
      $this->fromUserName = $fromUserName;
      $this->funcFlag = $funcFlag;
    }

    abstract public function __toString();

  }

  /**
   * 用于回复的文本消息类型
   */
  class TextResponse extends WechatResponse {

    protected $content;

    public function __construct($toUserName, $fromUserName, $content, $funcFlag = 0) {
      parent::__construct($toUserName, $fromUserName, $funcFlag);

      $this->content = $content;
      $this->template = <<<XML
<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[text]]></MsgType>
  <Content><![CDATA[%s]]></Content>
  <FuncFlag>%s</FuncFlag>
</xml>
XML;
    }

    public function __toString() {
      return sprintf($this->template,
        $this->toUserName,
        $this->fromUserName,
        time(),
        $this->content,
        $this->funcFlag
      );
    }

  }

  /**
   * 用于回复的音乐消息类型
   */
  class MusicResponse extends WechatResponse {

    protected $title;
    protected $description;
    protected $musicUrl;
    protected $hqMusicUrl;

    public function __construct($toUserName, $fromUserName, $title, $description, $musicUrl, $hqMusicUrl, $funcFlag) {
      parent::__construct($toUserName, $fromUserName, $funcFlag);

      $this->title = $title;
      $this->description = $description;
      $this->musicUrl = $musicUrl;
      $this->hqMusicUrl = $hqMusicUrl;
      $this->template = <<<XML
<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[music]]></MsgType>
  <Music>
    <Title><![CDATA[%s]]></Title>
    <Description><![CDATA[%s]]></Description>
    <MusicUrl><![CDATA[%s]]></MusicUrl>
    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
  </Music>
  <FuncFlag>%s</FuncFlag>
</xml>
XML;
    }

    public function __toString() {
      return sprintf($this->template,
        $this->toUserName,
        $this->fromUserName,
        time(),
        $this->title,
        $this->description,
        $this->musicUrl,
        $this->hqMusicUrl,
        $this->funcFlag
      );
    }

  }

  /**
   * 用于回复的图文消息类型
   */
  class NewsResponse extends WechatResponse {

    protected $items = array();

    public function __construct($toUserName, $fromUserName, $items, $funcFlag) {
      parent::__construct($toUserName, $fromUserName, $funcFlag);

      $this->items = $items;
      $this->template = <<<XML
<xml>
  <ToUserName><![CDATA[%s]]></ToUserName>
  <FromUserName><![CDATA[%s]]></FromUserName>
  <CreateTime>%s</CreateTime>
  <MsgType><![CDATA[news]]></MsgType>
  <ArticleCount>%s</ArticleCount>
  <Articles>
    %s
  </Articles>
  <FuncFlag>%s</FuncFlag>
</xml>
XML;
    }

    public function __toString() {
      return sprintf($this->template,
        $this->toUserName,
        $this->fromUserName,
        time(),
        count($this->items),
        implode($this->items),
        $this->funcFlag
      );
    }

  }
class version{
    public function verSions(){
        var_dump($this->hasplugs());
    }
    public function hasplugs(){
            include('../version.php');
        $plugs =array(
            'version'=>$version,
            'plugs'=>array()
        );
		if(file_exists("../wall/cj_plug/cj_html.php"))
		 {
			 array_push($plugs['plugs'],'cj_plug');
		 }
		if(file_exists("../myadmin/shady.php"))
		 {
			 array_push($plugs['plugs'],'cjg_plug');
		 }
		if(file_exists("../wall/qdq_plug/qdq_html.php"))
		 {
			 array_push($plugs['plugs'],'qdq_plug');
		 }
		if(file_exists("../wall/ddp_plug/ddp_html.php"))
		 {
			 array_push($plugs['plugs'],'ddp_plug');
		 }
		if(file_exists("../wall/vote_plug/vote_html.php"))
		 {
			 array_push($plugs['plugs'],'vote_plug');
		 }
		if(file_exists("../shake/index.php"))
		 {
			 array_push($plugs['plugs'],'shake_plug');
		 }
		if(file_exists("../qyweixin/index.php"))
		 {
			 array_push($plugs['plugs'],'qy_plug');
		 }
		 return $plugs;

    }
}
  /**
   * 单条图文消息类型
   */
  class NewsResponseItem {

    protected $title;
    protected $description;
    protected $picUrl;
    protected $url;
    protected $template;

    public function __construct($title, $description, $picUrl, $url) {
      $this->title = $title;
      $this->description = $description;
      $this->picUrl = $picUrl;
      $this->url = $url;
      $this->template = <<<XML
<item>
  <Title><![CDATA[%s]]></Title>
  <Description><![CDATA[%s]]></Description>
  <PicUrl><![CDATA[%s]]></PicUrl>
  <Url><![CDATA[%s]]></Url>
</item>
XML;
    }

    public function __toString() {
      return sprintf($this->template,
        $this->title,
        $this->description,
        $this->picUrl,
        $this->url
      );
    }

  }
