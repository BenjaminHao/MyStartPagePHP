$(function () {
	var bar = $('.bar');
	var percent = $('.percent');
	var showimg = $('#showimg');
	var progress = $(".progress");
	var files = $(".files");
	var btn = $(".btn span");
	$("#fileupload").wrap("<form id='myupload' action='upload.php' method='post' enctype='multipart/form-data'></form>");
	// choose file
	$("#fileupload").change(function(){
		$("#myupload").ajaxSubmit({
			// ajax submit json file
			dataType:  'json',
			// upload file
			beforeSend: function() {
				// need to clear image first 
				showimg.empty();
				// show progess of uploading
				progress.show();
				// set percent to 0 at fisrt
				var percentVal = '0%';
				// the width of bar is the percentage
				bar.width(percentVal);
				// will show percentage
				percent.html(percentVal);
				// change button text to uploading
				btn.html("Uploading...");
    		},
    		uploadProgress: function(event, position, total, percentComplete) {
				// get percentage of uploading
				var percentVal = percentComplete + '%';
				// change bar width -> getting wider
				bar.width(percentVal);
				// will show percentage
        		percent.html(percentVal);
    		},
			success: function(data) {
				//get name and size from json file
				files.html("<b>"+data.name+" ("+data.size+"M)</b> <span class='delimg' rel='"+data.pic+"'>Delete</span>");
				//display file
				var img = "files/"+data.pic;
                showimg.html("<img src='"+img+"' width='480px'>");
                btn.html("Choose an Image");
			},
			error:function(xhr){
				btn.html("Fail to upload!");
				bar.width('0')
				// get error msg
				files.html(xhr.responseText);
			}
		});
	});
	
	$("body").on('click', ".delimg",function(){
		var pic = $(this).attr("rel");
		$.post("upload.php?act=delimg",{imagename:pic},function(msg){
			if(msg==1){
				files.html("Deleted!");
				// clear img
				showimg.empty();
				// hide progress bar
				progress.hide();
			}else{
				alert(msg);
			}
		});
	});
});