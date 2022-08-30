<?php
// connecting to database.....
include 'db_connect.php';
// get parameter.....
$roomname=$_GET['roomname'];

// check whether room exists...
$sql="SELECT * FROM `rooms` WHERE roomname='$roomname';";
$result=mysqli_query($conn,$sql);
if ($result)
{
    // check if room exists....
    if(mysqli_num_rows($result)==0)
    {
        $message="This room does not Exists.";
        // for alert message....
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="index.php";';
        echo '</script>';
    }
}
else
{
    echo "Error : ". mysqli_error($conn);
}

?>
<!-- credits: https://www.w3schools.com/howto/howto_css_chat.asp -->
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="./css/product.css" rel="stylesheet">
    <style>
        body {
            margin: 0 auto;
            max-width: 800px;
            padding: 0 20px;
        }
        .container {
            border: 2px solid #dedede;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
        }
        .darker {
            border-color: #ccc;
            background-color: #ddd;
        }
        .container::after {
            content: "";
            clear: both;
            display: table;
        }
        .container img {
            float: left;
            max-width: 60px;
            width: 100%;
            margin-right: 20px;
            border-radius: 50%;
        }
        .container img.right {
            float: right;
            margin-left: 20px;
            margin-right:0;
        }
        .time-right {
            float: right;
            color: #aaa;
        }
        .time-left {
            float: left;
            color: #999;
        }
        .anyclass{
            height: 350px;
            overflow: scroll;
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <header class="site-header sticky-top py-1 bg-light">
      <div class="d-flex flex-column flex-md-row align-items-center pb-1 border-bottom">
        <h5 class="fs-4">MyAnonymousChat.com</h5>
        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
          <a class="me-3 py-2 text-dark text-decoration-none" href="#">Home</a>
          <a class="me-3 py-2 text-dark text-decoration-none" href="#">About</a>
          <a class="me-3 py-2 text-dark text-decoration-none" href="#">Contact</a>
        </nav>
      </div>
    </header>
    <h2>Chat Messages - <?php echo $roomname; ?></h2>

    <div class="container">
        <div class="anyclass">
            <!-- <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
            <p>Hello. How are you today?</p>
            <span class="time-right">11:00</span> -->
        </div>
    </div>

    <!-- <div class="container darker">
        <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
        <p>Hey! I'm fine. Thanks for asking!</p>
        <span class="time-left">11:01</span>
    </div>
    <div class="container">
        <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
        <p>Sweet! So, what do you wanna do today?</p>
        <span class="time-right">11:02</span>
    </div>
    <div class="container darker">
        <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
        <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
        <span class="time-left">11:05</span>
    </div> -->
    <input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add massage">
    <br>
    <button class="btn btn-primary" name="submitmsg" id="submitmsg">Send</button>
    <!-- .........bootstrap cdn...... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- .........jquery cdn...... -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        // check for new messages every 1 seconds....
        setInterval(runFunction,1000);
        function runFunction()
        {
            $.post("htcont.php",{room:'<?php echo $roomname; ?>'},
                function(data,status){
                    document.getElementsByClassName('anyclass')[0].innerHTML=data;
            });
        }

        // using enter key to submit....credits: https://www.w3schools.com/howto/howto_js_trigger_button_enter.asp
        // Get the input field
        var input = document.getElementById("usermsg");
        // Execute a function when the user releases a key on the keyboard
        input.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("submitmsg").click();
        }
        });

        // if user submit the form... credits: https://www.w3schools.com/jquery/ajax_post.asp
        $("#submitmsg").click(function(){
            var clientmsg=$("#usermsg").val();
            $.post("postmsg.php", {text: clientmsg, room:'<?php echo $roomname; ?>', ip:'<?php echo $_SERVER["REMOTE_ADDR"]; ?>'}, function(data,status){
                document.getElementsByClassName('anyclass')[0].innerHTML=data;
                $("#usermsg").val("");
                return false;
            });
        });
    </script>
</body>
</html>