<script type="text/javascript"> 
var judge;
var ua = navigator.userAgent.toLowerCase();
if(ua.match(/MicroMessenger/i) == 'micromessenger'){ 
judge =true; 
}else{ 
judge= false; 
if(ua.match(/windows/i) != 'windows'){
	judge =true; 
}
} 
if(!judge){ 
window.location='error.php';
} 
</script> 