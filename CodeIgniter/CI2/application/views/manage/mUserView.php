<script type="text/javascript" src="/resource/js/manage.js"></script>
<script type="text/javascript" src="/resource/js/chosen.min.js"></script>
<?php include "headerNavView.php";?>
<div class="contentainer_wrapper">
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="wrapper"> 
          <!-- sidebar_navigation start -->
          <div class="sidebar_navigation gradient">
            <ul>
              <li  data-original-title="用户列表" class="active tip-right"> <a href="/manage/muser" class="i_forms"> <span class="tab_label">用户列表</span> <span class="tab_info">User</span> </a> </li>
              <li  data-original-title="用户消息列表" class="tip-right"> <a href="/manage/muserMsg" class="i_notice"> <span class="tab_label">用户消息列表</span> <span class="tab_info">User Message</span> </a> </li>
              <!--<li  data-original-title="UI Elements" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/ui_elements.html" class="i_elements tip-right"> <span class="tab_label">UI Elements</span> <span class="tab_info">UI kits</span> </a> </li>
              <li  data-original-title="Typography" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/typography.html" class="i_typography tip-right"> <span class="tab_label">Typography</span> <span class="tab_info">Your writing style</span> </a> </li>
              <li  data-original-title="Tables" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/tables.html" class="i_tables tip-right"> <span class="tab_label">Tables</span> <span class="tab_info">Tabular sheets</span> </a> </li>
              <li  data-original-title="Gallery" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/gallery.html" class="i_gallery tip-right"> <span class="tab_label">Gallery</span> <span class="tab_info">Photos &amp; Videos</span> </a> </li>
              <li  data-original-title="Grid" class="tip-right"> <a data-original-title="" hrefjwwdy1982
              ="http://boltadmin.themio.net/grid.html" class="i_grid tip-right"> <span class="tab_label">Grid</span> <span class="tab_info">Overviews</span> </a> </li>
              <li  data-original-title="Typography" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/charts.html" class="i_charts tip-right"> <span class="tab_label">Charts</span> <span class="tab_info">Visual Data</span> </a> </li>-->
            </ul>
          </div>
          <!-- sidebar_navigation end -->
          <div class="content_wrapper">
            <div class="contents">
              <div class="row-fluid">
                <div class="span5">
                  <div class="ico_16_dashboard content_header">
                    <h3>用户列表</h3>
                    <span>User</span> </div>
                </div>
                  <div class="" style="margin-bottom:10px;">
                <button class="btn btn-large btn-primary" type="button" onClick="editManage()" style="float:right;margin-right:10px;">添加新用户</button>
              </div>
              </div>
              <div class="separator"> <span></span> </div>
              <div class="row-fluid">
                <div class="span12">
                  <ul class="breadcrumb">
                    <li><a href="/manage/main">管理-后台管理</a><span class="divider">&gt;</span></li>
                    <li class="active">用户列表</li>
                  </ul>
                  <div class="" style="margin-bottom:10px;float:right;margin-right:10px;">
                    <button class="btn btn-small btn-primary" type="button" onClick="checkMuser()" style="">查询</button>
		  </div>
                  <div style="margin-bottom:10px;float:right;margin-right:10px;">
                    姓名：<input type="text"  id='check_muser'  value="<?php if(isset($chkUserName)){echo $chkUserName;};?>" /> 
                  </div>
                  <!-- breadcrumb end --> 
                </div>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget_wrapper">
                    <div class="widget_header">
                      <div class="widget_header_option"> 
                        <h3>用户表</h3>
                      </div>
                    </div>
                    <div class="widget_content no-padding">
                      <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                        <thead>
                          <tr>
                            <td></td>
                            <td width="100">邮箱</td>
                            <td width="100">操作APP</td>
                            <td width="100">真实姓名</td>
                            <td width="50">手机</td>
                            <td width="50">登陆IP</td>
                             <td width="100">上次登陆IP</td>
                            <td width="100">登陆时间</td>
                            <td width="100">上次登陆时间</td>
                            <td width="30">管理员</td>
                            <td width="100">创建时间</td>
                            <td width="150">操作</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                      if($data){
                         
                        foreach($data as $k=>$v){
                    ?>
                          <tr style="text-align: center;">
                            <td></td>
                            <td><?php echo $v["email"];?></td>
                            <td><?php echo substr($v["app_name"],0,-1);?></td>
                            <td><?php echo $v["real_name"];?></td>
                            <td><?php echo $v["mobile"];?></td>
                            <td><?php echo $v["login_ip"];?></td>
                            <td><?php echo $v["last_login_ip"];?></td>
                            <td><?php if($v["login_time"]){ echo date("Y-m-d H:i:s",$v["login_time"]);}?></td>
                            <td><?php if($v["last_login_time"]){ echo date("Y-m-d H:i:s",$v["last_login_time"]);}?></td>
                            <td><?php if($v["is_manager"]==1){echo "是";}elseif($v["is_manager"]==0){echo "否";}?></td>
                            <td><?php if($v["create_time"]){ echo date("Y-m-d H:i:s",$v["create_time"]);}?></td>
                            <td><?php
                            if($v["is_manager"]==0){
                                    if($v["is_lock"]==0){
                                 ?>
                              <button class="btn btn-primary" type="button" onClick="showManageLock(<?php echo $v['uid'];?>,<?php echo $v['is_lock'];?>,'<?php echo $v['email'];?>');">锁定</button>
                              <?php }elseif($v["is_lock"]==1){?>
                              <button class="btn btn-danger" type="button" onClick="showManageLock(<?php echo $v['uid'];?>,<?php echo $v['is_lock'];?>,'<?php echo $v['email'];?>');">解锁</button>
                              <?php }?>
                              <button class="btn btn-primary" type="button" onClick="editManage(<?php echo $v['uid'];?>,'<?php echo $v['email'];?>','<?php echo $v['password'];?>','<?php echo $v['app'];?>','<?php echo $v['game'];?>','<?php echo $v['weixin'];?>','<?php echo $v['real_name'];?>',<?php echo $v['mobile'];?>)">编辑</button>
                              <button class="btn btn-danger" type="button" onClick="showManageDelete(<?php echo $v['uid'];?>,'<?php echo $v['email'];?>');">删除</button>
                              <?php }elseif($v["is_manager"]==1){?>
                              <button class="btn btn-primary" type="button" onClick="editManage(<?php echo $v['uid'];?>,'<?php echo $v['email'];?>','<?php echo $v['password'];?>','<?php echo $v['app'];?>','<?php echo $v['game'];?>','<?php echo $v['weixin'];?>','<?php echo $v['real_name'];?>',<?php echo $v['mobile'];?>)">编辑</button>
                              <?php }?>
                            </td>
                          </tr>
                          <?php }}else{    
                              ?>
                          <tr>
                            <td colspan="5">暂时无结果</td>
                          </tr>
                          <?php }?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="14"></td>
                          </tr>
                        </tfoot>
                      </table>
                      <!--<div class="dataTables_info" id="DataTables_Table_1_info">显示 <?php echo $now;?> 总共：<?php echo $total;?></div>-->
                      <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate"><?php echo $pages;?></div>
                    </div>
                  </div>
                </div>
                <!-- widget_wrapper end --> 
              </div>
            </div>
          </div>
          <!-- content_wrapper end --> 
        </div>
        <!-- wrapper end --> 
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editManage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="manageboxTitle">编辑用户</h3>
  </div>
<div class="modal-body" style="height:450px; padding:0; overflow-y:scroll;max-height: none;">
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label">邮箱:</label>
      </div>
      <div class="span10" style="position:relative">
        <input type="text" name="manage_email"  id='manage_email' class="" />
        <input type="hidden" name="manage_email"  id='manage_userlist_id' class="" />
      </div>
    </div>
  </div>
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label">密码:</label>
      </div>
      <div class="span10" style="position:relative">
        <input type="password" name="manage_password"  id='manage_password' class="" />
      </div>
    </div>
  </div>      
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label">操作应用:</label>
      </div>
       <div class="span10" style="position:relative">
        <select name="choseApp" class="app_select" id="manage_app" multiple="true" data-placeholder="选择可操作应用" style="width: 350px;">
          <option value=""></option>
          <option value="all">所有权限</option>
          <?php if($appConfigList){
                    foreach($appConfigList as $k=>$v){?>
                        <option value="<?php echo $k;?>"><?php echo $v["app_name"]."(".$v["app_version"].")";?></option>
          <?php     }          
                }?>
        </select>
      </div>
    </div>
  </div>
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label">操作游戏:</label>
      </div>
       <div class="span10" style="position:relative">
        <select name="chosegame" class="game_select" id="manage_game" multiple="true" data-placeholder="选择可操作游戏" style="width: 350px;">
          <option value=""></option>
          <option value="all">所有权限</option>
          <?php if($gameList){
                    foreach($gameList as $val){?>
                        <option value="<?php echo $val['game_id'];?>"><?php echo $val["game_name"];?></option>
          <?php }}?>
        </select>
      </div>
    </div>
  </div>
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label">操作微信:</label>
      </div>
       <div class="span10" style="position:relative">
        <select name="choseweixin" class="weixin_select" id="manage_weixin" multiple="true" data-placeholder="选择可操作微信" style="width: 350px;">
          <option value=""></option>
          <option value="all">所有权限</option>
          <?php if($weixinList){
                    foreach($weixinList as $val){?>
                        <option value="<?php echo $val['site_id'];?>"><?php echo $val["name"];?></option>
          <?php }}?>
        </select>
      </div>
    </div>
  </div> 
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label">真实姓名:</label>
      </div>
      <div class="span10" style="position:relative">
        <input type="text" name="manage_real_name"  id='manage_real_name' class="" />
      </div>
    </div>
  </div>
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label">手机:</label>
      </div>
      <div class="span10" style="position:relative">
        <input type="text" name="manage_mobile"  id='manage_mobile' class="" />
      </div>
    </div>
  </div>
 </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary deleteNotice"  onClick="saveManage('/manage/muser/save_manage_userlist');">保存编辑</button>
  </div>
</div>
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">提示</h3>
  </div>
  <div class="modal-body">
    <h4>是否要删除</h4>
    <p id="deleteTite"></p>
    <p>该条记录，删除后此条记录将无法组装数据。</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary deleteNotice"  onClick="delectUser('/manage/muser/deleteUser');" id="deleteBtn">确认删除</button>
  </div>
</div>
<div class="modal fade" id="lockUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">提示</h3>
  </div>
  <div class="modal-body">
    <h4 id="islockTite">是否要锁定</h4>
    <p id="lockTite"></p>
   
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary lockuser"  onClick="lockUser('/manage/muser/lockUser');" id="managelockBtn">确认</button>
  </div>
</div>
<script type="text/javascript">
function showManageDelete(id,email){
	$("#deleteTite").html(email);
	$("#deleteBtn").attr("onClick","delectUser("+id+",'/manage/muser/deleteUser');");
	$("#deleteUser").modal("show");
}

function showManageLock(id,is_lock,email){
        var locktip = "";
        if(is_lock == 1)
        {
            locktip = '是否要解锁';
        }else if(is_lock==0)
        {
            locktip = '是否要锁定';
        }
        $("#lockTite").html(email);
	$("#islockTite").html(locktip);      
	$("#managelockBtn").attr("onClick","lockUser("+id+","+is_lock+",'/manage/muser/lockUser');");               
	$("#lockUser").modal("show");
}

function manageSelAll(){
    $('input:checkbox').each(function() {

      $(this).attr('checked', true);

     });
}

function manageSelNo(){
    $('input:checkbox').each(function() {

      $(this).attr('checked', false);

     });
}
function checkMuser()
{
    var name = $("#check_muser").val();
 
    window.location.href = "/manage/muser/index/0/?name="+name;
}
</script>