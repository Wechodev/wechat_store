<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background:#EFEFEF; font-family:'Microsoft Yahei'; color: #333; font-size: 14px; }
.system-message{ padding:0 0 48px; margin:150px auto; width:500px; border:1px solid #e3e3e3; background:#fff; border-radius:3px}
.system-message h3{ font-size: 50px; font-weight: normal; line-height:120px; margin-bottom: 12px; border:1px solid #e3e3e3}
.system-message .jump{ padding-top:10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; text-align: center; font-size:18px; font-weight:bold;}
.system-message .detail{line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
	<div style="padding:24px;">
		<div class="error"><span style="padding-top:0px;"><?php echo($error); ?></div>	
	</div>
<p class="detail"></p>
<div class="jump" style="float:right;padding-right:5px;">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>" <?php if($return_top){ ?> target="_top" <?php } ?> >跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time == 0) {
		<?php if($return_top){ ?>
			top.location.href = href;
		<?php }else{ ?>
			location.href = href;
		<?php } ?>
		clearInterval(interval);
	};
}, 1000);
})();

</script>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254186514'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1254186514' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>