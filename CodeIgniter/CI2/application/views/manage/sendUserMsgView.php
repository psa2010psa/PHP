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
              <li  data-original-title="用户列表" class="tip-right"> <a href="/manage/muser" class="i_forms"> <span class="tab_label">用户列表</span> <span class="tab_info">User</span> </a> </li>
              <li  data-original-title="用户消息列表" class="active tip-right"> <a href="/manage/muserMsg" class="i_notice"> <span class="tab_label">用户消息列表</span> <span class="tab_info">User Message</span> </a> </li>
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
                    <h3>用户消息列表</h3>
                    <span>User Message</span> </div>
                </div>
                  <div class="" style="margin-bottom:10px;">
                <button class="btn btn-large btn-primary" type="button" onClick="editMuserMsg('','/manage/muserMsg/saveUserMsg')" style="float:right;margin-right:10px;">添加新消息</button>
              </div>
              </div>
              <div class="separator"> <span></span> </div>
              <div class="row-fluid">
                <div class="span12">
                  <ul class="breadcrumb">
                    <li><a href="/manage/main">管理-后台管理</a><span class="divider">&gt;</span></li>
                    <li class="active">用户消息列表</li>
                  </ul>
                  <!-- breadcrumb end --> 
                </div>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget_wrapper">
                    <div class="widget_header">
                      <div class="widget_header_option"> 
                        <h3>用户消息表</h3>
                      </div>
                    </div>
                    <div class="widget_content no-padding">
                      <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                        <thead>
                          <tr>
                            <td width="100">创建时间</td>
                            <td width="100">发送时间</td>
                            <td width="200">发送内容</td>
                            <td width="50">消息类型</td>
                            <td width="150">操作</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                      if($data){
                         
                        foreach($data as $k=>$v){
                    ?>
                          <tr style="text-align:center;">
                            <td><?php if($v["create_time"]){ echo date("Y-m-d H:i:s",$v["create_time"]);}?></td>
                            <td><?php if($v["send_time"]){ echo date("Y-m-d H:i:s",$v["send_time"]);}?></td>
                            <td><?php echo $v["content"];?></td>
                            <td>
                                
                                <?php if($v["type"]==1){ ?>
                                           <span style="color:#F00;">系统</span> 
                                <?php }else if($v["type"]==0){ ?>
                                           <span>普通</span> 
                                <?php }?>
                            </td>
                            <td>
                              <button class="btn btn-primary" type="button" onClick="editMuserMsg(<?php echo $v["id"];?>,'/manage/muserMsg/saveUserMsg',<?php echo $v["type"]?>,'<?php echo $v["content"]?>')">编辑</button>
                              
                              <?php
                              //系统消息发送按钮不可用；禁用的消息发送按钮不可用
                              if($v["is_delete"]==0){
                                        if($v["type"]==0){
                              ?>
                              <button class="btn btn-success" type="button" onClick="showMuserMsgSend(<?php echo $v["id"];?>,'/manage/muserMsg/sendUserMsg');">发送</button>
                                  <?php }else{?>
                              <button class="btn btn-success disabled" type="button">发送</button>
                                  <?php }?>
                              <button class="btn btn-danger" type="button" onClick="showMuserMsgDelete(<?php echo $v["id"];?>,'/manage/muserMsg/deleteUserMsg');">禁用</button>
                              <?php }else if($v["is_delete"]==1){ ?>
                              <button class="btn btn-success disabled" type="button">发送</button>
                              <button class="btn btn-primary" type="button" onClick="showMuserMsgDelete(<?php echo $v["id"];?>,'/manage/muserMsg/startMsg');">启用</button>
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
                            <td colspan="5"></td>
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

<div class="modal fade" id="editMuserMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="editMuserMsgTitle">添加消息</h3>
  </div>
  <div class="form_inputs clearfix">
      <div class="row-fluid" style="float:left; width:240px;">
        <div class="span3">
          <label class="control-label">系统:</label>
        </div>
        <div class="span2">
          <input type="radio" name="chbox" id="message-system" class="chkbox2" value="1"  style="width:200px" >
        </div>
      </div>
      <div class="row-fluid" style="float:left; width:240px;">
        <div class="span3">
          <label class="control-label">普通:</label>
        </div>
        <div class="span2">
          <input type="radio" name="chbox" id="message-normal" class="chkbox2" value="0"  style="width:200px" >
        </div>
      </div>
  </div>
  <div class="form_inputs clearfix">
      <div class="row-fluid">
        <div class="span2">
          <label class="control-label" >消息内容:</label>
        </div>
        <div class="span10">
          <textarea style="width:400px;height:200px;" id="message-content"></textarea>
        </div>
      </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary"  onClick="saveMuserMsg('/manage/muserMsg/saveUserMsg');" id="saveMuserMsgBtn">保存编辑</button>
  </div>
</div>
<div class="modal fade" id="showTip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="tipTitle1">提示</h3>
  </div>
  <div class="modal-body">
    <h4 id="tipTitle2">是否要删除此条消息</h4>
    <p id="tipBody"></p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary lockuser"   id="tipBtn">确认</button>
  </div>
</div>