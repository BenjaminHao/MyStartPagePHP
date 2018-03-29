<?php

$db = mysqli_connect('localhost', 'root', '') or
		die(mysqli_connect_error());

$create_db = "CREATE DATABASE IF NOT EXISTS MYHOMEPAGE";
mysqli_query($db, $create_db) or
        die (mysqli_error($db));

mysqli_select_db($db, 'MYHOMEPAGE') or 
		die(mysqli_error($db));

mysqli_query($db, "		
CREATE TABLE IF NOT EXISTS todos(
    event VARCHAR(45) NOT NULL,
    due DATETIME() NOT NULL,
    detail VARCHAR(255),
	PRIMARY KEY (event, due)") or 
	die(mysqli_error($db));

// Todo: select values
$allTodos = "SELECT event, due FROM todos";
$result = $db->query($allTodos);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo ": " . $row["event"]. " - due: " . $row["due"]. " " . $row["detail"]. "<br>";
    }
}
?>

<html>
<head>
<script>
	function open_todo_details()
	{
		document.getElementById("todo_details").style.display='block';
		document.getElementById("my_name").style.textDecoration = "underline"
	}
	function close_todo_details()
	{
		document.getElementById("todo_details").style.display='none';
		document.getElementById("my_name").style.textDecoration = "none"
	}
</script>
</head>
<body>
	 <!--head background-->
	<div style="position:absolute;left:0%;top:0%; height:13.2%; width:100%; z-index:-1; background:silver">   </div>
     <!--Todo List -->
    <div style="position:absolute;left:5%;top:15%;"> Todo List: <ul><li><span style=" color:#3B5998;" onMouseOver="open_todo_details()" onMouseOut="close_todo_details()" id="my_name">  Todo  </span> </div>

	<!--text: faceback -->
	<div style="position:absolute;left:13.5%; top:3.3%; font-size:45; font-weight:900; color:#FFFFFF; font-weight:bold;"> <font face="myFbFont">  My HomePage </font> </div>
	<!--body background-->
	<div style="position:absolute;left:0%;top:13.2%; height:90%; width:100%; z-index:-1; background:#E7EBF2">   </div>
	<!--bottam background-->
	<div style="position:absolute;left:0%;top:100%; height:5%; width:100%; z-index:-1; background:#FFFFFF">   </div>
      
     <!--Todo_details -->  
    <div style="display:none;" id="todo_details">
    <div style="position:absolute;left:20%;top:20%; height:30%; width:30%; z-index:2; background:#000; opacity:0.5; box-shadow:10px 0px 10px 1px rgb(0,0,0);">   </div>
    <div style="position:absolute;left:20%;top:22%; z-index:3; color:#FFF;"> <h2> Due: <?php echo "sometime"; ?> </h2> </div>
    <div style="position:absolute;left:20%;top:27%; z-index:3; color:#FFF;">  <h3>Event: <?php echo "something"; ?> </h3> </div>
    <div style="position:absolute;left:20%;top:34%; z-index:3; color:#FFF;"> <h3> Others: <?php echo ""; ?>  </h3> </div>
	</div>
    
</body>
</html>
