<?php  

    require 'session.php';

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
    body{
  margin: 0;
  pading: 0;
  background: url(image/b.jpg);
  background-size: cover;
  background-position: center;
  font-family: sans-serif;
  background-repeat:no-repeat;
  background-size: 1500px 1500px ;

  
}
.pro-circle{
  height: 100px;
  width: 100px;
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
    <a class="navbar-brand" href="#">Account Settings</a>
    <!-- Links -->
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Cancle</a>
      </li>
      
    </ul>
  </nav>
  <div class="jumbotron jumbotron-fluid">
        <div class="container">
  <?php
if (empty($photo_file)) {
    $photo = "image/default-avatar.png";
} else {
    $photo = "user/{$username}/{$photo_file}";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-2">
            <form method="POST" action="upload.php" enctype="multipart/form-data">
                <div class="image-upload">
                    <label class="file-input" for="file-input">
                        <img id="preview" src="<?= $photo ?>" class="pro-circle">
                    </label>
                    <input id="file-input" type="file" name="picture" />
                    <input name="username" type="hidden" value="<?= $username ?>" />
                    <button class="btn btn-primary btn-sm" id="upload-btn">Upload</button>
                </div>
            </form>

        </div>
    </div>
    
            
            <table width="30%">
                <tr><th>Name:</th><td><?= $name; ?></td></tr>
                <tr><th>Email:</th><td><?= $email; ?></td></tr>
                <tr><th>Reg Date:</th><td><?= $created; ?></td></tr>
            </table>
            <br/>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia enim molestiae commodi, itaque odit, quae
                praesentium eaque facilis saepe magnam, officiis consequatur possimus accusantium aliquam id fugiat
                eveniet quibusdam quo.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora aut, dolorum
                beatae quia temporibus voluptatem tenetur asperiores eligendi! Enim saepe nesciunt odio magni explicabo
                reprehenderit veritatis suscipit ipsum cum nam.</p>
        </div>
    </div>
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
<?php
if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(!empty($_FILES['picture']['name'])) {
        require_once "config.php";
        $result = 0;
        $mainDir = "user";
        $uploadDir = "{$mainDir}/" . $_POST['username'] . "/";
        if (!is_dir($mainDir)) { mkdir($mainDir); }
        if (!is_dir($uploadDir)) { mkdir($uploadDir); }
        $path_parts = pathinfo($_FILES["picture"]["name"]);
        $ext = $path_parts['extension'];
        $fileName = uniqid().'.'.$ext;
        $targetPath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {
            $userId = 1;
            $update = $conn->prepare("UPDATE users SET photo=? WHERE id=?");
            if ($update->execute([$fileName, $userId])) {
                //header("Location: profile.php");
            }
        } else {
            die('Unable to move image to '.$targetPath);
        }
    } else {
        die('Unable to get the image');
    }
} else {
    die('404 Not Found');
}
?>