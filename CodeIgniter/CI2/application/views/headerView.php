<!doctype html>    
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="pragma" content="no-cache">  
        <meta http-equiv="cache-control" content="no-cache">  
        <meta http-equiv="expires" content="0">  

        <title>运营工具平台</title>
        <link rel="stylesheet" href="/resource/css/css.css">
        <link rel="stylesheet" href="/resource/css/responsive.css">
        <link rel="stylesheet" href="/resource/css/style.css">
        <link rel="stylesheet" href="/resource/css/plugins.css">
        <script type="text/javascript" src="/resource/js/jquery.js"></script>
        <script type="text/javascript" src="/resource/js/base.js"></script>
        <script type="text/javascript" src="/resource/js/blocksit.js"></script>
        <script type="text/javascript" src="/resource/js/main.js"></script>
        <script type="text/javascript" src="/resource/js/header.js"></script>
        <script type="text/javascript" src="/resource/js/iButton.js"></script>
      
        <script type="text/javascript" src="/resource/js/messager/jquery.messager.js"></script>
      
        <!--[if lte IE 6]>
            <script src="/resource/js/bootstrap-ie.js"></script>
            <link href="/resource/css/bootstrap-ie6.css" rel="stylesheet">
        <![endif]-->
        
        <!--[if lte IE 7]>
            <script src="/resource/js/bootstrap-ie.js"></script>
            <link href="/resource/css/bootstrap-ie7.css" rel="stylesheet">
        <![endif]-->
        
        <!--[if IE 8]>
            <script src="/resource/js/bootstrap-ie.js"></script>
            <link href="css/ie8.css" rel="stylesheet">
            <![endif]-->

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="/resource/js/respond.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="header_wrapper">
            <div class="container-fluid">
                <div class="row-fluid"> <a class="logo" title="" href="/main"><img alt="" src="/resource/images/logo.png" height="34"></a>
                    <ul class="user_nav">
                        <li class="account-text"><?php echo $userInfo["email"]; ?></li>
                        <li class="">
                            <a href="#" data-toggle="dropdown" onclick="readAllUserMsg()" id="show_message_tip" rel="tooltip"  class="tips icon_mail menuDrop" data-original-title="Messages">
                                <span class="badge badge-info" id="new_msg_num"></span>
                            </a>
                            
                            <ul class="dropdown-menu pull-right gradient user_dropdown">
                                
                            </ul>
                        </li>
                        <?php if ($userInfo["is_manager"] == 1)
                        { ?>
                            <li> <a data-original-title="管理" href="/manage/main/" rel="tooltip" class="tips icon_manage"></a> </li>
                  <?php } ?>                
                        <li> <a data-original-title="账户设置" href="#" data-toggle="dropdown" rel="tooltip" class="tips icon_settings menuDrop"></a>
                            <ul class="dropdown-menu pull-right gradient user_dropdown">
                                <li><a href="#" onClick="showUserInfo(1,<?php echo $userInfo['uid']; ?>,'<?php echo $userInfo['email']; ?>','<?php echo $userInfo['real_name']; ?>','<?php echo $userInfo['mobile']; ?>');"><i class="icon-user"></i>用户资料</a></li>
                                <li><a href="#" onClick="showUserInfo(2,<?php echo $userInfo['uid']; ?>,'<?php echo $userInfo['email']; ?>','<?php echo $userInfo['real_name']; ?>','<?php echo $userInfo['mobile']; ?>');"><i class="icon-cog"></i>修改密码</a></li>
                                <li><a href="#" onClick="showMessage();"><i class="icon-share-alt"></i>安全退出</a></li>
                            </ul>
                        </li>
                        <li> <a data-original-title="安全退出" href="#" onClick="showMessage();" rel="tooltip" class="tips icon_logout"></a> </li>
                        <li><span>&nbsp;</span></li>
                    </ul>
                    <!-- user_nav end --> 
                </div>
            </div>
        </div>
        <div class="modal fade" id="quitUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">提示</h3>
            </div>
            <div class="modal-body">
                <h4>是否要退出本系统</h4>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
                <button class="btn btn-primary"  onClick="quitUser('/login/logout');" id="lockBtn">确认</button>
            </div>
        </div>

        <div class="modal fade" id="UserInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="headerboxTitle">修改密码</h3>
            </div>
            <div class="form_inputs clearfix" id="user_psw">
                <div class="row-fluid">
                    <div class="span2">
                        <label class="control-label">原密码:</label>
                    </div>
                    <div class="span10" style="position:relative">
                        <input type="password" name="user_password"  id='user_password' class="" />
                    </div>
                </div>
            </div>
            <div class="form_inputs clearfix" id="usernew_psw">
                <div class="row-fluid">
                    <div class="span2">
                        <label class="control-label">新密码:</label>
                    </div>
                    <div class="span10" style="position:relative">
                        <input type="password" name="user_password"  id='usernew_password' class="" />
                    </div>
                </div>
            </div>
            <div class="form_inputs clearfix" id="usernew_psw2">
                <div class="row-fluid">
                    <div class="span2">
                        <label class="control-label">确认新密码:</label>
                    </div>
                    <div class="span10" style="position:relative">
                        <input type="password" name="user_password"  id='usernew_password2' class="" />
                    </div>
                </div>
            </div>
            <div class="form_inputs clearfix" id='userMobile'>
                <div class="row-fluid">
                    <div class="span2">
                        <label class="control-label">手机:</label>
                    </div>
                    <div class="span10" style="position:relative">
                        <input type="text" name="user_mobile"  id='user_mobile' class="" />
                    </div>
                </div>
            </div>
            <input type="text" id="user_email_id" value="" style="display: none;">
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
                <button class="btn btn-primary"  id ="userSaveBtn" onClick="saveUserInfo('/center/user/saveUserInfo');">保存编辑</button>
            </div>
        </div>    
        <div class="modal fade" id="deleteUserMsgTip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>提示</h3>
            </div>
            <div class="modal-body">
                <h4></h4>
                <p id="msg_tip">确定删除此消息吗？</p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
                <button class="btn btn-primary" id="deleteUserMsgBtn" onClick="deleteContent('','/userMsg/deletetUserMsg');">确定</button>
            </div>
        </div>
