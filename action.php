<?php

require_once "config.php";

if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $name = check_input($_POST['name']);
    $uname = check_input($_POST['uname']);
    $email = check_input($_POST['email']);
    $pass = check_input($_POST['pass']);
    $cpass = check_input($_POST['cpass']);
    $created = date('Y-m-d');

    if ($pass != $cpass) {
        echo 'Password did not matched!';
        exit();
    } else {
        $pass = password_hash($pass, PASSWORD_BCRYPT);
        $sql = $conn->prepare("SELECT username,email FROM users WHERE username=? OR email=?");
        $sql->execute([$uname, $email]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if ($row['username'] == $uname) {
            echo 'Username already exist, try a different one!';
        } elseif ($row['email'] == $email) {
            echo 'Email already exist try a different one!';
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name,username,email,pass,created) VALUES (?,?,?,?,?)");
            if ($stmt->execute([$name, $uname, $email, $pass, $created])) {
                echo 'Registered Successfully. Login Now!';
                header("Refresh:5; URL = index.php");

            } else {
                echo 'Something went wrong. Please try again!';
            }
        }
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $chkUsr = $conn->prepare("SELECT * FROM `users` WHERE username=?");
    if ($chkUsr->execute([$username])) {
        $user = $chkUsr->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['pass'])) {
            $_SESSION['username'] = $username;
            echo 'ok';
            if (!empty($_POST['rem'])) {
                setcookie("username", $_POST['username'], time() + (10 * 365 * 24 * 60 * 60));
                setcookie("password", $_POST['password'], time() + (10 * 365 * 24 * 60 * 60));
            } else {
                if (isset($_COOKIE['username'])) {
                    setcookie("username", "");
                }
                if (isset($_COOKIE['password'])) {
                    setcookie("password", "");
                }
            }
        } else {
            echo 'Incorrect username or password';
        }
    } else {
        echo 'Incorrect username or password';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'forgot') {

    $femail = $_POST['femail'];

    $stmt_p = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt_p->bind_param("s", $femail);
    $stmt_p->execute();
    $res = $stmt_p->get_result();

    if ($res->num_rows > 0) {
        $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);

        $stmt_i = $conn->prepare("UPDATE users SET token=?, tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE email=?");
        $stmt_i->bind_param("ss", $token, $femail);
        $stmt_i->execute();

//to send mail
        require 'phpmailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        $mail->Username = '';//put the email here
        $mail->Password = '';//this has to be the password to the above email

        $mail->addAddress($femail);
        $mail->setFrom('onyedikachi1997@gmail.com', 'Benjamin');//all of this have to change too
        $mail->Subject = 'Reset Password';
        $mail->isHTML(true);

        $mail->Body = "<h3>Click the below link to reset your password.</h3><br><a href='http://localhost/comp_login/resetPassword.php?email=$femail&token=$token'>http://localhost/comp_login/resetPassword.php?email=$femail&token=$token</a><br><h3>Regards<br>Solianites</h3>";

        if ($mail->send()) {
            echo 'We have sent the reset link to your email, please check inbox or spam.';
        } else {
            echo 'Something went wrong please try again later.';
        }
    }

}

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
