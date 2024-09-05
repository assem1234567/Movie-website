<?php
session_start();
if(isset($_SESSION['person']))
{
    header('locatoin:index.php');
    exit();
}

if(isset($_POST['signup'])) {

    include 'connection.php';
    $name = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $errors=[];
    if (empty($name))
    {
        $errors[] = "Name is required";
       // header('locatoin:signup.php');
    }
    $stm = "SELECT name FROM person WHERE name ='$name'";
    $q = $conn->prepare($stm);
    $q->execute();
    $data = $q->fetch();

    if ($data) {
        $errors[] = "the name already exists";
        //header('locatoin:signup.php');
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "valid email is required";
       // header('locatoin:signup.php');
    }


    $stm = "SELECT email FROM person WHERE email ='$email'";
    $q = $conn->prepare($stm);
    $q->execute();
    $data = $q->fetch();

    if ($data) {
        $errors[] = "the email already exists";
        //header('locatoin:signup.php');
    }

    if (strlen($_POST["password"] )< 8) {
        $errors[] = "password must be at least 8 characters";
        //header('locatoin:signup.php');
    }

    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errors[] = "password must contain at least one letter";
       // header('locatoin:signup.php');
    }

    if ($_POST["password"] !== $_POST["passwordconfirm"]) {
        $errors[] = "passwords must match";
       // header('locatoin:signup.php');
    }

    if (empty($errors)) {
        $password_hash =$_POST["password"];
        $stm = "INSERT INTO person (name,email,password_hash) VALUES ('$name','$email','$password_hash')";
        $conn->prepare($stm)->execute();
        $_POST['username'] = '';
        $_POST['email'] = '';

        $_SESSION['person'] = [
            "name" => $name,
            "email" => $email,
        ];
        header('location:index.php');
    }
}
else if(isset($_POST['login']))
{
    header('location:index.php');
}



//$mysql=require __DIR__ . "/connection.php"; //to make sure the code work fine and to include other file that is present in include file

//if(isset($_POST['signup']))
//{
//    $pname=$_POST['username'];
//    $pemail=$_POST['email'];
//    $sql_u="SELECT FROM person WHERE pname='$pname'";
//    $sql_e="SELECT FROM person WHERE pemail='$pemail'";
//    $res_u=mysqli_query($mysql,$sql_u);
//    $res_e=mysqli_query($mysql,$sql_e);
//    if(mysqli_num_rows($res_u))
//        $name_error="sorry user name already taken";
//    else if(mysqli_num_row($res_e))
//        $email_error="sorry email already taken";
//    else
//    {
//        $sql="INSERT INTO person (name,email,password_hash)
//        VALUES (?,?,?)";
//        $res=mysqli_query($mysql,$sql);
//        echo "signup successful";
//        exit();
//    }
//}




//$stmt=$mysql->stmt_init();// new prepared statment object
//if(!$stmt->prepare($sql)) //prepare for excution
//{
//    die("SQL error" . $mysql->error);
//}
//$stmt->bind_param("sss",
//    $_POST["username"],
//    $_POST["email"],
//    $password_hash);
//
//if($stmt->execute())
//{
//    echo "signup successful";
//}
//else
//{
//    if($mysql->error===1062)
//        die("email already taken");
//    else
//        die($mysql->error . " " . $mysql->errno);
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/png">
    <?php
    if(!empty($errors))
    {?>
        <style>.error{display: block}</style><?php
    }
    ?>

    <title>syrbest</title>

</head>
<body>
   <div class="box">
    <form class="container" action="signup.php" method="post" novalidate>

        <div class="top">
            <header>signup</header>
        </div>

        <div class="input-field">
            <input type="text" name="username" class="input" placeholder="Username" id="" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>">
            <i class='bx bx-user' ></i>
        </div>
        
        <div class="input-field">
            <input type="text" name="email" class="input" placeholder="email" id="" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
            <i class='bx bx-user' ></i>
            
        </div>

        <div class="input-field">
            <input type="Password" name="password" class="input" placeholder="Password" id="">
            <i class='bx bx-lock-alt'></i>
        </div>

        <div class="input-field">
            <input type="Password" name="passwordconfirm" class="input" placeholder="check Password" id="">
            <i class='bx bx-lock-alt'></i>
        </div>
        <p class="error">
            <?php
            echo $errors[0];
            ?>
        </p>
        <div class="input-field">
            <input type="submit" class="submit" value="signup" id="" name="signup">
        </div>
        <br>
        <div class="input-field" >
            <a href="index.php"><input type="submit" class="submit" value="login" name="login"></a>
        </div>



    </form>
</div>  
</body>
</html>