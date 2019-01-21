<?php

//Include authentication
require("process/auth.php");

//Include database connection
require("../config/db.php");

//Include class Organization
require("classes/Organization.php");

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style_admin.css">
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Voting Sytem</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="admin_page.php"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active"><a href="add_org.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Event</a></li>
                <li><a href="add_pos.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Position</a></li>
                <li><a href="add_nominees.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Nominees</a></li>
                <li><a href="add_voters.php"><span class="glyphicon glyphicon-plus-sign"></span>Add Voters</a></li>
                <li><a href="vote_result.php"><span class="glyphicon glyphicon-plus-sign"></span>Vote Result</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="process/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->

    </div><!-- /.container-fluid -->
</nav>
<!-- End Header -->





<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h4>Add Event</h4><hr>
            <?php
            if(isset($_POST['submit'])) {

                $organization = trim($_POST['organization']);

                $insertOrg = new Organization();
                $rtnInsertOrg = $insertOrg->INSERT_ORG($organization);
            }
            ?>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>" role="form">
                <div class="form-group-sm">
                    <label for="organization">Event</label>
                    <input required type="text" name="organization" class="form-control">
                </div><hr>
                <div class="form-group-sm">
                    <input type="submit" name="submit" value="Submit" class="btn btn-info">
                </div>
            </form>
        </div>

        <div class="col-md-8">
            <h4>List of Events</h4><hr>
            <?php
            $readOrg = new Organization();
            $rtnReadOrg = $readOrg->READ_ORG();
            ?>
            <div class="table-responsive">
                <?php if($rtnReadOrg) { ?>
                <table class="table table-bordered table-condensed table-striped">
                    <tr>
                        <th>Events</th>
                        <th><span class="glyphicon glyphicon-edit"></span></th>
                        <th><span class="glyphicon glyphicon-remove"></span></th>
                    </tr>
                    <?php while($rowOrg = $rtnReadOrg->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $rowOrg['org']; ?></td>
                        <td><a href="http://localhost/voting_system/sandbox/edit_org.php?id=<?php echo $rowOrg['id']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><a href="http://localhost/voting_system/sandbox/delete_org.php?id=<?php echo $rowOrg['id']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                    <?php } //End while ?>
                </table>
                <?php $rtnReadOrg->free(); ?>
                <?php } //End if ?>
            </div>
        </div>
    </div>
</div>






<!-- Footer -->
<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">

    <div class="container">
        <div class="navbar-text pull-left">
           Copyright 2018 @ AQUINAS ALUMNI ASSOCIATION
        </div>
    </div>

</nav>
<!-- End Footer -->

<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>

</body>
</html>
<?php
//Close database connection
$db->close();