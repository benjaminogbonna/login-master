<?php
require_once 'session.php';
define('TITLE', $name);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Benjamin">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
        <?php // Print the page title.
        if (defined('TITLE')) { // Is the title defined?
            print TITLE;
        } else { // The title is not defined.
            print 'Profile';
        }
        ?>
    </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-size: cover;
            font-family: sans-serif;
            background: url(image/b.jpg) no-repeat center;
            background-size: 1500px 1500px;
        }

        .pro-circle {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            border: thin solid black;
            background-color: gray;
            text-align: center;
        }
        .image-upload>input {
            display: none;
        }
        .file-input {
            cursor: pointer;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#"><?= $name; ?></a>
    <!-- Links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
        </li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                <?= $username; ?>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="upload.php">Settings</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </li>&nbsp;
      <li>        
      <?php

      // display the profile picture.
         if (empty($photo_file)) {
            $photo = "image/default-avatar.png";
        } else {
            $photo = "user/{$username}/{$photo_file}";
        }  
      ?>
      <img id="preview" src="<?= $photo ?>" class="pro-circle">
        
      </li>
    </ul>
</nav>

<div class="container-fluid">
    
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="application/javascript">
    $('#upload-btn').hide();
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file-input").change(function () {
        readURL(this);
        $('#upload-btn').show();
    });
</script>
</body>

</html>