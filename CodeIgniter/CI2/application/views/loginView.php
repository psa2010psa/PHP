<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A complete admin panel theme">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="author" content="smronju">
<title>运营工具平台</title>
<link rel="stylesheet" href="/resource/css/css.css">
<link rel="stylesheet" href="/resource/css/responsive.css">
<link rel="stylesheet" href="/resource/css/style.css">

<!--[if IE 8]>
    <link href="/resource/css/ie8.css" rel="stylesheet">
    <![endif]-->

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script type="text/javascript">
        var ua = navigator.userAgent.toLowerCase();
        if (window.ActiveXObject)
        {
			alert("您正在使用IE浏览器，为了更好的效果，请您使用谷歌浏览器！");	  
		}
</script>
</head>

<body>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="login"> <img src="/resource/images/user.png" alt="user" class="glossy facePic">
        <div> <span style="display:none" id="errorTip" class="errorTip"></span>
          <input name="username" placeholder="用户名" value="<?php if(isset($_COOKIE['username'])){echo $_COOKIE['username'];}?>" class="span12" type="text" id="Jemail">
          <input name="password" placeholder="密码" class="span12" type="password" id="Jpassword">
          <input name="password" placeholder="验证码" class="width80 floatLeft" type="text" id="JcheckCode">
          <img src="/captcha" class="floatLeft checkCode" style="border:0; border-radius:0" id="authCode"><a href="javascript:void(0);"><img src="/resource/images/refresh.png" class="floatLeft refresh" id="refreshBtn"></a>
          <input name="login" value="登陆" class="btn btn-info span12" type="submit" id="loginBtn">
          <input name="login" value="正在登陆。。。。" class="btn btn-info span12" type="button" id="loading" style="display:none">
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/resource/js/jquery.js"></script> 
<script type="text/javascript" src="/resource/js/login.js"></script>
</body>
</html>