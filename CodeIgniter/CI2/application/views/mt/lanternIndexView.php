<?php include "headerNavView.php";?>
<script type="text/javascript">
function trim(str){ //删除左右两端的空格
     return str.replace(/(^\s*)|(\s*$)/g, "");
 }
function showDelete(id,url){
    $("#contentTip").modal("show");
    $("#deleteContentBtn").attr('onclick','deleteContent('+id+',"/mt/lantern/deletetContent")');
}

function showPush(id,url){
    $("#pushTip").modal("show");
    $("#pushContentBtn").attr('onclick','pushContent('+id+',"/mt/lantern/pushContent")');
}

function pushContent(id,url){
   
    $.ajax({
        url: url,
        type:"POST",
        dataType:"json",
        data: {key_Id:id},
        success: function (data) {            
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();                
            }else if(data.errorCode == 3){                
                alert("此内容已推送过，不可对其有任何操作！");
                $(".modal").modal('hide');
                window.location.reload(); 
            }else if(data.errorCode >3){
                alert("推送失败，请刷新后重试");
            }
        },
        error: function (xhr, error, thrown) {
        }
    });
}

function deleteContent(id, url) {
  
    $.ajax({
        url: url,
        type:"POST",
        dataType:"json",
        data: {id:id},
        success: function (data) {
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();                
            } else if(data.errorCode == 1){                
                alert("已存在推送，请稍后操作");
                $(".modal").modal('hide');
                window.location.reload(); 
            }else{
                alert("删除错误，请刷新后重试");
            }
        },
        error: function (xhr, error, thrown) {
        }
    });
}
function addContent() {
 
        $("#boxTitle").html("添加内容");        
        $("#apns-content").val("");

        $("input[name*='chbox']").each(function(){
                    $(this).attr("checked",false);
                    $(this).iButton("repaint");
        });
        $("#edit_tv_id>option").each(function(index, element) {
		$(this).attr("selected",false);
        });
        $("#edit_keep_time").val("");
        $("#saveEdit").attr('onclick','saveContent("","/mt/lantern/saveContent")');       
        $("#editApns").modal("show");

   
}
function editContent(id,url) {
    
                $.ajax({
			url:url,
			type:"POST",
			dataType:"json",
			data:{id:id},
			success: function(data){
				if(data.errorCode == 0){
					//console.log(data);
                                        $("#edit_area_name").val(data.game_server_name);
                                        
                                        $("#edit_tv_name").val(data.tv_name);
                                        $("#change_keep_time").val(data.keep_time);

					$("#edit_apns_content").val(data.content);
                                        $("#editSave").attr('onclick','saveChange('+id+',"/mt/lantern/saveChange")');     
					$("#editL").modal("show");
				}			  
			}
		});
}
function saveChange(id,url)
{
    var keep_time = $("#change_keep_time").val();
    var re = /^\d+$/;  
  
    if (!re.test(keep_time))  
    {  
        alert("持续时间必须是正整数");
        return false;  
     }
    if(keep_time==0)
    {
        alert("持续时间不能是0");
        return false; 
    }
    var content = trim($("#edit_apns_content").val());
    
    if(content==""){
        alert("内容必须填写！");
        return false;
    }
    
    if(strlen(content)>300){
        alert("输入的内容不能大于300个字符!(注:一个汉字占三个字符)");
        return false;
    }

    $.ajax({
        url: url,
        type:"POST",
        data: {
            "id":id,
            "keep_time":keep_time,
            "content": content
        },
        dataType: "json",
        success: function (data) {
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();                
            }else if(data.errorCode == 4){
                alert("持续时间必须大于0！");
            } else if(data.errorCode == 5){
                alert("输入的内容不能大于300个字符！");
            }else{
                alert("输入错误，请刷新后重试！");
            }
        },
        error: function (xhr, error, thrown) {
        }
    });
}
function strlen(str) {
    var len = 0;
    for (var i=0; i<str.length; i++) { 
        var c = str.charCodeAt(i);        
        if ((c >= 0x0001 && c <= 0x007e) || (0xff60<=c && c<=0xff9f)) { 
            len++; 
        } 
        else { 
            len+=3; 
        } 
    } 
    return len;
}

function saveContent(id,url) {  
    var idList = new Array();
    $("[name='chbox'][checked]").each(function(){  
            idList.push($(this).val());  
    });
    if(idList.length<1){
        alert("请选择至少一个游戏区服！");
        return false;
    }
    var idStr = idList.join(",");
    var tv_id = $("#edit_tv_id").val();
    if(tv_id==0)
    {
        alert("TVID必须选择！");
        return false;
    }
    var keep_time = $("#edit_keep_time").val();
    var re = /^\d+$/;  
  
    if (!re.test(keep_time))  
    {  
        alert("持续时间必须是正整数");
        return false;  
    }
    if(keep_time==0)
    {
        alert("持续时间必须大于0");
        return false;
    }
    var content = trim($("#apns-content").val());
    
    if(content==""){
        alert("内容必须填写！");
        return false;
    }
    
    if(strlen(content)>300){
        alert("输入的内容不能大于300个字符!(注:一个汉字占三个字符)");
        return false;
    }

    $.ajax({
        url: url,
        type:"POST",
        data: {
            "id":id,
            "idstr": idStr,
            "tv_id":tv_id,
            "keep_time":keep_time,
            "content": content
        },
        dataType: "json",
        success: function (data) {
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();                
            }else if(data.errorCode == 1){
                alert("已存在推送，请稍后操作！");
                $(".modal").modal('hide');
                window.location.reload(); 
            } else if(data.errorCode == 5){
                alert("输入的内容不能大于300个字符！");
            }else if(data.errorCode == 4)
            {
                alert("游戏区服必须选择！");
            }else if(data.errorCode == 6){
                alert("TVID必须选择！");
            }else if(data.errorCode == 7){
                alert("持续时间不能是0！");
            }else if(data.errorCode == 13){
                var temp_alert = "以下区组已存在未推送内容或其推送内容未过期，如想立马推送新内容请先删除对应区组内容："+data.msg;
                alert(temp_alert);
                
            }else{
                alert("输入错误，请刷新后重试！");
            }
        },
        error: function (xhr, error, thrown) {
        }
    });
    
}
//查询
function checkGame()
{
    var chk = $("#selArea").val();
    window.location.href = "/mt/lantern/index?chkGameId="+chk;
}
//批量操作按钮显示
function showAll()
{
    $("input[name*='batch_chbox']").each(function(){
            $(this).attr("checked",false);
            $(this).iButton("repaint");
    });
    $("#op_batch").modal("show");
}
//批量推送
function batchPush(url){
    var idList = new Array();
    $("[name='batch_chbox'][checked]").each(function(){  
            idList.push($(this).val());  
    });
    if(idList.length<1){
        alert("请选择至少一个游戏区服！");
        return false;
    }
    var idStr = idList.join(",");

    $.ajax({
        url: url,
        type:"POST",
        dataType:"json",
        data: {idStr:idStr},
        success: function (data) {            
            if (data.errorCode == 0) {
                alert("推送成功！");
                $(".modal").modal('hide');
                window.location.reload();                
            }else if(data.errorCode >3){
                alert("推送失败，请刷新后重试");
            }
        },
        error: function (xhr, error, thrown) {
        }
    });
}
</script>
<div class="contentainer_wrapper">
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="wrapper"> 
          <!-- sidebar_navigation start -->
          <div class="sidebar_navigation gradient">
            <ul>
              <li data-original-title="走马灯内容库" class="tip-right active "> <a href="/mt/lantern" class="i_dashboard"><span class="tab_label">走马灯内容库</span> <span class="tab_info">LANTERN</span> </a> </li>
              <!--<li  data-original-title="UI Elements" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/ui_elements.html" class="i_elements tip-right"> <span class="tab_label">UI Elements</span> <span class="tab_info">UI kits</span> </a> </li>
              <li  data-original-title="Typography" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/typography.html" class="i_typography tip-right"> <span class="tab_label">Typography</span> <span class="tab_info">Your writing style</span> </a> </li>
              <li  data-original-title="Tables" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/tables.html" class="i_tables tip-right"> <span class="tab_label">Tables</span> <span class="tab_info">Tabular sheets</span> </a> </li>
              <li  data-original-title="Gallery" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/gallery.html" class="i_gallery tip-right"> <span class="tab_label">Gallery</span> <span class="tab_info">Photos &amp; Videos</span> </a> </li>
              <li  data-original-title="Grid" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/grid.html" class="i_grid tip-right"> <span class="tab_label">Grid</span> <span class="tab_info">Overviews</span> </a> </li>
              <li  data-original-title="Typography" class="tip-right"> <a data-original-title="" href="http://boltadmin.themio.net/charts.html" class="i_charts tip-right"> <span class="tab_label">Charts</span> <span class="tab_info">Visual Data</span> </a> </li>-->
            </ul>
          </div>
          <!-- sidebar_navigation end -->
          <div class="content_wrapper">
            <div class="contents">
              <div class="row-fluid">
                <div class="span6">
                  <div class="ico_16_dashboard content_header">
                    <h3>走马灯内容库</h3>
                    <span>Home</span> 
                  </div>
                </div>
                <div class="" style="margin-bottom:10px;">                    
                  <button class="btn btn-large btn-primary" type="button" onClick="addContent()" style="float:right;margin-left:10px">发布内容</button>        
                  <span style="font-size: 19px;color: #f00;float:right;margin-left:10px">游戏维护时，禁止推送！</span> 
                </div>
              </div>
              <div class="separator"> <span></span> </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget_wrapper">
                    <div class="widget_header">
                      <h3 class="icos_table">走马灯内容库</h3>
                      <div class="" style="margin-bottom:10px;">
                        <button class="btn btn-primary" type="button" onClick="showAll()" style="float:right;margin-right:10px">批量操作</button>  
                        <button class="btn btn-primary" type="button" onClick="checkGame()" style="float:right;margin-right:30px;">查询</button>                  
                        <div class="" style="float:right;margin-right:10px;">
                            游戏区服：
                                      <select name="select2" class="c_select" id="selArea" style="width: auto;">
                                          <option value="0">全部</option>
                                          <?php if($gameServerList){
                                          foreach ($gameServerList as $p=>$q){?>                            
                                              <option value="<?php echo $q["id"];?>" <?php if($chkGameId==$q["id"]){echo 'selected';}?>><?php echo $q["name"];?></option>
                                  <?php }}?>
                                      </select>
                        </div> 
                        
                      </div> 
                      
                    </div>
                    <div class="widget_content">
                      <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                        <thead>
                          <tr>
                            <td width="100">创建时间</td>
                            <td width="200">游戏区组</td>
                            <td width="50">TVID</td>
                            <td width="300">内容</td>
                            <td width="50">状态</td>
                            <td width="100">推送开始时间</td>
                            <td width="50">持续时间(分)</td>
                            <td width="100">操作人邮箱</td>
                            <td width="200">操作</td>
                          </tr>
                        </thead>
                        <tbody>
                 <?php if($data){    
                         foreach ($data as $k=>$v){
                             $temp_time = "";
                             if($v["send_start_time"]>0)
                             {
                                 $temp_time = $v["send_start_time"]+60*$v["keep_time"];
                             }
                             ?>  
                          <tr style="text-align: center;">
                              <td><?php echo date("Y-m-d H:i:s",$v["create_time"]);?></td>
                              <td><?php echo $v["game_server_name"];?></td>
                              <td><?php echo $v["game_tv_name"];?></td>
                              <td><?php echo $v["content"];?></td>
                              <td>
                              <?php
                             if($temp_time){ 
                              if(time()>$temp_time)
                              {
                                  echo "过期";
                              }else
                              {
                                  if($v["status"]==0)
                                  {
                                      echo "未推送";
                                  }else if($v["status"]==1)
                                  {
                                      echo "推送成功";
                                  }else
                                  {
                                      echo "推送失败";
                                  }
                              }
                             }else
                             {
                                 if($v["status"]==0)
                                  {
                                      echo "未推送";
                                  }else if($v["status"]==1)
                                  {
                                      echo "推送成功";
                                  }else
                                  {
                                      echo "推送失败";
                                  }
                             }
                              ?>
                              </td>
                              <td><?php if($v["send_start_time"]){echo date("Y-m-d H:i:s",$v["send_start_time"]);}?></td>
                              <td><?php if($v["keep_time"]){echo $v["keep_time"];}?></td>
                              <td><?php echo $v["op_email"];?></td>
                              <td align="center">
                             <?php
                             if($temp_time){
                              if(time()>$temp_time)
                              {
                                  echo "过期不可操作";
                              }else
                              {
                                  if($v["status"]==0)
                                  { ?>
                                      <button class="btn btn-success" type="button" onclick="showPush(<?php echo $v['id'];?>,'/mt/lantern/pushContent');">推送此内容</button>
                                      <button class="btn btn-primary" type="button" onClick="editContent(<?php echo $v['id'];?>,'/mt/lantern/getContentById');">编辑</button>
                                      <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'/mt/lantern/deteleContent');">删除</button>
                             <?php }else if($v["status"]==1)
                                  { ?>
                                      <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'/mt/lantern/deteleContent');">删除</button>
                            <?php }else
                                  { ?>
                                      <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'/mt/lantern/deteleContent');">删除</button>
                            <?php }
                              }
                             }else
                             { 
                                 if($v["status"]==0)
                                  { ?>
                                      <button class="btn btn-success" type="button" onclick="showPush(<?php echo $v['id'];?>,'/mt/lantern/pushContent');">推送此内容</button>
                                      <button class="btn btn-primary" type="button" onClick="editContent(<?php echo $v['id'];?>,'/mt/lantern/getContentById');">编辑</button>
                                      <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'/mt/lantern/deteleContent');">删除</button>
                             <?php }else if($v["status"]==1)
                                  { ?>
                                      <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'/mt/lantern/deteleContent');">删除</button>
                            <?php }else
                                  { ?>
                                      <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'/mt/lantern/deteleContent');">删除</button>
                            <?php }
                            }
                              ?>
                                  
                              </td>
                          </tr>
                   <?php }                          
                       }else{?>
                          <tr style="text-align: center;">
                            <td colspan="9">暂时无结果</td>
                          </tr>
                 <?php }?>
                        </tbody>
                      </table>
                      <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate"><?php echo $pages;?></div>
                    </div>
                  </div>
                </div>
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
  <div class="modal fade" id="editApns" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="boxTitle">编辑内容</h3>
    </div>
   <div class="modal-body" style="height:350px; padding:0; overflow-y:scroll;max-height: none;">
    <div class="form_inputs clearfix">
      <div class="row-fluid" style="float:left; width:240px;">

        <div class="span10">
          <a class="btn btn-primary" style="float:left;margin-left:10px;" href="####" name="idccheckall" id="idccheckall">全选</a>
          <a class="btn btn-primary" style="float:left;margin-left:10px;" href="####" name="idcchecknone" id="idcchecknone">全不选</a>
        </div>
      </div>
    </div> 
    <div class="form_inputs clearfix">
    <?php if($gameServerList){
     foreach($gameServerList as $a_k=>$a_v){ ?>
      <div class="row-fluid" style="float:left; width:240px;">
        <div class="span4">
            <label  class="control-label"><?php echo $a_v["name"];?>:</label>
        </div>
        <div class="span2">
          <input type="checkbox" name="chbox" class="chkbox2" value="<?php echo $a_v["id"];?>"  style="width:200px" >
        </div>
      </div>  
    <?php }}?>            
    </div>
    <div class="form_inputs clearfix">
      <div class="row-fluid">
        <div class="span2">
          <label class="control-label" >TVID选择:</label>
        </div>
        <div class="span2">
          <select style="width:auto;" id="edit_tv_id">
              <option value="0">请选择</option>
              <?php if($gameServerIdList){
                foreach ($gameServerIdList as $b_k=>$b_v){?>
                 <option value="<?php echo $b_v['id'];?>"><?php echo $b_v['name'];?></option>
              <?php }}?>
          </select>
        </div>
      </div>
    </div>
    <div class="form_inputs clearfix">
      <div class="row-fluid">
        <div class="span2">
          <label class="control-label" >持续时间(分钟):</label>
        </div>
        <div class="span2">
          <input type="text" id="edit_keep_time" />
        </div>
      </div>
    </div> 
    <div class="form_inputs clearfix">
      <div class="row-fluid">
        <div class="span2">
          <label class="control-label" >内容:</label>
        </div>
        <div class="span10">
          <textarea  rows="10" id="apns-content" style="width:430px;"></textarea>          
        </div>
      </div>
    </div>
  </div>     
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-primary" id="saveEdit" onClick="saveContent('','/mt/lantern/saveContent');">保存编辑</button>
    </div>
  </div>
<div class="modal fade" id="op_batch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>批量操作</h3>
    </div>
   <div class="modal-body" style="height:350px; padding:0; overflow-y:scroll;max-height: none;">
    <div class="form_inputs clearfix">
      <div class="row-fluid" style="float:left; width:240px;">

        <div class="span10">
          <a class="btn btn-primary" style="float:left;margin-left:10px;" href="#"  id="idccheckall2">全选</a>
          <a class="btn btn-primary" style="float:left;margin-left:10px;" href="#"  id="idcchecknone2">全不选</a>
        </div>
      </div>
    </div> 
    <div class="form_inputs clearfix">
    <?php if($gameServerList){
     foreach($gameServerList as $a_k=>$a_v){ ?>
      <div class="row-fluid" style="float:left; width:240px;">
        <div class="span4">
            <label  class="control-label"><?php echo $a_v["name"];?>:</label>
        </div>
        <div class="span2">
          <input type="checkbox" name="batch_chbox" class="chkbox2" value="<?php echo $a_v["id"];?>"  style="width:200px" >
        </div>
      </div>  
    <?php }}?>            
    </div>
    
  </div>     
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-success" id="op_send" onClick="batchPush('/mt/lantern/batchPush');">推送</button>
    </div>
  </div>
<div class="modal fade" id="editL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>编辑内容</h3>
    </div>
   <div class="modal-body" style="height:350px; padding:0; overflow-y:scroll;max-height: none;">
    
    <div class="form_inputs clearfix">
  
      <div class="row-fluid" style="float:left; width:240px;">
        <div class="span2">
            <label  class="control-label">区组:</label>
        </div>
        <div class="span2">
            <input type="text" id="edit_area_name" readonly="readonly" />
        </div>
      </div>  
               
    </div>
    <div class="form_inputs clearfix">
      <div class="row-fluid">
        <div class="span2">
          <label class="control-label" >TVID名称:</label>
        </div>
        <div class="span2">
          <input type="text" id="edit_tv_name" readonly="readonly" />
        </div>
      </div>
    </div>
    <div class="form_inputs clearfix">
      <div class="row-fluid">
        <div class="span2">
          <label class="control-label" >持续时间(分钟):</label>
        </div>
        <div class="span2">
          <input type="text" id="change_keep_time" />
        </div>
      </div>
    </div> 
    <div class="form_inputs clearfix">
      <div class="row-fluid">
        <div class="span2">
          <label class="control-label" >内容:</label>
        </div>
        <div class="span10">
          <textarea  rows="10" id="edit_apns_content" style="width:430px;"></textarea>          
        </div>
      </div>
    </div>
  </div>     
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-primary" id="editSave" onClick="saveChange();">保存编辑</button>
    </div>
  </div>
  <div class="modal fade" id="contentTip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>提示</h3>
    </div>
    <div class="modal-body">
      <h4></h4>
      <p id="msg">确定删除此内容吗？</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button class="btn btn-primary" id="deleteContentBtn" onClick="deleteContent('','/mt/lantern/deletetContent');">确定</button>
    </div>
  </div>
  <div class="modal fade" id="pushTip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>提示</h3>
    </div>
    <div class="modal-body">
      <h4></h4>
      <p id="msg">确定推送此内容吗？</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button class="btn btn-primary" id="pushContentBtn" onClick="pushContent('','/mt/lantern/pushContent');">确定</button>
    </div>
  </div>
<script type="text/javascript">
$('#idccheckall').click(function(){
        $("input[name*='chbox']").each(function(){
                $(this).attr("checked",true);
                $(this).iButton("repaint");
        });
 });
 $('#idcchecknone').click(function(){
       $("input[name*='chbox']").each(function(){
                $(this).attr("checked",false);
                $(this).iButton("repaint");
        });
});

$('#idccheckall2').click(function(){
        $("input[name*='batch_chbox']").each(function(){
                $(this).attr("checked",true);
                $(this).iButton("repaint");
        });
 });
 $('#idcchecknone2').click(function(){
       $("input[name*='batch_chbox']").each(function(){
                $(this).attr("checked",false);
                $(this).iButton("repaint");
        });
});
</script>