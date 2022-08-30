<?php
// getting the value of post parameter....
$room=$_POST['room'];
if(strlen($room)>20 || strlen($room)<=2)
{
    $message="Please, Choose a name between 2 to 20 characters.";
    // for alert message....
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="index.php";';
    echo '</script>';
}
elseif(!ctype_alnum($room))
{
    $message="Please, Choose an alphanumeric room name.";
    // for alert message....
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="index.php";';
    echo '</script>';
}
else
{
    // connecting the database....
    include 'db_connect.php';
    
    // check if room already exits...
    $sql="SELECT * FROM `rooms` WHERE roomname='$room';";
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        // $message="Please, Choose a different room name.";
        // for alert message....
        echo '<script language="javascript">';
        // echo 'alert("'.$message.'");';
        echo 'window.location="rooms.php?roomname='.$room.'";';
        echo '</script>';
    }
    else
    {
        $sql="INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
        if(mysqli_query($conn,$sql))
        {
            $message="Your room is ready and you can chat now.";
            // for alert message....
            echo '<script language="javascript">';
            echo 'alert("'.$message.'");';
            echo 'window.location="rooms.php?roomname='.$room.'";';
            echo '</script>';
        }
    }
        
}

?>