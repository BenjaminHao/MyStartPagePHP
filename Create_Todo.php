<form method="post" action="database_email.php">
<h1>Hello! Please enter your event here:</h1>
Event: </br>
<input name="event" type="text"></br>
Due: </br>
<input name="due" type="datetime-local"></br>
Detail: </br>
<input name="detail" type="text"></br>
<input type="submit">
</form>

<?php
session_start();

$db = mysqli_connect('localhost', 'root', '') or
        die(mysqli_connect_error());
mysqli_select_db($db, 'MYHOMEPAGE') or 
die(mysqli_error($db));

if (!isset($_POST['email']))
{
    $_SESSION['event'] = $_POST['event'];
    $_SESSION['due'] = $_POST['due'];
    $_SESSION['detail'] = $_POST['detail'];

    echo 
    ("
        <h1>Your Task is  ".$_SESSION['event'].", and it is due ".$_SESSION['due']. "</h1>
        <h2>Detail: ". $_SESSION['detail'] ."
    ");
    mysqli_query($db, "
    INSERT INTO todos(
        event,
        due,
        detail,
    ) VALUES (
    '".$_POST['event']."',
    '".$_POST['due']."',
    '".$_POST['detail']."'
    )")
    or die(mysqli_error($db));
    session_destroy();
}