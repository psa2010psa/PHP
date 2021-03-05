// JavaScript Document
var email_check  = function(email){
	var isemail=/^\w+([-\.]\w+)*@\w+([\.-]\w+)*\.\w{2,4}$/;
	if (!isemail.test(email)){
        return false;
    }else{
		return true;
	}
}
var mobile_check  = function(mobile){
    //手机号验证
    var ismobile = /^1(3|5|8)\d{9}$/;
    if(!ismobile.test(mobile)){
        return false;
    }else{
		return true;
	}
}	

//删除字符串左右两端的空格
function trim(str){ 
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
var thumbli_init = function(obj, callback){
        //obj : { src, dom, append}
        var re = new RegExp('^http://.*(png|gif|jpg)$', 'gi');
        if(re.test(obj.src)){
			var _ajax_tpl="";
			
           	_ajax_tpl = "\
                <li class='span2'>\
                    <i class='icon-remove' title='删除'></i>";
			if(obj.seticon===true){
					_ajax_tpl+="<i class='icon-picture' title='添加到封面'></i>";
			}
			if(obj.resize===true){
					_ajax_tpl+="<i class='icon-resize-full' title='裁剪'></i>";
			}
            if(obj.addcontent===true){
					_ajax_tpl+="<i class='icon-plus' title='添加到内容'></i>";
			}
			if(obj.setwhere===true){
					_ajax_tpl+="<div  style='float:left;margin:3px; height:20px'>\
                    <select  data-placeholder='请选择栏目进行查询'  class='covertype' style='width:80px;height:20px; padding:0px;'>\
                      <option value='normal' selected>通用封面</option>\
					  <option value='index_photo'>热门图片</option>\
					  <option value='index_video'>首页视频</option>\
					  <option value='photo_list'>图片列表</option>\
					  <option value='video_list'>视频列表</option>\
					  <option value='ad_index'>首页广告</option>\
					  <option value='ad_normal'>通用广告</option>\
                    </select>\
                  </div>";
			}
               
			   
			   
			   
			   _ajax_tpl+="<a href='javascript:void(0);' class='thumbnail' height='63px'>\
                        <img class='photos' src='" + obj.src +"!thumb'>\
                        </a>\
                </li>\
            ";
			
			
			
            if(obj.append === true){
                obj.dom.append(_ajax_tpl);
            }
            else{
                obj.dom.html(_ajax_tpl);
            }



            callback && callback();
        }
        else{
            op_tip({ title:'错误提醒', content:'图片上传错误,错误信息:<br/>' + obj.src });
        }
    }

	var imgAddtoContent = function(obj){
		    obj.dom.off('click');
			obj.dom.on('click', function(){
				editor.execCommand( 'insertimage', {
				   src:$(this).attr('src').replace(/!thumb/g, ''),
				 } );
			});
			//imgAddtoContent = function(){}
	}

    var tree_init = function(callback){
        $('.tree li:has(ul)').addClass('parent_li');
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(":visible")) {
                children.hide('fast');
                $(this).find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
            } else {
                children.show('fast');
                $(this).find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            }
            e.stopPropagation();
        });
        callback && callback();
        //$('.tree li.parent_li > ul > li').hide();
    }

	var tree_hide = function(){
		$('.tree li.parent_li > span').parent('li.parent_li').find(' > ul > li').hide();
		$('.tree li.parent_li > span.parent').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
	}
	
	function setcategory(objname,column_id){
		var html="";
		$.post("/website/column/getcategory/"+column_id, "",function(list){
				 html+=' <option value=""></option>';
				$.each(list ,function(index,cate){
					html+='<option value="'+cate.category_id+'">'+cate.name+'</option>';
				});
					
				if(html==""){
					html+='<option value="">无分类</option>';
				}
        		$("#"+objname+"_chzn a span").text("请选择");
				$("#"+objname+"").html(html);
				$("#"+objname+"").trigger("liszt:updated");
		},'json');
	}
	function setcate(val){
		setcategory("category",val);
	}
	function setChosenSelected(objname,val)
	{
		$("#"+objname+"").chosen("destory");
		if(val =="")
		{
	        $("#"+objname+" option").each(function(){
	        	$("#"+objname+"_chzn a span").text("请选择");
	            $(this).attr("selected",false);
	        });    
		}
		else
		{
        	$("#"+objname+" option").each(function(){
        	    if($(this).val() == val)
        	    {
        		    $("#"+objname+"_chzn a span").text($(this).text());
                    $(this).attr("selected",true);
                }
        	});   
   		 }
		$("#"+objname+"").chosen();
	}

function array_contains(array,value){
	for(var a=0,len =array.length;a<len;a++){
		var tmp = array[a];
		if(tmp instanceof Array && value instanceof Array)
    		{
				var flag =true;
        		for (var i=0,iLen=tmp.length; i<iLen; i++)
        		{
           		 	if (tmp[i]!==value[i])
               		 	{
                    		flag =false;
							continue;
                		}
        		}
				if(flag) return true;
			}
	}
	
	return false;
	
}

