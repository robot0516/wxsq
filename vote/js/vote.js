$(function() {
	$('.selecs').on("click", function(){
	    if ($("input[type='checkbox']:checked").length<votecannum){
	        $(this).parent().find("input").click();
	    }else{
	        if($(this).parent().find("input").prop("checked")){
    	        $(this).parent().find("input").click();
	        }else{
	        alert('最多选择'+votecannum+'个！');
	          }
	    }
		});
	$("body").on('submit', function () {
	    if($("input[type='checkbox']:checked").length!=votecannum){
	       alert('请选择'+votecannum+'个选项再提交！');
          return false;
	    }
    });
	$('#closewindow').on("click",function(){
		WeixinJSBridge.invoke('closeWindow',{});
		})
});
		function onBridgeReady(){
		 WeixinJSBridge.call('hideOptionMenu');
		}
		
		if (typeof WeixinJSBridge == "undefined"){
			if( document.addEventListener ){
				document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
			}else if (document.attachEvent){
				document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
				document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
			}
		}else{
			onBridgeReady();
		}