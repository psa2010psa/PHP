<script type="text/javascript" src="/resource/js/datepicker/WdatePicker.js"></script>
<script type="text/javascript"> 
 
function update_time(){
    $('.leaving_time').each(function(){
        var _this = $(this);
        var _this_timing = _this.data('lt');
        $.ajax({url:'/time/now', type:'post', success:function(now){
            var now = $.parseJSON(now);
            var now_time = now.now;//服务器时间
            var sys_second =  _this_timing-now_time;
            
            if(sys_second>=0){     
                var day = Math.floor((sys_second / 3600) / 24); 
                var hour = Math.floor((sys_second / 3600) % 24); 
                var minute = Math.floor((sys_second / 60) % 60); 
                var second = Math.floor(sys_second % 60); 

                var msg = day+"天"+hour+"时"+minute+"分"+second+"秒";
              
            }     
            else{     
                var msg = "时间已到";
            }
            _this.html(msg);
        }});
    });
}
$(function(){
    setInterval("update_time()", 1000);
    $('.notice_list').click(function(){
        $(this).next('.notice_detail').toggle(300);
    });
});
</script> 
<?php include "headerNavView.php";?>
<div class="contentainer_wrapper">
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="wrapper"> 
          <!-- sidebar_navigation start -->
          <div class="sidebar_navigation gradient">
            <ul>
              <li  data-original-title="公告系统" class="tip-right"> <a href="/mt/notice" class="i_notice "> <span class="tab_label">公告系统</span> <span class="tab_info">Notice System</span> </a> </li>
              <li  data-original-title="公告管理" class="tip-right"> <a href="/mt/notice/noticeList" class="i_notice"> <span class="tab_label">公告库</span> <span class="tab_info">Notice  Manage</span> </a> </li>
              <li  data-original-title="公告定时" class="active tip-right"> <a href="/mt/notice/noticeTiming" class="i_notice"> <span class="tab_label">公告定时</span> <span class="tab_info">Notice  Timing</span> </a> </li>
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
                  <button class="btn btn-large btn-primary" type="button" onClick="editNoticeTiming()" style="float:right;margin-right:10px;">添加新定时</button>
                </div>
              </div>
              <div class="separator"> <span></span> </div>
              <div class="row-fluid">
                <div class="span12">
                  <ul class="breadcrumb">
                    <li><a href="/mt/main">MT-运营工具</a><span class="divider">&gt;</span></li>
                    <li class="active">公告系统 <span class="divider">&gt;</span></li>
                    <li class="active">公告定时</li>
                  </ul>
                  <!-- breadcrumb end --> 
                </div>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget_wrapper">
                    <div class="widget_header">
                      <div class="widget_header_option">
                        <h3>公告定时列表</h3>
                      </div>
                    </div>
                    <div class="widget_content no-padding">
                      <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                        <thead>
                          <tr>
                            
                            <td width="200">创建时间</td>
                            <td>公告列表</td>
                            <td width="300">发布时间</td>
                            <td width="200">剩余时间</td>
                            <td width="200">操作</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                      if($data){                     
                      foreach($data as $k=>$v){
                      ?>
                          <tr class="notice_list" style="text-align: center;">
                            
                            <td><?php echo date("Y-m-d H:i:s",$v["create_time"]);?></td>                           
                            <td>
                                <label  class="tip-right" data-original-title="<?php echo $v["serverName"];?>"><?php echo substr($v["serverName"], 0,strpos($v["serverName"],"@"));?>... :</label>
                            </td>
                            <td><?php echo date("Y-m-d H:i:s",$v["start_time"]);?></td> 
                            <td>
                            <?php if($v["status"]==0){ ?>
                                

                                <div class="leaving_time" data-lt="<?php echo $v["start_time"];?>" >                                     
                                </div> 
                                 
                            <?php }else if($v["status"]==1)  
                                  { ?>
                                           已生成               
                            <?php  }
                            ?>
                            </td> 
                            <td>
                             <?php if($v["status"]==0){ ?>
                                <button class="btn btn-primary" type="button" onClick="editNoticeTiming(<?php echo $v['id'];?>,'/mt/notice/noticeTimingInfo','<?php echo $v["notice_id_list"];?>')">编辑</button>
                                <button class="btn btn-danger" type="button" onClick="showTimingDelete(<?php echo $v['id'];?>);">删除</button>
                             <?php } ?>
                            </td>
                          </tr>
                          <tr class="notice_detail" style="display:none;"><td colspan="6">
                                  <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                                      <thead>
                                          <tr>
                                            <td></td>
                                            <td width="200">服务器名</td>
                                            <td width="200">公告地址</td>
                                          </tr>
                                          
                                            
                                            <?php if($v["serverArray"]){    
                                        foreach($v["serverArray"] as $s_k => $s_v){
                                        ?>
                                          <tr>
                                              <td></td>
                                              <td><?php echo $s_v["name"]; ?></td><td><a href="<?php echo $s_v["html"]; ?>" target="_blank"><?php echo $s_v["html"]; ?></a></td>
                                         </tr>
                              <?php }}?>
                                         
                                      </thead>
                                  </table>
                              
                              </td>
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
  <div class="modal fade" id="editNoticeTiming" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="boxTitle">编辑公告定时</h3>
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
      <div class="row-fluid">
        <div class="span2">
          <label class="control-label" >发布时间:</label>
        </div>
        <div class="span10">
          <input class="Wdate" type="text" id="sendtime" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm'})" />
        </div>
      </div>
        <input type="hidden" name="regular"  class="span11" id="noticeTiming-id">
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-primary deleteNotice"  id="saveTimingBtn" onClick="saveNoticeTiming('/mt/notice/saveNoticeTiming');">确定</button>
    </div>
  </div>
  <div class="modal fade" id="deleteNoticeTiming" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">提示</h3>
    </div>
    <div class="modal-body">
      <h4>是否要删除</h4>
      <p id="deleteTite">该条记录删除后,定时会被取消，且公告不会发送</p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-primary deleteNotice"  onClick="delectNoticeTiming('','/mt/notice/deleteTiming');" id="deleteTimingBtn">确认删除</button>
    </div>
  </div>
</div>

<script type="text/javascript">
   
function showTimingDelete(id){
	
	$("#deleteTimingBtn").attr("onClick","delectNoticeTiming("+id+",'/mt/notice/deleteTiming');");
	$("#deleteNoticeTiming").modal("show");
}

function delectNoticeTiming(id,url)
{
    $.ajax({
        url: url,
        data: {id:id},
        dataType:"json",
        success: function (data) {         
            if (data.errorCode == 0) {              
                $(".modal").modal('hide');
                window.location.reload();
            } else {
                alert("删除错误，请刷新后重试");                
            }
        },
        error: function (xhr, error, thrown) {           
        }
    })
}
function editNoticeTiming(id,url,noticeId)
{
    if(id)
    {
        $.ajax({
            url:url,
            type:"POST",
            dataType:"json",
            data:{
                id:id
            },
            success: function(data){
                if(data.errorCode == 0){
                    var noticeTimingInfo = data.info;
                    $("#sendtime").val(noticeTimingInfo.start_time);
                   
                }			  
            }
        });
        $("#noticeTiming-id").val(id);
        $("#boxTitle").html("编辑公告定时");
	//$("#saveTimingBtn").attr("onClick","saveNoticeTiming("+id+","+url+"');");
        var noticeList = noticeId.split(",");        
        $("[name='chbox']").each(function(){              
            var nowVal = $(this).val();           
            for(i= 0;i<noticeList.length;i++){
                if(noticeList[i]==nowVal)
                {
                    $(this).attr("checked","checked");
                }
            }
        }); 
       
	$("#editNoticeTiming").modal("show");
    }else
    {        
        $("#sendtime").val("");
        $("#noticeTiming-id").val("");
        $("#boxTitle").html("添加公告定时");
	//$("#saveTimingBtn").attr("onClick","saveNoticeTiming('','"+url+"');");
	$("#editNoticeTiming").modal("show");
    }
       
}
function saveNoticeTiming(url)
{
    var id = $("#noticeTiming-id").val();
    var idList = new Array();
    $("[name='chbox'][checked]").each(function(){  
            idList.push($(this).val());  
    }); 
    if(idList.length<1){
        alert("请选择至少一个公告！");
        return false;
    }
    
    var send_time = $("#sendtime").val();
    if(send_time =="")
    {
        alert("发布时间必须填写！");
        return false;
    }

    var idStr = idList.join(",");   
    $.ajax({
        url: url,
        type:"POST",
        data: {"idList":idStr,"sendTime":send_time,"id":id},
        dataType: "json",
        success: function (data) {
            if (data.errorCode ==1 ) {
                alert("请选择至少一个公告！");
            }else if(data.errorCode ==2){
                alert("发布时间必须填写！");
            } else if(data.errorCode ==3){
                alert("发布时间必须大于当前系统时间！");
            } else if(data.errorCode ==0){
                $(".modal").modal('hide');
                window.location.reload();
            }else{
                alert("系统错误，请刷新后重试！");
            }
        },
        error: function (xhr, error, thrown) {
                alert("系统错误");
                window.location.reload();
        }
    })
}

function GetDateTime()
 {
  var d,s;
  d = new Date();
  s = d.getYear() + "-";             //取年份
  s = s + (d.getMonth() + 1) + "-";//取月份
  s += d.getDate() + " ";         //取日期
  s += d.getHours() + ":";       //取小时
  s += d.getMinutes() + ":";    //取分
  s += d.getSeconds();         //取秒
   
  return(s);  
  
 } 
</script>