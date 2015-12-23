<?php
/**
 * 微信公众平台 PHP SDK 示例文件
 *
 * @author NetPuter <netputer@gmail.com>
 */
  require('wechat.php');
  //默认回复

  /**
   * 微信公众平台演示类
   */
  class MyWechat extends Wechat {
	
    /**
     * 用户关注时触发，回复「欢迎关注」
     *
     * @return void
     */
    protected  function welcome() {
        $xuanzezu = $this->xuanzezu;
        $weixin_name = $this->weixin_name;
		if(file_exists("../wall/cj_plug/cj_html.php"))
		 {
			$cj_plug=1;
		 }
		if(file_exists("../wall/qdq_plug/qdq_html.php"))
		 {
			$qdq_plug=1;
		 }
		if(file_exists("../wall/ddp_plug/ddp_html.php"))
		 {
			$ddq_plug=1;
		 }
		if(file_exists("../shake/index.php"))
		 {
			$shake_plug=1;
		 }

		$vote = new NewsResponseItem('【投票】参与投票请回复【'.$xuanzezu[15].'】');
		$shake = new NewsResponseItem('【摇一摇】参与摇一摇请回复【'.$xuanzezu[13].'】');
		$qdq = new NewsResponseItem('【签到】您已经成功签到！');
		$cj = new NewsResponseItem('【抽奖】发送消息上墙后将获得抽奖资格');
		$ddp = new NewsResponseItem('【对对碰】发送消息上墙后将获得对对碰抽奖资格');
		  $items = array(
			new NewsResponseItem("欢迎关注{$weixin_name}"),
			new NewsResponseItem('【上墙】发送【'.$xuanzezu[0].'任意内容】即可上墙'),
			new NewsResponseItem('【图片】直接发送图片即可上墙'),
		  );
		  if($xuanzezu[12] && $shake_plug){
			  array_push($items,$shake);
			  }
		  if($xuanzezu[14]){
			  array_push($items,$vote);
			  }
		  if($qdq_plug){
			  array_push($items,$qdq);
			  }
		  if($cj_plug){
			  array_push($items,$cj);
			  }
		  if($ddq_plug){
			  array_push($items,$ddp);
			  }
		  return $items;
		}
	 /**
     * 验证码回复
     *
     * @return void
     */
	protected function VERYF($weixin_name,$veryfs) 
	{ 
      $items = array(
        new NewsResponseItem("欢迎关注{$weixin_name}"),
        new NewsResponseItem("本模块将要获取您的：
		
		头像，昵称，性别等个人信息
		
		您的验证码为：{$veryfs}
		
		请您回复验证码参与！
		")
      );
		return $items;  
	} 
    /**
     * 用户关注时触发，回复
     *
     * @return void
     */
    protected function onSubscribe() {
        $weixin_name = $this->weixin_name;

		$from = $this->getRequest('fromusername');
			$reply = $this->resetflag($weixin_name,$from);
	$reply = $this->endtail($reply);
      $this->responseNews($reply);
    }

    /**
     * 用户已关注时,扫描带参数二维码时触发，回复二维码的EventKey (测试帐号似乎不能触发)
     *
     * @return void
     */
    protected function onScan() {
      $this->responseText('二维码的EventKey：' . $this->getRequest('EventKey'));
    }

    /**
     * 用户取消关注时触发
     *
     * @return void
     */
    protected function onUnsubscribe() {
        $this->deleteflag($this->getRequest('fromusername'));
      // 「悄悄的我走了，正如我悄悄的来；我挥一挥衣袖，不带走一片云彩。」
    }

    /**
     * 上报地理位置时触发,回复收到的地理位置
     *
     * @return void
     */
    protected function onEventLocation() {
      $this->responseText('收到了位置推送：' . $this->getRequest('Latitude') . ',' . $this->getRequest('Longitude'));
    }
    /**
     * 收到图片消息时触发，回复由收到的图片组成的图文消息
     *
     * @return void
     */
    protected function onImage() {
        $xuanzezu = $this->xuanzezu;
        $weixin_name = $this->weixin_name;

		$picurl = $this->getRequest('picurl');
		$from = $this->getRequest('fromusername');
		$time = $this->getRequest('createtime');
        $check = $this->sqlselect('flag',$from,"row");
        if (!$check[1]) {
				$reply = $this->resetflag($weixin_name,$from);
        }
		if($check[2] == '2'){
				$reply =$this->replaypic($from,$time,$picurl);
			}else{
			$q = $this->sqlselect('flag',$from);
			$veryfs=$q['verify'];
				$reply=$this->VERYF($weixin_name,$veryfs);
				}
		    if($xuanzezu[18]){
		        $end = new NewsResponseItem('回复【退出】退出本活动系统','');
		        array_push($reply,$end);
		    }
	$reply = $this->endtail($reply);
      $this->responseNews($reply);
    }

    /**
     * 收到文本消息时触发，回复收到的文本消息内容
     *
     * @return void
     */
    protected function onText() {
        $xuanzezu = $this->xuanzezu;
        $weixin_name = $this->weixin_name;
		
		$content = $this->getRequest('content');
		$from = $this->getRequest('fromusername');
		$time = $this->getRequest('createtime');
		$content = $this->biaoqing($content);
		
        $check = $this->sqlselect('flag',$from,"row");
        if($xuanzezu[18]){
            if($content == '退出'){
		        $this->deleteflag($from);
				$reply = array(new NewsResponseItem('您已成功退出本活动系统。',''));
				$check[2] = '-10';
			}
        }
		if($content == '重置'){
				$reply = $this->resetflag($weixin_name,$from);
				$check[2] = '-10';
			}
		if($content == '帮助'){
				$reply = $this->welcome();
				$check[2] = '-10';
			}

        if (!$check[1]) {
				$reply = $this->resetflag($weixin_name,$from);
        }
			//判断用户是否没有录入信息
		if ($check[2] == '1') {
			$q = $this->sqlselect('flag',$from);
			$veryfs=$q['verify'];
			//判断验证码正确
			if($content  == $veryfs){
				$reply = $this->monigetinfo($from,$time,$content,$veryfs);
				}else{
                $reply = $this->VERYF($weixin_name,$veryfs);
					}
		}
		if($check[2] == '2'){
				$reply =$this->replay($from,$time,$content);
			
			}
		    if($xuanzezu[18]){
		        $end = new NewsResponseItem('回复【退出】退出本活动系统','');
		        array_push($reply,$end);
		    }
			if($check[2] != '88'){
			$reply = $this->endtail($reply);
			}
      $this->responseNews($reply);
    }
	 /**
     * 信息录入
     *
     * @return void
     */
	protected function monigetinfo($from,$time,$content,$veryfs) 
	{ 
		include('function.php');
		$isluru =  isluru($from,$time,$content);
		if($isluru == 1)
		{
		$reply = array(
			new NewsResponseItem("获取失败"),
			new NewsResponseItem("抱歉，服务器繁忙，您的信息获取失败，请重新回复【{$veryfs}】！"),
		 );
		}else{
		$sql_check = "UPDATE  `weixin_flag` SET `flag` = '2'  WHERE  `openid` =  '{$from}';";
		mysql_query($sql_check);
		//该地址为1.php上传后的地址
		$reply = $this->welcome();
		}
		return $reply;
	} 
	 /**
     * 信息录入之后的回复函数
     *
     * @return void
     */
	protected function replay($from,$time,$content) 
	{ 
        $xuanzezu = $this->xuanzezu;
        $weixin_name = $this->weixin_name;
            /*话题判断函数开始*/
            function startsWith($haystack, $needle, $case = false)
            {
                if ($case) {
                    return strcmp(substr($haystack, 0, strlen($needle)), $needle) === 0;
                }
                return strcasecmp(substr($haystack, 0, strlen($needle)), $needle) === 0;
            }
            /*话题判断函数结束*/
		if ($content == $xuanzezu[13] && $xuanzezu[12]){//摇一摇函数
		include('function.php');
			$isluru =lurushake($from);
			if($isluru != 1){
			$reply = array(
					new NewsResponseItem('点击进入摇一摇', '点击本模块进入摇一摇！', Web_ROOT."/shake/images/shakeshow.jpg",Web_ROOT."/shake/mobile/index.php?wecha_id={$from}"),
					new NewsResponseItem('进入摇一摇后等待游戏开始，主持人点击开始游戏，倒计时后用您吃奶的劲尽情狂欢吧！', '', '',Web_ROOT."/shake/mobile/index.php?wecha_id={$from}"),
			);
			}
			}
		else if($content == $xuanzezu[15] && $xuanzezu[14]){
			//投票函数
			$reply = array(
					new NewsResponseItem('点击进入投票', '点击本模块进入投票！',Web_ROOT.'/vote/images/voteshow.jpg',Web_ROOT."/vote/index.php?wecha_id=$from"),
      		);
		}else if(startsWith($content, $xuanzezu[0])){
			$q = $this->sqlselect('flag',$from);
				if($q['nickname'] != ''){
						$reply = $this->writeinwall($content,$time,$q);
					}else{
						$reply = $this->unkownerror();
						}
				}else{
					$reply = $this->welcome();
					}
			return $reply;
	} 
	 /**
     * 写入wall函数
     *
     * @return void
     */
	protected function writeinwall($content,$time,$q,$type='') 
	{ 
        $xuanzezu = $this->xuanzezu;
        $weixin_name = $this->weixin_name;
		include('function.php');
		
		//时间间隔判断
		if (($time-$q['datetime'])<$xuanzezu[11]){
			$reply = array(
					new NewsResponseItem("休息一下"),
					new NewsResponseItem("您发送的太快了，墙上还有位置慢慢来~"),
					 );
			return $reply;
		}
			 //以下为写入wall
		if($type == 'pic'){
                $sql = "INSERT INTO `weixin_wall` (`id`,`messageid`,`fakeid`,`num`,`content`,`nickname`,`avatar`,`ret`,`image`,`datetime`) VALUES (NULL,'0','{$q['fakeid']} ','-1','此消息为图片！','{$q['nickname']}','{$q['avatar']}','0','{$content}','{$time}')";
			}else{
				$sql = "INSERT INTO `weixin_wall` (`id`,`messageid`,`fakeid`,`num`,`content`,`nickname`,`avatar`,`ret`,`datetime`) VALUES (NULL,'0','{$q['fakeid']}','-1','{$content}','{$q['nickname']}','{$q['avatar']}','0','{$time}')";
		}
                    mysql_query($sql);
					$q['nickname']=pack('H*',$q['nickname']);
					$usernickname = new NewsResponseItem("亲爱的【{$q['nickname']}】");
				  if($type == 'pic'){
					  $usernickname = new NewsResponseItem("亲爱的【{$q['nickname']}】","这是图片消息",$content,$content);
					  }
					  
					   if ($xuanzezu[9] == 0) {
										$cid = mysql_query('select id from `weixin_wall` WHERE id =(select max(id) from `weixin_wall`)');
										$row = mysql_fetch_array($cid);
										$maxid = $row['id'];
										   doshenhe($maxid);
									$isauto = new NewsResponseItem("您的消息已经成功发送，请多关注墙上内容！");
									}else{
									$isauto = new NewsResponseItem("您的消息已经成功发送，等待管理员审核后即可上墙，请多关注墙上内容！");
									}
						$reply = array(
							
						 );
						 array_unshift($reply,$usernickname,$isauto);
		return $reply;
	} 
    /**
     * 收到地理位置消息时触发，回复收到的地理位置
     *
     * @return void
     */
    protected function onLocation() {
      //$num = 1 / 0;
      // 故意触发错误，用于演示调试功能

      $this->responseText('收到了位置消息：' . $this->getRequest('location_x') . ',' . $this->getRequest('location_y'));
    }

    /**
     * 收到链接消息时触发，回复收到的链接地址
     *
     * @return void
     */
    protected function onLink() {
      $this->responseText('收到了链接：' . $this->getRequest('url'));
    }

    /**
     * 收到语音消息时触发，回复语音识别结果(需要开通语音识别功能)
     *
     * @return void
     */
    protected function onVoice() {
      $this->responseText('请发送文字信息进行上墙');
    }

    /**
     * 收到自定义菜单消息时触发，回复菜单的EventKey
     *
     * @return void
     */
    protected function onClick() {
      $this->responseText('你点击了菜单：' . $this->getRequest('EventKey'));
    }

    /**
     * 收到未知类型消息时触发，回复收到的消息类型
     *
     * @return void
     */
    protected function onUnknown() {
      $this->responseText('收到了未知类型消息：' . $this->getRequest('msgtype'));
    }

  }
  $wechat = new MyWechat('xiaobai', false );
  $wechat->run();
