<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>My Gallery</title>
<!-- css file -->
<link rel="stylesheet" type="text/css" href="main.css" />
<!-- JS files -->
<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="upload.js"></script>
<script type="text/javascript" src="waterfall.js"></script>
</head>

<body>
<div id="header">
</div>

<div id="main">
   <div class="uploadImg">
   		<p>Only less than 10M image files are supported.</p>
   		<div class="btn">
            <span>Upload Image</span>
            <input id="fileupload" type="file" name="mypic">
        </div>
        <div class="progress">
    		<span class="bar"></span><span class="percent">0%</span>
		</div>
        <div class="files"></div>
        <div id="showimg"></div>
   </div>
</div>

<div class="waterfall-container">
      <div class="waterfall-content bgcolor-3">
		<div id="gallerycontainer">
			<div class="box"><img src="files/4.png" alt=""></div>
			<div class="box"><img src="files/4.png" alt=""></div>
			<div class="box"><img src="files/4.png" alt=""></div>
			<div class="box"><img src="files/4.png" alt=""></div>
			<div class="box"><img src="files/4.png" alt=""></div>
			<div class="box"><img src="files/4.png" alt=""></div>
			<div class="box"><img src="files/4.png" alt=""></div>
			<div class="box"><img src="files/4.png" alt=""></div>
			<div class="box"><img src="files/4.png" alt=""></div>
		</div>
	</div>
</div>
<script>

var str = "";
var str = "";
var templ = '<div class="box" style="opacity:0;filter:alpha(opacity=0);"><div class="pic"><img src="files/{{src}}" /></div></div>'
$(document).ready(function () {
	$.ajax({ 
    	type: 'GET', 
    	url: 'loadImageName.php',
    	dataType: 'json',
    	success: function (data) { 
        	$.each(data, function(index, element) {
				str += templ.replace("{{src}}", data[index].name);
				})
			}
	});
});

	$("#gallerycontainer").waterfall({
	    itemClass: ".box",
	    minColCount: 1,
	    spacingHeight: 100,
	    resizeable: false,
	    ajaxCallback: function(success, end) {
			$(str).appendTo($("#gallerycontainer"));
	        success();
	        end();
	    }
	});
</script>
</body>
</html>