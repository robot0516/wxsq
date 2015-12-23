<link rel="stylesheet" href="ddp_plug/images/ddpcss.css" type="text/css">
<div class="fl-pair ui transition hidden" id="ddp_layer">
<div class="fl-inner fl-bg">
  <div class="inner-cont clearfix">
    <div class="prize-box">
      <span class="props props-color"></span>
      <div class="outer-prize">
        <div class="wrap-prize">
          <div class="list-top clearfix">
            <p class="pro-num">配对组数<em id="ddp_matchedGroupNum">0</em></p>
            <span>配对名单</span>
          </div>
          <div class="list-box">
            <p class="list-tit">
              <span>配对序号</span>
              <span>配对的微信昵称</span>
            </p>
            <div class="priname-box priname-box-pair">
              <ul class="pair-list" id="ddp_matchedUserBox">
                
              </ul>
            </div>
          </div>
          <div class="wrap-btn">
            <a href="javascript:void(0);" class="btn-color btn-reset" id="ddp_resetBtn">
              <span>重新配对</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="lottery-box">
      <div class="box-ltop">
        <span class="pair-wt">缘分对对碰</span>
        <p class="lott-w"><span>参加配对人数</span><em class="join-num" id="ddp_userCount"><img src="ddp_plug/images/loading.gif" /></em></p>
      </div>
      <div class="bubble">
        <div class="bubble-big" id="ddp_bubble3" style="display:none;">
          <span class="w1" style="padding-top: 28px;padding-left: 26px;">恭喜两位！</span>
          <span class="w2">&nbsp;</span>
        </div>
        <span class="bubble-mini" id="ddp_bubble1" style="display:none;"></span>
        <span class="bubble-mini2" id="ddp_bubble2" style="display:none;"></span>
      </div>
      <span class="icon-heart"></span>
      <div class="rock-box clearfix" id="ddp_box">
        <div class="pair-one">
          <span class="rock-head"><img id="ddp_userAvatar" src="ddp_plug/images/pair-default.png" width="178" height="178" alt=""></span>
          <span class="rock-name" id="ddp_userName">……</span>
          <input type="hidden" id="mid" value="">
        </div>
        <div class="pair-one">
          <span class="rock-head"><img id="ddp_toUserAvatar" src="ddp_plug/images/pair-default.png" width="178" height="178" alt=""></span>
          <span class="rock-name" id="ddp_toUserName">……</span>
          <input type="hidden" id="tomid" value="">
        </div>
      </div>
      <div class="btn-clear">
        <p class="btn-rock">
          <a href="javascript:void(0);" class="btn-start" id="ddp_startBtn">
            <span>正在准备数据...</span>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript" src="js/ddp.js"></script>
