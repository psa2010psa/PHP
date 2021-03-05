<link href="/resource/js/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/resource/js/umeditor/umeditor.config.js"></script>
<script type="text/javascript" src="/resource/js/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/resource/js/mt/notice.js"></script>
<script type="text/javascript" src="/resource/js/pageinate.js"></script>
<link href="/resource/css/pages.css" rel="stylesheet" type="text/css">
<?php include "headerNavView.php";?>
<div class="contentainer_wrapper">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="wrapper"> 
        <!-- sidebar_navigation start -->
        <div class="sidebar_navigation gradient">
          <ul>
            <li  data-original-title="公告系统" class="tip-right"> <a href="/mt/notice" class="i_notice"> <span class="tab_label">公告系统</span> <span class="tab_info">Notice System</span> </a> </li>
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
                <button class="btn btn-large btn-primary" type="button" style="float:right; margin-bottom:10px;" onclick="window.location.href='/mt/notice/noticeList'">返回列表</button>
              </div>
            </div>
            <div class="separator"> <span></span></div>
            <div class="row-fluid">
              <div class="span12">
                <ul class="breadcrumb">
                  <li><a href="/mt/main">MT-运营工具</a><span class="divider">&gt;</span></li>
                  <li class="active">公告系统 <span class="divider">&gt;</span></li>
                  <li class="active">公告库管理</li>
                </ul>
                <!-- breadcrumb end --> 
              </div>
            </div>
            <div class="" style="float:left;min-width: 800px;max-width: 900px;height: 25px;margin-bottom:10px; font-size:12px; color:#0055cc; font-weight:bold;"> 发送服务器：
              <?php if($hasChoseServer) {foreach($hasChoseServer as $v){ echo "[".$v["server_name"]."] ";}}?>
            </div>
            <div class="" style="float:right;margin-bottom:10px;height: 25px;">
              <a href="#"  rel="tooltip"   style="float:right;" onclick="chanageList(1)"><img data-original-title="Search" src="/resource/images/glyphicons_027_search.png"/></a>
              <input type="text" id="search_article" style="float:right;margin-right:10px;"/>
            </div>
            <div class="row-fluid" id="choseNoticeBox" >
              <div class="span6">
                <div class="widget_wrapper">
                  <div class="widget_header">
                    <h3 class="icos_panel">公告面板</h3>
                  </div>
                  <div class="widget_content" id="hasChose">
                    <ul class="hasChoseBox">
                      <?php if($noticeHasChose){ foreach($noticeHasChose as $v){?>
                      <li id="h<?php echo $v["id"]?>"><font color="<?php echo $v["title_color"]?>"><?php echo $v["title"]?></font>
                        <div class="btn-group listBtn">
                          <button class="btn btn-primary">操作</button>
                          <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" onclick="topSort(<?php echo $v["id"]?>);">置顶</a></li>
                            <li><a href="javascript:void(0)" onclick="sortArray(-1,<?php echo $v["id"]?>);">上移</a></li>
                            <li><a href="javascript:void(0)" onclick="sortArray(1,<?php echo $v["id"]?>);">下移</a></li>
                            <li><a href="javascript:void(0)" onclick="bottomSort(<?php echo $v["id"]?>);">置底</a></li>
                            <li><a href="javascript:void(0)"  onClick="buildEditNotice(<?php echo $v['id'];?>)">编辑</a></li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0)" onclick="deleteNotice(<?php echo $v["id"]?>);">删除</a></li>
                          </ul>
                        </div>
                      </li>
                      <?php }}?>
                    </ul>
                  </div>
                </div>
                <button class="btn btn-danger" type="button" onClick="clearAll()">全部清除</button>
                <button class="btn btn-primary" type="button" onClick="preview();">预览</button>
                请编辑完文章，在调整顺序，否则无法保存列表顺序
                <button class="btn btn-success" type="button" style="float:right;" onClick="choseServer();" >选区发送</button>
  <span style=" float:right; line-height:30px; margin-top:5px; margin-right:10px;"><label style="float:left; margin:0" data-original-title="选择母版之后，则每次发送成功后，会更新最新排序" rel="tooltip" class="tips icon_mail menuDrop" for="model_id">是否是母版：</label> <input type="checkbox" style="float:left;" id="is_model" value="1" name="is_model"><input type="hidden" value="<?php echo $id;?>" id="buildId"></span>
                
              </div>
              <div class="span6">
                <div class="widget_wrapper">
                  <div class="widget_header">
                    <h3 class="icos_pen">文章列表</h3>
                  </div>
                  <div class="widget_content" id="noticeBox">
                    <ul class="hasChoseBox">
                    </ul>
                  </div>
                </div>
<script type="text/javascript">
    var editor = UM.getEditor('notice-content');
<?php if($noticeArray){?>
hasChoseId = <?php echo json_encode($noticeArray);?>;
<?php }else{ ?>
hasChoseId = new Array();
<?php } ?>
$(function () {
    chanageList(1);
    $("#pages").paginate({
        count: "<?php echo $noticeCount;?>",
        start: 1,
        display: "<?php echo $noticeCount;?>",
        border: true,
        border_color: '#fff',
        text_color: '#fff',
        background_color: '#0055cc',
        border_hover_color: '#ccc',
        text_hover_color: '#000',
        background_hover_color: '#fff',
        images: false,
        mouse: 'press',
        onChange: function (page) {
            chanageList(page)
        }
    });
});
function chanageList(page) {
    var search_article = $("#search_article").val();
    $.ajax({
        url: "/mt/notice/getNoticeList",
        dataType: "json",
        type: "POST",
        data: {page: page,"search_content":search_article},
        success: function (data) {
            if (data.errorCode > 0) {
            } else {
                var dataList = data.dataList;
                var html = "";
                if(dataList)
                {
                    for (i = 0; i < dataList.length; i++) {
                        var noticeContent = dataList[i];
                        var t_color = "#000";
                        if(noticeContent.title_color){
                            t_color = noticeContent.title_color;
                        }
                        var notice_title = searchHighLight(noticeContent.title,search_article);
                        html += "<li><a href='javascript:void(0)' data-id='"+noticeContent.id+"'><font color='"+t_color+"'>" + notice_title + "</font></a><span style='display:none;'><font color='"+t_color+"'>" + noticeContent.title + "</font></span></li>";
                    }
                    $("#noticeBox>ul").html("").html(html);
                }
                
            }

        }
    });
}
$(function () {
    $("body").on("click", "#noticeBox>ul>li>a", function () {
        var id = $(this).attr("data-id");    
        var title = $(this).next().html();
        var color = $(this).children("font").attr("color");
        if(in_array(id,hasChoseId))
        {
                $("#msg").html("已经选择过了。。。。。。");
                $("#tip").modal("show");
                return false;
        }
        hasChoseId.splice(0,0,id);
        var choseNoticeHtml = '<li id="h'+id+'">' + title + '\
                      <div class="btn-group listBtn">\
                        <button class="btn btn-primary">操作</button>\
                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></button>\
                        <ul class="dropdown-menu">\
						<li><a href="javascript:void(0)" onclick="topSort('+id+');">置顶</a></li>\
                          <li><a href="javascript:void(0)" onclick="sortArray(-1,'+id+');">上移</a></li>\
                          <li><a href="javascript:void(0)" onclick="sortArray(1,'+id+');">下移</a></li>\
						  <li><a href="javascript:void(0)" onclick="bottomSort('+id+');">置底</a></li>\
                          <li><a href="javascript:void(0)" onclick="buildEditNotice('+id+');">编辑</a></li>\
                          <li class="divider"></li>\
                          <li><a href="javascript:void(0)" onclick="deleteNotice('+id+');">删除</a></li>\
                        </ul>\
                      </div>\
                    </li>';
        $("#hasChose>ul").prepend(choseNoticeHtml);
    })
});
function in_array(str,arr){
	for(i=0;i<arr.length;i++){
		if(arr[i]==str)
		{
			return true;
		}
	}
}
function clearAll(){
	$("#hasChose>ul").html("");
	hasChoseId = new Array();
}
function sortArray(type,id){
	for(i=0;i<hasChoseId.length;i++){
		if(hasChoseId[i] == id)
		{
			if(type > 0)
			{
				sp = i+1;
				$("#h"+id).next().after($("#h"+id));	
			}
			else
			{
				sp = i-1;
				$("#h"+id).prev().before($("#h"+id));
			}
			if(sp<0 || sp >=hasChoseId.length)
			{
				$("#msg").html("已经到头了~~~~");
				$("#tip").modal("show");
				return false;
			}			
			swap(hasChoseId,i,sp);
			return false;
		}
	}	
}
//数组元素交换
function swap(arr,a,b)
{
	var c = arr[a];
    arr[a] = arr[b];
    arr[b] = c;
}
function deleteNotice(id){
	$("#h"+id).remove();
	for(i=0;i<hasChoseId.length;i++){
		if(hasChoseId[i] == id)
		{
			hasChoseId.splice(i,1);
			return false;
		}
	}
}
function topSort(id){
	for(i=0;i<hasChoseId.length;i++){
		if(hasChoseId[i] == id)
		{
			hasChoseId.splice(i,1);
			hasChoseId.unshift(id);
			$("#h"+id).parent().children("li:first-child").before($("#h"+id));
		}
	}
}
function bottomSort(id){
	for(i=0;i<hasChoseId.length;i++){
		if(hasChoseId[i] == id)
		{
			hasChoseId.splice(i,1);
			hasChoseId.push(id);
			$("#h"+id).parent().append($("#h"+id));
		}
	}
}
function preview(){
	if(hasChoseId.length==0)
	{
		$("#msg").html("你还没有选择文章~~~~");
		$("#tip").modal("show");
		return false;
	}
	var src = "/mt/noticePreview?idList="+eval(hasChoseId);
	$("#previewiframe").attr("src",src);
	$("#preview").modal({height:600});
}
function choseServer(){
		if(hasChoseId.length==0)
	{
		$("#msg").html("你还没有选择文章~~~~");
		$("#tip").modal("show");
		return false;
	}
	 $("#choseServer").modal('show');
}
function saveQueen(){
	var serverList = new Array();
	$("[name='chbox'][checked]").each(function(){  
		serverList.push($(this).val());  
	}); 
	var buildId = $("#buildId").val(); 
	if(hasChoseId.length==0 || serverList.length == 0)
	{
		alert("您还没有选择文章，或者是服务器！");
		return false;
	}
	var is_model = "";
	if($("#is_model").attr("checked")=="checked")
	{
		is_model = 1;
	}
	$.ajax({
        url: "/mt/notice/saveBuild",
		type:"POST",
        data: {"idList":eval(hasChoseId),"serverList":eval(serverList),"isModel":is_model,"buildId":buildId},
        dataType: "json",
        success: function (data) {
            if (data.errorCode !=0 ) {
                alert("输入错误，请刷新后重试！");
            } else {
                $(".modal").modal('hide');
                window.location = "/mt/notice/buildNotice?id="+data.id;
            }
        },
        error: function (xhr, error, thrown) {
			window.location.reload();
        }
    })}
function buildEditNotice(id){
	 $.ajax({
        url: "/mt/notice/getNoticeInfo",
		type: "POST",
        data: {"id":id},
        dataType: "json",
        success: function (data) {
                if (data.errorCode !=0 ) {
                alert("输入错误，请刷新后重试！");
            } else {
                if(data.info.title_color)
                    {
                        $("#notice-title").css("color", data.info.title_color);
                    }else{
                        $("#notice-title").css("color", "");
                    }
                $("#notice-title").val(data.info.title);
                $("#notice-id").val(id);
                $("#notice-title-color").val(data.info.title_color);
                editor.setContent(data.info.content);//编辑器赋值
                $("#editNotice").modal('show');
            }
        },
        error: function (xhr, error, thrown) {
			window.location.reload();
        }
	 })
}
</script>
                <div id="pages"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="tip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>提示</h3>
    </div>
    <div class="modal-body">
      <h4></h4>
      <p id="msg">已经选择过该文章。</p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">确定</button>
    </div>
  </div>
</div>
<div class="modal fade" id="preview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>提示</h3>
  </div>
  <div class="modal-body" style="height:620px; padding:0; overflow:visible;">
    <iframe src="/mt/noticePreview" width="100%" height="100%" frameborder="0" style="overflow-x:none" id="previewiframe"></iframe>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">确定</button>
  </div>
</div>
<div class="modal fade" id="choseServer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>提示</h3>
  </div>
  <div class="modal-body" style="height:350px; padding:0; overflow:scroll;max-height: none;">
    <?php if($server)
        {
            $andriod_arr = array();
            $ios_arr = array();
            $pc_arr =array();
            $wp_arr = array();
            $othor_arr = array();
            foreach($server as $k=>$v)
            {
                $temp_file_arr = explode("_",$v["file_name"]);
                $str_sign = $temp_file_arr[0];
                if($str_sign=="andriod")  //安卓
                {
                    $andriod_arr[$k] = $v;
                }
                else if($str_sign=="ios") //IOS
                {
                    $ios_arr[$k] = $v;
                }
                else if($str_sign=="pc") //PC
                {
                    $pc_arr[$k] = $v;
                }
                else if($str_sign=="wp") //WP
                {
                    $wp_arr[$k] = $v;
                }
                else
                {
                    $othor_arr[$k] = $v;
                }
            }
        }
    ?>
    <?php if($andriod_arr)
       { ?>
       <div class="form_inputs clearfix">
            <div><span style="font-weight:bolder;font-size: 20px;">安卓</span></div><p></p>
      <?php foreach($andriod_arr as $a_v){?>
              <div class="row-fluid" style="float:left; width:260px;">
                <div class="span5">
                  <label class="control-label"><?php echo $a_v["server_name"];?>:</label>
                </div>
                <div class="span4">
                  <input type="checkbox" name="chbox" class="chkbox2" value="<?php echo $a_v["id"];?>" style="width:200px" <?php if($serverDataList && in_array($a_v["id"],$serverDataList)){ echo ' checked'; }?>>
                </div>
              </div>
   <?php    } ?>
       </div>  
 <?php }
    ?>
       
      
   <?php if($ios_arr)
       { ?>
      <div class="form_inputs clearfix">
            <div><span style="font-weight:bolder;font-size: 20px;">IOS</span></div><p></p>
   <?php   foreach($ios_arr as $i_v){?>
              <div class="row-fluid" style="float:left; width:260px;">
                <div class="span5">
                  <label class="control-label"><?php echo $i_v["server_name"];?>:</label>
                </div>
                <div class="span4">
                  <input type="checkbox" name="chbox" class="chkbox2" value="<?php echo $i_v["id"];?>" style="width:200px" <?php if($serverDataList && in_array($i_v["id"],$serverDataList)){ echo ' checked'; }?>>
                </div>
              </div>
   <?php    } ?>
      </div> 
 <?php }
    ?>

   <?php if($pc_arr)
       { ?>
      <div class="form_inputs clearfix">
            <div><span style="font-weight:bolder;font-size: 20px;">PC</span></div><p></p>
      <?php
           foreach($pc_arr as $p_v){?>
              <div class="row-fluid" style="float:left; width:260px;">
                <div class="span5">
                  <label class="control-label"><?php echo $p_v["server_name"];?>:</label>
                </div>
                <div class="span4">
                  <input type="checkbox" name="chbox" class="chkbox2" value="<?php echo $p_v["id"];?>" style="width:200px" <?php if($serverDataList && in_array($p_v["id"],$serverDataList)){ echo ' checked'; }?>>
                </div>
              </div>
   <?php    } ?>
      </div> 
   <?php         
        }
    ?>
      
   <?php if($wp_arr)
       { ?>
      <div class="form_inputs clearfix">
            <div><span style="font-weight:bolder;font-size: 20px;">WP</span></div><p></p>
      <?php
           foreach($wp_arr as $w_v){?>
              <div class="row-fluid" style="float:left; width:260px;">
                <div class="span5">
                  <label class="control-label"><?php echo $w_v["server_name"];?>:</label>
                </div>
                <div class="span4">
                  <input type="checkbox" name="chbox" class="chkbox2" value="<?php echo $w_v["id"];?>" style="width:200px" <?php if($serverDataList && in_array($w_v["id"],$serverDataList)){ echo ' checked'; }?>>
                </div>
              </div>
   <?php    } ?>
      </div>
   <?php
        }
    ?>

   <?php if($othor_arr)
       { ?>
      <div class="form_inputs clearfix">
            <div><span style="font-weight:bolder;font-size: 20px;">其他</span></div><p></p>
      <?php foreach($othor_arr as $o_v){?>
              <div class="row-fluid" style="float:left; width:260px;">
                <div class="span5">
                  <label class="control-label"><?php echo $o_v["server_name"];?>:</label>
                </div>
                <div class="span4">
                  <input type="checkbox" name="chbox" class="chkbox2" value="<?php echo $o_v["id"];?>" style="width:200px" <?php if($serverDataList && in_array($o_v["id"],$serverDataList)){ echo ' checked'; }?>>
                </div>
              </div>
   <?php    }?>
      </div> 
<?php  }
    ?>
      
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary" onClick="saveQueen();">确定选择</button>
  </div>
</div>
<div class="modal fade" id="editNotice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="boxTitle">编辑公告</h3>
  </div>
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label">标  题:</label>
      </div>
      <div class="span10" style="position:relative">
        <input type="text" name="regular"  class="span11" id="notice-title" style="margin:0; width:400px; float:left">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
        <ul class="dropdown-menu widget_option_dropdown settings_dropdown" style="min-width:60px;left:auto;right:5px; text-align:left;">
          <li><a href="javascript:void(0);" onClick="changeColor(1)"><i class="icon-eye-open"></i> 红色</a></li>
          <li><a href="javascript:void(0);" onClick="changeColor(2)"><i class="icon-eye-open"></i> 黑色</a></li>
          <li><a href="javascript:void(0);" onClick="changeColor(3)"><i class="icon-eye-open"></i> 蓝色</a></li>
        </ul>
        <input type="hidden" name="regular"  class="span11" id="notice-title-color">
        <input type="hidden" name="regular"  class="span11" id="notice-id">
      </div>
    </div>
  </div>
  <div class="form_inputs clearfix">
    <div class="row-fluid">
      <div class="span2">
        <label class="control-label" >公告内容:</label>
      </div>
      <div class="span10">
        <textarea style="width:450px;height:200px;" id="notice-content"></textarea>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
    <button class="btn btn-primary deleteNotice"  onClick="saveNotice('/mt/notice/saveNotice');">保存编辑</button>
  </div>
</div>
<script type="text/javascript">
$(function(){
	$("#choseServer").hide();
	})
</script>