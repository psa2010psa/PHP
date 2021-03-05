/*
 * @auther yjiang
 * @依赖jquery.form
 */
$.fn.extend({
	jUpfile : function(uploadOption, callBack){
		function progressBar(){	//上传进度条
			var bar = $('._jUpBar');
			var percent = $('._jUpPercent');

			this.init = function(){
				$('.progress').show();
				var percentVal = '0%';
				bar.width(percentVal)
				percent.html(percentVal);
			}
			this.uploading = function(percentComplete){
				var percentVal = percentComplete + '%';
				bar.width(percentVal)
				percent.html(percentVal);
			}
			this.complete = function(result){
				//$('.progress').hide();
				var percentVal = '100%';
				bar.width(percentVal)
				percent.html(percentVal);
			}
		}
		function upFile(option){	//上传文件 
			//var obj = {};
			//option.post_url;
			//option.form;
			//option.bar;
			//option.percent;
			var _form = option.form;
			var _originAction = _form.attr('action');	//获取上传表单的原始url
			var _progressBar = new progressBar();
			_form.attr({ action:option.post_url });		//修改表单url为post地址,以便ajax提交文件
			_form.ajaxSubmit({							//执行上传
				beforeSend: function(){
					_progressBar.init();
				},
				uploadProgress: function(event, position, total, percentComplete) {
					_progressBar.uploading(percentComplete);
				},
				success: function(data) {
					_progressBar.complete(data);					//进度条效果
					_form.attr({ action:_originAction });			//上传完成,恢复表单url
					//if(typeof(completedDo) !== 'undefined') completedDo();
					(callBack && typeof(callBack) == "function") && callBack(data);
					$('._jUpProgress').remove();
				}
			});
		}
		$(this).on('change', function(){
			var progressBar = "\
			  <div class='_jUpProgress' style='margin-top:10px;position:relative; width:50px; border: 1px solid #ddd; padding: 1px; border-radius: 3px;'>\
				  <div class='_jUpBar' style='background-color: #4AB8F3; width:0%; height:20px; border-radius: 3px;'></div>\
				  <div class='_jUpPercent' style='position:absolute; display:inline-block; top:3px; left:48%;'>0%</div>\
			  </div>\
			";
			$(this).after(progressBar);
			uploadCourseware = new upFile(uploadOption);//上传文件
		});

	}
});
