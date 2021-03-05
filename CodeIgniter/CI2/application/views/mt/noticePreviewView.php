<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,user-scalable=no" />
<style>
body{font-family:"微软雅黑";font-size:18px;background:url(/resource/app/mt/template/images/bg.gif) repeat;padding:10px;}*{margin:0;padding:0;}#list{width:100%;overflow:hidden;background:#FFF;border-radius:10px;padding:5px;}li{list-style:none;padding:10px 5px 10px 30px;position:relative;font-weight:bold;border-radius:10px;background:#ebebeb;margin-bottom:5px;}.t{background:url(images/d.png) repeat-y;margin-left:-25px;}dd{padding:10px 5px 10px 30px;color:#01709d;}.hide{display:none;}a{text-decoration:none;color:#000;}@media screen and (max-device-width:400px){}.top{position:fixed;margin-left:265px;width:32px;height:27px;z-index:99}
</style>
<title>MT</title>
<script type="text/javascript">window.onload = function() { 
	var li = document.getElementById("list").getElementsByTagName("li"); 
	for(var i=0; i<li.length; i++) {
	(function() {li[i].onclick = function() {if (navigator.userAgent.indexOf("MSIE") >0) {
		var dd = this.nextSibling;}else{var dd = this.nextSibling.nextSibling;}
		if(dd.className == "hide"){
			dd.className = dd.className.replace(new RegExp('\\bhide\\b\\s*', 'g'), '');}else{dd.className +="hide";}}})();
	}
} 
function closeTab(){var dd = document.getElementById("list").getElementsByTagName("dd"); for(i=0;i<dd.length;i++){ dd[i].className="hide"}}</script>
</head>
<body>
<div id="top" class="white">
<div class="top"><a href="#top" onclick="closeTab()"><img src="/resource/app/mt/template/images/top.gif" /></a></div>
<ul id="list">
  <?php if($data){ foreach($data as $v){?>
  <li><em></em> <a href="javascript:void(0);"  style="color:<?php echo $v["title_color"];?>"><?php echo $v["title"];?></a></li>
  <dd class="hide"><?php echo $v["content"];?></dd>
  <?PHP }} ?>
</ul>
</div>
</body>
</html>
