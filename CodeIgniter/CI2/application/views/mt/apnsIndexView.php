<?php include "headerNavView.php";?>
<script type="text/javascript">
function trim(str){ //删除左右两端的空格
     return str.replace(/(^\s*)|(\s*$)/g, "");
 }
function showDelete(id,url){
    $("#contentTip").modal("show");
    $("#deleteContentBtn").attr('onclick','deleteContent('+id+',"/mt/apns/deletetContent")');
}

function showPush(id,url){
    $("#pushTip").modal("show");
    $("#pushContentBtn").attr('onclick','pushContent('+id+',"/mt/apns/pushContent")');
}

function pushContent(id,url){
   
    $.ajax({
        url: url,
        type:"POST",
        dataType:"json",
        data: {id:id},
        success: function (data) {            
            if (data.errorCode == 0) {
                $(".modal").modal('hide');
                window.location.reload();                
            }else if(data.errorCode == 1){                
                alert("已存在推送，请稍后操作");
                $(".modal").modal('hide');
                window.location.reload(); 
            }else if(data.errorCode == 2){                
                alert("此内容正在推送，请稍后操作");
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
function editContent(id,url) {
    if (!id) {
        $("#boxTitle").html("添加内容");        
        $("#apns-content").val("");

        $("input[type='radio']").each(function(n,value) {
            $("input[type='radio']").eq(n).attr("checked", false);
        });
    
       // $(".chkbox10").iButton({className: "enabled_disabled", labelOn: "选择", labelOff: "取消", easing: "swing"});
        $("#saveEdit").attr('onclick','saveContent("","/mt/apns/saveContent")');       
        $("#editApns").modal("show");

    } else {
		$.ajax({
			url:url,
			type:"POST",
			dataType:"json",
			data:{id:id},
			success: function(data){
				if(data.errorCode == 0){
					//console.log(data);
                                        var typeStr = data.type;
                                        var typeArr = typeStr.split('|');
                                        var str = typeArr[1];
                                        $("#"+str).attr("checked",true);
                                        //console.log(typeArr[1]);
                                        
					$("#boxTitle").html("编辑公告");
					
					$("#apns-content").val(data.content);
                                        $("#saveEdit").attr('onclick','saveContent('+id+',"/mt/apns/saveContent")');     
					$("#editApns").modal("show");
				}			  
			}
		});
       
    }
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
    var type=$('input[name="chbox"]:checked').val();
    var content = trim($("#apns-content").val());
    
    if(content==""){
        alert("内容必须填写！");
        return false;
    }
    if(!type){
        alert("类型必须选择！");
        return false;
    }
    if(strlen(content)>75){
        alert("输入的内容不能大于75个字符!(注:一个汉字占三个字符)");
        return false;
    }
    if(type=="wp"){
        if(strlen(content)>60){
            alert("wp类型下输入的内容不能大于60个字符!(注:一个汉字占三个字符)");
            return false;
        }
    }
     
    $.ajax({
        url: url,
        type:"POST",
        data: {"id":id,"type": type,"content": content},
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
                alert("输入的内容不能大于75个字符！");
            }else if(data.errorCode == 4)
            {
                alert("类型必须选择！");
            }else if(data.errorCode == 6){
                alert("wp类型下输入的内容不能大于60个字符！");
            }else if(data.errorCode == 7){
                alert("此内容正在推送，请稍后操作！");
                window.location.reload(); 
            }else if(data.errorCode == 8){
                alert("此内容已推送过，不可对其有任何操作！");
                window.location.reload(); 
            }else{
                alert("输入错误，请刷新后重试！");
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
              <li data-original-title="推送内容库" class="tip-right active "> <a href="/mt/apns" class="i_dashboard"><span class="tab_label">推送内容库</span> <span class="tab_info">APNS</span> </a> </li>
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
                    <h3>推送内容库</h3>
                    <span>Home</span> 
                  </div>
                </div>
                <div class="" style="margin-bottom:10px;">                    
                  <button class="btn btn-large btn-primary" type="button" onClick="editContent()" style="float:right;margin-left:10px">发布内容</button>        
                  <span style="font-size: 19px;color: #f00;float:right;margin-left:10px">游戏维护时，禁止推送！</span> 
                </div>
              </div>
              <div class="separator"> <span></span> </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget_wrapper">
                    <div class="widget_header">
                      <h3 class="icos_table">推送文章库</h3>
                    </div>
                    <div class="widget_content">
                      <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                        <thead>
                          <tr>
                            <td width="100">创建时间</td>
                            <td width="100">类型</td>
                            <td width="200">内容</td>
                            <td width="100">状态</td>
                            <td width="200">推送开始时间</td>
                            <td width="200">推送结束时间</td>
                            <td width="200">操作</td>
                          </tr>
                        </thead>
                        <tbody>
                 <?php if($data){    
                         foreach ($data as $k=>$v){ ?>  
                          <tr>
                              <td align="center"><?php echo date("Y-m-d H:i:s",$v["create_time"]);?></td>
                              <td align="center"><?php echo $v["type_name"];?></td>
                              <td align="center"><?php echo $v["content"];?></td>
                              <td align="center">
                              <?php if($v["status"]==1){ ?>
                                  正在推送
                                  <img  src="/resource/images/loading.gif">
                              <?php }else if($v["status"]==3){ ?>
                                  推送失败
                              <?php }else if($v["status"]==2){?>
                                  推送成功
                              <?php }?>
                              </td>
                              <td align="center"><?php if($v["send_start_time"]){echo date("Y-m-d H:i:s",$v["send_start_time"]);}?></td>
                              <td align="center"><?php if($v["send_end_time"]){echo date("Y-m-d H:i:s",$v["send_end_time"]);}?></td>
                              <td align="center">
                                  <?php if($pushFlag==0){
                                            if($v["status"]==2){?>
                                                此内容已推送过，不可操作
                                  <?php     }else if($v["status"]==1){ ?>
                                                此内容正在推送，不可操作，请等待
                                      <?php }else{ ?>
                                                <button class="btn btn-success" type="button" onclick="showPush(<?php echo $v['id'];?>,'/mt/apns/pushContent');">推送此内容</button>
                                                <button class="btn btn-primary" type="button" onClick="editContent(<?php echo $v['id'];?>,'/mt/apns/getContentById');">编辑</button>
                                                <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'/mt/apns/deteleContent');">删除</button>
                                   <?php    }
                                        }else if($pushFlag==1){?>
                                  已存在推送信息，不可操作，请等待
                                  <?php }else if($pushFlag==2){?>
                                  检测cache超时，不可操作
                                  <?php }?>
                              </td>
                          </tr>
                   <?php }                          
                       }else{?>
                          <tr>
                            <td colspan="7">暂时无结果</td>
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
      <h3 id="boxTitle">编辑公告</h3>
    </div>    
    <div class="form_inputs clearfix">
    <?php if($type){//var_dump($type);
     foreach($type as $t_k=>$t_v){ ?>
      <div class="row-fluid" style="float:left; width:240px;">
        <div class="span3">
          <label class="control-label"><?php echo $t_v["type_name"];?>:</label>
        </div>
        <div class="span2">
          <input type="radio" name="chbox" id="<?php echo $t_v["type"];?>" class="chkbox2" value="<?php echo $t_v["type"];?>"  style="width:200px" >
        </div>
      </div>  
    <?php }}?>            
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
      
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-primary" id="saveEdit" onClick="saveContent('','/mt/apns/saveContent');">保存编辑</button>
    </div>
  </div>
  <div class="modal fade" id="contentTip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>提示</h3>
    </div>
    <div class="modal-body">
      <h4></h4>
      <p id="msg">确定删除此文章吗？</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button class="btn btn-primary" id="deleteContentBtn" onClick="deleteContent('','/mt/apns/deletetContent');">确定</button>
    </div>
  </div>
  <div class="modal fade" id="pushTip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>提示</h3>
    </div>
    <div class="modal-body">
      <h4></h4>
      <p id="msg">确定推送此文章吗？</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
        <button class="btn btn-primary" id="pushContentBtn" onClick="pushContent('','/mt/apns/pushContent');">确定</button>
    </div>
  </div>