<link href="/resource/js/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/resource/js/umeditor/umeditor.config.js"></script>
<script type="text/javascript" src="/resource/js/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/resource/js/mt/notice.js"></script>
<?php include "headerNavView.php";?>
<div class="contentainer_wrapper">
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="wrapper"> 
          <!-- sidebar_navigation start -->
          <div class="sidebar_navigation gradient">
            <ul>
              <li  data-original-title="公告系统" class="active tip-right"> <a href="/mt/notice" class="i_notice "> <span class="tab_label">公告系统</span> <span class="tab_info">Notice System</span> </a> </li>
              <li  data-original-title="公告管理" class="tip-right"> <a href="/mt/notice/noticeList" class="i_notice"> <span class="tab_label">公告库</span> <span class="tab_info">Notice  Manage</span> </a> </li>
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
                  <button class="btn btn-large btn-primary" type="button" onclick="window.location.href='/mt/notice/buildNotice'" style="float:right; ">公告库管理</button>
                  <button class="btn btn-large btn-primary" type="button" onClick="editNotice()" style="float:right;margin-right:10px;">添加新公告</button>
                </div>
              </div>
              <div class="separator"> <span></span> </div>
              <div class="row-fluid">
                <div class="span12">
                  <ul class="breadcrumb">
                    <li><a href="/mt/main">MT-运营工具</a><span class="divider">&gt;</span></li>
                    <li class="active">公告系统 <span class="divider">&gt;</span></li>
                    <li class="active">公告库</li>
                  </ul>
                  <!-- breadcrumb end --> 
                </div>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget_wrapper">
                    <div class="widget_header">
                      <div class="widget_header_option">
                        <h3>公告库</h3>
                      </div>
                    </div>
                    <div class="widget_content no-padding">
                      <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                        <thead>
                          <tr>
                            <td></td>
                            <td width="200">发布时间</td>
                            <td width="500">公告标题</td>
                            <td>公告内容</td>
                            <td width="200">操作</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                      if($data){
                      foreach($data as $k=>$v){
                      ?>
                          <tr style="text-align: center;">
                            <td></td>
                            <td><?php echo date("Y-m-d H:i:s",$v["create_time"]);?></td>
                            <td><a href="/mt/notice/buildNotice/"><font color="<?php if($v["title_color"]){echo $v["title_color"];}else{ echo "#000";}?>"><?php echo $v["title"];?></font></a></td>
                            <td><?php echo utf_substr(strip_tags(htmlspecialchars_decode($v["content"])),90);?>.....</td>
                            <td><button class="btn btn-primary" type="button" onClick="editNotice(<?php echo $v['id'];?>,'/mt/notice/getNoticeInfo')">编辑</button>
                              <button class="btn btn-danger" type="button" onClick="showDelete(<?php echo $v['id'];?>,'<?php echo $v['title'];?>');">删除</button></td>
                          </tr>
                          <?php }}else{?>
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
  <div class="modal fade" id="deleteNotice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: block;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabel">提示</h3>
    </div>
    <div class="modal-body">
      <h4>是否要删除</h4>
      <p id="deleteTite"><?php echo $v["title"];?> 该条记录，删除后此条记录将无法组装数据。</p>
    </div>
    <div class="modal-footer">
      <button class="btn" data-dismiss="modal" aria-hidden="true">取消</button>
      <button class="btn btn-primary deleteNotice"  onClick="delectNotice('/mt/notice/delete');" id="deleteBtn">确认删除</button>
    </div>
  </div>
</div>
<script type="text/javascript">
var editor = UM.getEditor('notice-content');
function showDelete(id,title){
	$("#deleteTite").html(title);
	$("#deleteBtn").attr("onClick","delectNotice("+id+",'/mt/notice/delete');");
	$("#deleteNotice").modal("show");
}
</script>