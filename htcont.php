<?php
$room=$_POST['room'];
// connecting the database....
include 'db_connect.php';
$sql="SELECT msg,stime,ip FROM msgs WHERE room='$room';";

$html_content="";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0)
{
    $res="";
    while($row=mysqli_fetch_assoc($result))
    {
        $res=$res.'<div class="container">'
                    .$row['ip'].' says 
                    <p>'.$row['msg'].'</p> 
                    <span class="time-right">'.$row['stime'].'</span>
                    </div>';
    }
    echo $res;
}


?>