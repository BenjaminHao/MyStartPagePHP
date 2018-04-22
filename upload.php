<?php
if($_GET){
	$action = $_GET['act'];

	//delete img
	if($action=='delimg'){
		$filename = $_POST['imagename'];
		if(!empty($filename)){
			unlink('files/'.$filename);
			echo '1';
		}else{
			echo 'Fail to delete.';
	}
}

}else{ // upload img
		if ($_FILES['mypic'] != null){
			$picname = $_FILES['mypic']['name'];
			$picsize = $_FILES['mypic']['size'];
			if ($picname != "") {
			// can only upload < 10M img
			if ($picsize > 10240000) {
				echo 'The image is too big! (Larger than 10M)';
				exit;
			}
			$type = strstr($picname, '.');
			// can only upload img file
			if ($type != ".gif" && $type != ".jpg" && $type != ".jpeg" && $type != ".png") {
				echo 'File is not supported！';
				exit;
			}
			// I need a random image name
			$rand = rand(100, 999);
			$pics = date("YmdHis") . $rand . $type;
			// path
			$pic_path = "files/". $pics;
			move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
		}
	}

	// change size to MB
	$size = round($picsize/1024/1024,2);
	
	$arr = array(
		'name'=>$picname,
		'pic'=>$pics,
		'size'=>$size
	);
	echo json_encode($arr);
}
?>