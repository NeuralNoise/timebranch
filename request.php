<?php
session_start();
include('php/db.php');
include('php/class.php');
if(!isset($_SESSION['id']))
{
    header("Location: index.php");
}
else{
$user_id = $_SESSION['id'];
$_SESSION['request'] = $q->get_sent_friend_request_ids($user_id);
$_SESSION['incoming'] = $q->get_incoming_requests($user_id);
$_SESSION['friends'] = $q->get_friend_ids($user_id);
$_SESSION['block_list'] = $q->get_block_ids($user_id);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Sandeep Acharya">
    <link rel="icon" href="img/favicon.ico">

    <title>timeBranch | Make new Friends | Make it large | Make in INDIA</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/home.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container" id="main_page">
        <!-- ---------------------------------------//////////////////////////////////////////////////////-------------------- -->
        
               <?php $q->nav(); ?>
      
        <!-- -------------------------------------///////////////////////////////////////////////////////////---------------------- -->
        <div class="row">
            <div class="col-md-12">
                <div class="large">
                    <h3>Received Requests</h3>
                </div>
                <?php
                if($_SESSION['incoming'][0]==0){
                    echo '<p class="alert alert-danger">You do not have any incoming friend requests.</p>';
                }
                else{
                
                    foreach($_SESSION['incoming'] as $key => $val){
                        ?>
                        <div class="col-md-3">
                            
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                     <h4><a href="http://localhost/sandeep/profile?id=<?php echo $val; ?>"><?php $q->get_full_name($val);?></a></h4>
                                </div>
                                <div class="panel-body">
                                    <center><a href="http://localhost/sandeep/profile?id=<?php echo $val; ?>">
                                            <img class="img-responsive" src="<?php
                                                if($q->is_property_exists($val,'profile_picture_path'))
                                                {
                                                    print($q->get_property_of($val,'profile_picture_path'));
                                                }
                                                else{
                                                    print("http://localhost/sandeep/img/demo.png");
                                                }
                                                 ?>"></a>
                                    </center>
                                    <hr>
                            <p><?php echo "Status: "; print($q->get_property_of($val,"profile_status")); ?><br><?php echo "Gender: "; print($q->get_property_of($val,"sex")); ?></p>
                                </div>
                        
                            </div>
                        </div>
                        <?php 
                    }
                     echo '<br><br>';
                }
                ?>
                <br>
                <br>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>