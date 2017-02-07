(function($) {

	var settings = {
		fileType : {
			img : ['jpg','JPG','jpeg','JPEG','gif','GIF','PNG','png'],
			zip : ['zip','ZIP','rar','RAR']
		},
		maxSize  : 30*1024*1024,
		url      : '/default/certificate',
		sucFn    : function(){console.log('success')}
	};

	$.fn.extend({

		upload:function(options){
			var that = this;
			settings = $.extend(settings,options);

			//验证文件后缀
			function checkType(){
				var filepath = that.val(),
					filetype = that.attr('filetype'),
					thisType = filepath.split('.').pop();
				if(filepath){
					var pass = false;
					$.each(settings.fileType[filetype],function(key,val){
						if(thisType == val){
							pass = true;
							return pass;
						}
					});
					return pass;
				}
			}

			//验证文件格式
			if(!checkType()){
				alert('上传的格式不正确啦！');
				return false;
			}

			//验证文件大小
			var fileSize = that[0].files[0].size;
			if(fileSize > settings.maxSize){
				alert('你的文件太月半（胖）了');
				return false;
			}

			//上传相关
			var thisId = that.attr('id');
			var options={
        	    url:settings.url,
        	    type:"post",
        	    success:settings.sucFn
        	};
        	if(!that.hasClass('inited')){
        		that.addClass('inited')
        		$("#form_"+thisId).submit(function() {
        		    $(this).ajaxSubmit(options);
        		    return false;
        		});
        	}
    		$("#form_"+thisId).submit();

		}

	});
})(jQuery);