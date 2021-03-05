<script type="text/javascript" src="/resource/js/notice.js"></script>
<?php include "headerNavView.php";?>
<div class="contentainer_wrapper">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="wrapper"> 
        <!-- sidebar_navigation start -->
        <div class="sidebar_navigation gradient">
          <ul>
            <li  data-original-title="公告系统" class=" tip-right"> <a href="/mt/notice" class="i_notice"> <span class="tab_label">公告系统</span> <span class="tab_info">Notice System</span> </a> </li>
            <li  data-original-title="公告管理" class="tip-right active"> <a href="/mt/notice/noticeList" class="i_notice"> <span class="tab_label">公告库</span> <span class="tab_info">Notice  Manage</span> </a> </li>
            <li  data-original-title="公告定时" class="tip-right"> <a href="/mt/notice/noticeTiming" class="i_notice"> <span class="tab_label">公告定时</span> <span class="tab_info">Notice  Timing</span> </a> </li>
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
              <div class="span5">
                <div class="ico_16_dashboard content_header">
                  <h3>公告系统</h3>
                  <span>Notice System</span> </div>
              </div>
              <div class="" style="margin-bottom:10px;">
                <button class="btn btn-large btn-primary" type="button" onClick="window.location.href='/mt/notice/buildNotice'" style="float:right;margin-left:10px">公告库管理</button>
               <button class="btn btn-large btn-warning" type="button" onClick="showAll()" style="float:right;margin-left:10px">全区公告发布</button>
               <button class="btn btn-large btn-info" type="button" onClick="window.location.href='/mt/notice/insertBuildNotice'" style="float:right;margin-left:10px">全区公告插入</button>
              
              </div>
            </div>
            <div class="separator"> <span></span></div>
            <div class="row-fluid">
              <div class="span12">
                <ul class="breadcrumb">
                  <li><a href="/mt/main">MT-运营工具</a><span class="divider">&gt;</span></li>
                  <li class="active">公告系统 <span class="divider">&gt;</span></li>
                  <li class="active">公告管理</li>
                </ul>
                <!-- breadcrumb end --> 
              </div>
            </div>
              <div class="row-fluid">
              <div class="span12">
                <div class="widget_wrapper">
                  <div class="widget_header">
                    <div class="widget_header_option">
                      <h3>公共母版库</h3>
                    </div>
                  </div>
                  <div class="widget_content no-padding">
                    <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                      <thead>
                        <tr>
                          <td width="100">发布时间</td>
                          <td width="100">生成时间</td>
                          <td width="500">发送渠道</td>
                          <td width="100">是否在定时</td>
                          <td width="100">是否是模板</td>
                          <td width="300">操作</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                      if($modelList){
                      foreach($modelList as $k=>$v){
                      ?>
                        <tr>
                          <td align="center"><?php echo date("Y-m-d H:i:s",$v["create_time"]);?></td>
                          <td align="center" id="date<?php echo $v["id"];?>2"><?php if($v["send_time"]>0){ echo date("Y-m-d H:i:s",$v["send_time"]);}?></td>
                          <td><?php echo $v["serverName"];?></td>
                          <td align="center">
                            <?php if($v["flag"]){
                              echo "是";
                            }else{
                              echo "否";
                            }?>
                          </td>
                          <td align="center"><?php if($v["is_model"] == 1){ echo "<font color='#FF0000'>公共模板</font>";}?></td>
                          <td align="center"><button class="btn btn-info" type="button" onClick="preview(<?php echo $v["id"];?>);">预览</button>
                            &nbsp;&nbsp;
                            <button class="btn btn-primary btn-small" type="button" onclick="window.location.href='/mt/notice/buildNotice?id=<?php echo $v["id"];?>'">编辑</button>
                            &nbsp;&nbsp;
                            <button class="btn btn-success" type="button" onClick="openSendTip(<?php echo $v["id"];?>);">生成公告</button>
                              &nbsp;&nbsp;
                            <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'<?php echo $v['serverName'];?>');">删除</button></td>
                        </tr>
                        <?php }}else{?>
                        <tr>
                          <td colspan="6">暂时无结果</td>
                        </tr>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="6"></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
                <!-- widget_wrapper end -->
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
                <div class="widget_wrapper">
                  <div class="widget_header">
                    <div class="widget_header_option">
                      <h3>公告管理</h3>
                    </div>
                  </div>
                  <div class="widget_content no-padding">
                    <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                      <thead>
                        <tr>
                          <td width="200">发布时间</td>
                          <td width="200">推送时间</td>
                          <td width="500">发送渠道</td>
                          <td width="200">操作</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                      if($data){
                      foreach($data as $k=>$v){
                      ?>
                        <tr>
                          <td align="center"><?php echo date("Y-m-d H:i:s",$v["create_time"]);?></td>
                          <td align="center" id="date<?php echo $v["id"];?>"><?php if($v["send_time"]>0){ echo date("Y-m-d H:i:s",$v["send_time"]);}?></td>
                          <td><?php echo $v["serverName"];?></td>
                          <td><button class="btn btn-info" type="button" onClick="preview(<?php echo $v["id"];?>);">预览</button>
                            &nbsp;&nbsp;
                            <button class="btn btn-primary btn-small" type="button" onclick="window.location.href='/mt/notice/buildNotice?id=<?php echo $v["id"];?>'">编辑</button>
                            &nbsp;&nbsp;
                            <button class="btn btn-success" type="button" onClick="openSendTip(<?php echo $v["id"];?>);">生成公告</button>
                             &nbsp;&nbsp;
                            <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'<?php echo $v['serverName'];?>');">删除</button></td>
                        </tr>
                        <?php }}else{?>
                        <tr>
                          <td colspan="4">暂时无结果</td>
                        </tr>
                        <?php }?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="4"></td>
                        </tr>
                      </tfoot>
                    </table>
                    <!--<div class="dataTables_info" id="DataTables_Table_1_info">显示 <?php echo $now;?> 总共：<?php echo $total;?></div>-->
                    <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate"><?php echo $pages;?></div>
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
<div class="modal fade" id="tip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>提示</h3>
  </div>
  <div class="modal-body" style="padding:0; overflow:visible;">
    <div class="form_inputs clearfix" id="msg"> </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="sendBtn">确定发送</button>
  </div>
</div>
<div class="modal fade" id="makeQueen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>生成公告文件</h3>
  </div>
  <div class="modal-body" style="height:620px; padding:0; overflow:visible;">
    <div class="form_inputs clearfix">
      <iframe src="" id="sendNoticeQueen" width="100%" height="380" frameborder="0"></iframe>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
  </div>
</div>
<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>预览</h3>
  </div>
  <div class="modal-body" style="height:620px; padding:0; overflow:visible;">
    <iframe src="/mt/noticePreview" width="100%" height="100%" frameborder="0" style="overflow-x:none" id="previewiframe"></iframe>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">确定</button>
  </div>
</div>
 <div class="modal fade" id="deleteNotice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">提示</h3>
    </div>
    <div class="modal-body">
      <h4>是否要删除下列发送渠道的发布信息？？</h4>
      <p id="deleteTite"> </p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-primary deleteNotice"  onClick="delectNotice('/mt/notice/delete');" id="deleteBtn">确认删除</button>
    </div>
 </div>
 <div class="modal fade" id="showAllSend" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="boxTitle">选择公告</h3>
    </div>    
    <div class="form_inputs clearfix">
    <?php if($modelList){
     foreach($modelList as $a_k=>$a_v){ ?>
      <div class="row-fluid" style="float:left; width:240px;">
        <div class="span6">
            <label  class="tip-right" data-original-title="<?php echo $a_v["serverName"];?>"><?php echo substr($a_v["serverName"], 0,strpos($a_v["serverName"],"]")+1);?>... :</label>
        </div>
        <div class="span2">
          <input type="checkbox" name="chbox" class="chkbox2" value="<?php echo $a_v["id"];?>"  style="width:200px" >
        </div>
      </div>  
    <?php }}?>            
    </div>
    <div class="form_inputs clearfix">
      <div class="row-fluid" style="float:left; width:240px;">

        <div class="span10">
          <a class="btn btn-primary" style="float:left;margin-left:10px;" href="####" name="idccheckall" id="idccheckall">全选</a>
          <a class="btn btn-primary" style="float:left;margin-left:10px;" href="####" name="idcchecknone" id="idcchecknone">全不选</a>
        </div>
      </div>
    </div> 
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-primary" id="allSendBtn" onClick="sendAllNotice();">生成公告</button>
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
function sendNotice(id){
	$("#sendNoticeQueen").attr("src","/mt/notice/sendNotice?id="+id);
	$("#makeQueen").modal("show");
	$("#date"+id).html(CurentTime());
}

function preview(id){
	if(!id)
	{
		$("#msg").html("你还没有选择文章~~~~");
		$("#tip").modal("show");
		return false;
	}
	var src = "/mt/noticePreview?id="+id;
	$("#previewiframe").attr("src",src);
	$("#preview").modal({height:600});
}
function openSendTip(id){
	$("#msg").html("您确认发送此公告吗？？？？");
	$("#tip").modal("show");
	$("#sendBtn").attr("onClick","sendNotice("+id+");");
	
}
function showDelete(id,title){
	$("#deleteTite").html(title);
	$("#deleteBtn").attr("onClick","delectNotice("+id+",'/mt/notice/deleteBuild');");
	$("#deleteNotice").modal("show");
}

function CurentTime()
{ 
        var now = new Date();       
        var year = now.getFullYear();       //年
        var month = now.getMonth() + 1;     //月
        var day = now.getDate();            //日
       
        var hh = now.getHours();            //时
        var mm = now.getMinutes();          //分
       	var ii = now.getSeconds();
        var clock = year + "-";
       
        if(month < 10)
            clock += "0";
       
        clock += month + "-";
       
        if(day < 10)
            clock += "0";
           
        clock += day + " ";
        if(hh < 10)
            clock += "0";
        clock += hh + ":";
		
        if (mm < 10) clock += '0'; 
        clock += mm +":"; 
		if(ii < 10) clock +='0';
		clock += ii;
        return(clock); 
}
//显示所有公告列表
function showAll()
{    
    $("#showAllSend").modal("show");
    $("#allSendBtn").attr("onClick","sendAllNotice();");
}
function sendAllNotice()
{
    var idList = new Array();
    $("[name='chbox'][checked]").each(function(){  
            idList.push($(this).val());  
    }); 
    if(idList.length<1){
        alert("请选择至少一个公告！");
        return false;
    }
    var idStr = idList.join(",");
    
    $("#showAllSend").modal("hide");
    $("#sendNoticeQueen").attr("src","/mt/notice/sendAllNotice?idStr="+idStr);
    $("#makeQueen").modal("show");
    for(var i=0;i<idList.length;i++)
    {
        var id = idList[i];        
        $("#date"+id).html(CurentTime());
    }    
}
</script> 
