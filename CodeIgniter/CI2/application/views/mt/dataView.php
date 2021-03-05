<?php include "headerNavView.php";?>
<div class="contentainer_wrapper">
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="wrapper"> 
          <!-- sidebar_navigation start -->
          <div class="sidebar_navigation gradient">
            <ul>
              <li  data-original-title="查询" class="tip-right"> <a href="/mt/entry" class="icos_panel"> <span class="tab_label">查询</span> <span class="tab_info">SELECT</span> </a> </li>
              <li  data-original-title="渠道" class="tip-right"> <a href="/mt/entry/channel" class="icos_panel"> <span class="tab_label">渠道</span> <span class="tab_info">CHANNEL</span> </a> </li>
              <li  data-original-title="数据" class="active tip-right"> <a href="/mt/entry/dataIndex" class="icos_panel"> <span class="tab_label">数据</span> <span class="tab_info">DATA</span> </a> </li>
              <li  data-original-title="各种入口" class="tip-right"> <a href="/mt/entry/entryUrl" class="icos_panel"> <span class="tab_label">各种入口</span> <span class="tab_info">SOME ENTRY</span> </a> </li>
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
                    <h3>数据</h3>
                    <span>DATA</span> </div>
                </div>
              
              </div>
              <div class="separator"> <span></span> </div>
              <div class="row-fluid">
                <div class="span12">
                  <ul class="breadcrumb">
                    <li><a href="/mt/main">MT-运营工具</a><span class="divider">&gt;</span></li>
                    <li class="active">入口工具 <span class="divider">&gt;</span></li>
                    <li class="active">数据</li>
                  </ul>
                  <!-- breadcrumb end --> 
                </div>
              </div>
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget_wrapper">
                    <div class="widget_header">
                      <div class="widget_header_option">
                        <h3></h3>
                      </div>
                    </div>
                    <div class="widget_content no-padding">
                      <table width="100%" cellspacing="0" cellpadding="0" class="default_table selectable_table">
                        <thead>
                          <tr>
                            <td></td>
                            <td><?php if(!$userLimit && !in_array(3, $userLimit)){
                                    }else{?><a href="http://boss.locojoy.com/" target="_blank">BOSS后台</a>
                                    <?php }?>
                            </td>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                          <tr>
                            <td colspan="5"></td>
                          </tr>
                        </tfoot>
                      </table>
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
</div>