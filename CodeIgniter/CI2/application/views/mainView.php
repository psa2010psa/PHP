<div class="contentainer_wrapper">
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="content_wrapper" style=" width:100%">
          <div class="contents">
            <div class="row-fluid">
              <div class="span6">
                <div class="ico_16_dashboard content_header">
                  <h3>选择游戏</h3>
                  <span>选择游戏进入管理界面</span> </div>
              </div>
            </div>
            <div class="separator"> <span></span> </div>
            <div class="row-fluid">
              <div class="ui_action_element_list">
          <?php if($data){           
              $numArr = array(1,5,9,13,17,21,25,29,33);
              foreach($data as $k=>$v){
                  $n = $k+1;
                  $style = "";
                  if($k > 0){
                     if(in_array($n, $numArr)){
                        $style = "margin-left: 0;";//每4个换行左对齐
                     } 
                  }
                  
                  ?>
                <div class="span3 responsive" data-tablet="span6" data-desktop="span3" style="<?php echo $style;?>">
                  <div class="dashboard-stat blue">
                    <div class="visual"><img src="<?php echo $v["logo_path"];?>"> </div>
                    <div class="details">
                      <div class="number"> <?php echo $v["app_name"];?><?php if($v["app_version"]){?><font size="5">(<?php echo $v["app_version"];?>)</font><?php }?></div>
                      <div class="desc"> 管理工具 </div>
                    </div>
                    <a class="more" href="<?php echo $v["path"];?>">进入工具中心 <i class="m-icon-swapright m-icon-white"></i> </a> 
                  </div>
                </div>
                <?php }} ?>
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