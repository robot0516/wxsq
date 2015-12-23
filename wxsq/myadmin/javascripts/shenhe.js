$(function(){
		$('.dete-row').click(function(){
			var vote_id = $(this).parent().parent().attr('name');
			$.get("shenhe.do.php", {do: "zengjian", cid: "2",numdel:vote_id},function(date){
						if(date == 1){
							alert("已成功删除本选项！");
							location.href='';
						}
				   });
		});
		$('#autoShenhe').on('switch-change', function (e, data) {
			var $el = $(data.el)
			  , value = data.value;
		   if(value){
			   $.get("shenhe.do.php", {do: "isshenghe", cid: "0" },function(){
				   });
			   }else{
			   $.get("shenhe.do.php", {do: "isshenghe", cid: "1" },function(){
				   });
				   }
		});
		$('#circulation').on('switch-change', function (e, data) {
			var $el = $(data.el), value = data.value;
		   if(value){
			   $.get("shenhe.do.php", {do: "circulation", cid: "1" },function(){
				   });
			   }else{
			   $.get("shenhe.do.php", {do: "circulation", cid: "0" },function(){
				   });
				   }
		});
		$('#fusion_open').on('switch-change', function (e, data) {
			var $el = $(data.el)
			  , value = data.value;
		   if(value){
			   $.get("shenhe.do.php", {do: "isfusion", cid: "1" },function(){
						alert("已经开启，请设置万能融合接口相关信息！");
						
						$("#fusionset").click();
			   			$("#setinfo").show(400);
			   			
				   });
			   }else{
			   $.get("shenhe.do.php", {do: "isfusion", cid: "0" },function(){
						alert("已经关闭，请在微信端对接下列url和token。");
						$("#setinfo").hide(400);
				   });
				   }
		});
		$('#autopush').on('switch-change', function (e, data) {
			var $el = $(data.el), value = data.value;
		   if(value){
			   $.get("shenhe.do.php", {do: "autopush", cid: "1" },function(){
				   });
			   }else{
			   $.get("shenhe.do.php", {do: "autopush", cid: "0" },function(){
				   });
				   }
		});
		$('#shake_open').on('switch-change', function (e, data) {
			var $el = $(data.el), value = data.value;
		   if(value){
			   $.post("shenhe.do.php?do=changeconfig&cof=shakeopen", {name: "1" },function(){
				   });
			   }else{
			   $.post("shenhe.do.php?do=changeconfig&cof=shakeopen", {name: "0" },function(){
				   });
				   }
		});
		$('#vote_open').on('switch-change', function (e, data) {
			var $el = $(data.el), value = data.value;
		   if(value){
			   $.post("shenhe.do.php?do=changeconfig&cof=voteopen", {name: "1" },function(){
				   });
			   }else{
			   $.post("shenhe.do.php?do=changeconfig&cof=voteopen", {name: "0" },function(){
				   });
				   }
		});
		$('#issueSysinform').click(function(){
			 var val = $('#sysinform').val();
		   
			   if(val != ''){
			   //到时加入数据处理函数
			   if(confirm('确定发布【'+val+'】?')){
				   $.get("shenhe.do.php", {do: "addmassage", data: val },function(){
			   });
			   window.location.reload();}
			   }else{
				   alert('公告可不能为空哦~');
				   }
			});
	  $(document).on('mouseenter','#sutooltip-top',function(){
		  	$(this).popover('show');
		  }).on('mouseout','#sutooltip-top',function(){
		  	$(this).popover('hide');
		  });
		$('#shenhenum').click(function(){
			$('#ss').click();
			});
		$('#waitshenhenum').click(function(){
			$('#ww').click();
			});
		$('#changepwd').click(function(){
			$('#changpass').click();
			});
			
			//以下是手动登陆的函数
		$('#img-logened img').click(function(){
			verifyGen();
			});
		$('#codetext').focus(function(){
			verifyGen();
			});
	
	});
			//以下是手动登陆的函数
	function activatelogin(){
		$.get(root+'/shenhe.do.php', {do: "monidetection"},function(date){
			if(!date){
				$("#labal-logened").hide();
				$("#labal-needlogin").show();
				$("#button-logened").attr("class","btn btn-lg btn-block btn-success").removeAttr("disabled");
				$("#codepwd").removeAttr("disabled");
				$("#codetext").removeAttr("disabled");
				$("#img-logened").attr("style","");
				}
		});
		}
	function verifyGen() {
		var url = root+'/shenhe.do.php?do=getimgcode';
		$.getJSON(url,{},function(d) {
			$('#img-logened img').attr('src',d['imgcodeurl']);
			$('#codecookie').attr('value',d['cookie']);
			});

	}
