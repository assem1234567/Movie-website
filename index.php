<?php
session_start();
if(isset($_SESSION['person']))
{
    header('location:home.php');
    exit();
}
if(isset($_POST['login']))
{
    include 'connection.php';
    $name=filter_var($_POST['username'],FILTER_SANITIZE_STRING);
    $password=filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $errors=[];
    if(empty($name))
    {
        $errors[]="Name is required";
        //header('location:login.php');
    }
    if(empty($password))
    {
        $errors[]="Password is required";
        //header('location:login.php');
    }
    if(empty($errors))
    {

        $stm="SELECT * FROM person WHERE name='$name'";
        $q=$conn->prepare($stm);
        $q->execute();
        $data=$q->fetch();
        if(!$data)
        {
            $errors[]="Wrong username";
            //header('location:login.php');
        }
        else
        {

            $password_hash=password_hash($data['password_hash'] , PASSWORD_DEFAULT);
            if(!password_verify($password,$password_hash))
            {
                $errors[]="Wrong password";
               // header('location:login.php');
            }
            else
            {
                $stm="SELECT email FROM person WHERE name='$name'";
                $see=$conn->query($stm);
                foreach ($see as $v1)
                {
                    foreach ($v1 as $v2)
                    {
                        $email=$v2;break;
                    }
                    break;
                }
                $_SESSION['person']=[
                    "name"=>$name,
                    "email"=>$email,
                ];
                header('location:home.php');
            }
        }
    }

}
else if(isset($_POST['signup']))
{
    header('location:signup.php');
}


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
    <form class="container" action="index.php" method="post" novalidate>

        <div class="top">
            <header>Login</header>
        </div>

        <div class="input-field">
            <input type="text" class="input" placeholder="Username" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];} ?>">
            <i class='bx bx-user' ></i>
        </div>

        <div class="input-field">
            <input type="Password" class="input" name="password" placeholder="Password" id="">
            <i class='bx bx-lock-alt'></i>
        </div>
        <p class="error">
            <?php
            echo $errors[0];
            ?>
        </p>

        <div class="input-field">
            <input type="submit" class="submit" value="Login" id="" name="login">
        </div>
        <br>
        <div>
            <a href="signup.php"><input type="submit" class="submit" value="signup" name="signup"></a>
        </div>


        <div class="two-col">
            <!-- <div class="one">
               <input type="checkbox" name="" id="check">
               <label for="check"> Remember Me</label>
            </div> -->
            
            <!-- <div class="two">
                <label><a href="#">signup</a></label>
            </div> -->
        </div>

    </form>


</div>  
</body>
</html>