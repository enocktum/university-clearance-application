<?php
session_start();
if(!isset($_SESSION['residencelogin']))
{
 	header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	 <?php
	 //start of basic application details
  	include("../connection.php");
	$dery=mysqli_query($con,"select * from clearance_basics");
	$wata=mysqli_fetch_array($dery);
	$copyright=$wata['rights'];
	$developed=$wata['developed'];
	$website=$wata['website'];
	$title=$wata['title'];
	$subtitle=$wata['subtititle'];
	//end of basic application details
    ?>
    <title><?php echo $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
	<?php
	$username=$_SESSION['studentlogin'];
	$clearancequery=mysqli_query($con,"select * from student_details where idnumber='$username'");
	$clearancedata=mysqli_fetch_array($clearancequery);
	$clearedornot=$clearancedata['clearance_status'];
	?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a style="text-transform:uppercase;" class="navbar-brand" href="../index.php"><?php echo $title; ?></a>
            </div>
            <!-- Top Menu Items -->
			<!-- start processing php -->
			<!-- End processing php -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['residencelogin']; ?> admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href=""><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="residencehome.php"><i class="fa fa-fw fa-dashboard"></i> <?php echo $_SESSION['residencelogin']; ?> Home</a>
                    </li>
					
					<li>
                        <a href="residenceclearedstudents.php"><i class="glyphicon glyphicon-thumbs-up"></i> Cleared Students</a>
                    </li>
					
					<li class="active">
                        <a href="residenceunclearedstudents.php"><i class="glyphicon glyphicon-thumbs-down"></i> Uncleared Students</a>
                    </li>
					<li>
                        <a href="residencebasket.php"><i class="glyphicon glyphicon-bullhorn"></i> Students Basket</a>
                    </li>

					<li>
                        <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">residence clear student progress</h1>
						<p>
						<?php
						$incre=$_POST['incre'];
						if($incre)
						{
							$chk=mysqli_query($con,"select * from department_residence where incre='$incre' && basket=''");
							$no=mysqli_num_rows($chk);
							if($no==1)
							{
							$update=mysqli_query($con,"update department_residence set clearance_status='1',basket='' where incre='$incre'");
							if($update)
							{
								echo"Student has been successfully cleared in residence department list<br/><a href='residenceclearedstudents.php'>Cleared Students</a>";
							}
							else
							{
								echo"student not successfully cleared<br/><a href='residenceunclearedstudents.php'>Try Again</a>";
							}
							}
							else
							{
								echo"student not successfully cleared due to uncleared items<br/><a href='residenceunclearedstudents.php'>Try Again</a>";
							}
						}
						else
						{
						 	header("location:residencehome.php");
						}
						?>
						</p>
                    </div>
                </div>
                <!-- /.row -->

            </div>
			<footer style="text-align:left;background-color:#000000;color:#FFFFFF;" class="navbar navbar-default navbar-fixed-bottom">
					<div style="text-align:center;" class="container-fluid">&copy; <?php echo date("Y");?> <a href=""><?php echo $title; ?></a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Design by <a href="<?php echo $website; ?>" target="_blank"><?php echo $developed; ?></a>.</div>
					</footer>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
</body>

</html>
