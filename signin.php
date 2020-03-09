<?php

/*
1. Show signin form
2. When user submits form
    2.1 check and validate email
    2.2 check for password and validate
    2.3 check db for email
    2.4 check db for password (password_verify($password, $hash))
    2.5 congratulate user
*/

?>

<?php
function signin(){
    $emailCheck = 'false';
    $passCheck = 'false';
    if(count($_POST)>0){
        //Check for database
        if(!file_exists('database.csv.php')){
            $h=fopen('database.csv.php','w+');
            fwrite($h,'');
            fclose($h);
        }

        //Validate email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return('The email you entered is not valid.');
        $_POST['email']=strtolower($_POST['email']);

        //Validate passwrod
        $_POST['password']=trim($_POST['password']);
        if(strlen($_POST['password']) < 8) return('The password must be at least 8 characters');

        //Check for email
        $h=fopen('database.csv.php', 'r');
        while(!feof($h)){
            $line=fgets($h);
            if(strstr($line,$_POST['email'])) $emailCheck = 'true';
        }
        fclose($h);
        
        //TODO Encrypt password
        //$_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);

        //Check for password
        $h=fopen('database.csv.php', 'r');
        while(!feof($h)){
            $line=fgets($h);
            if(strstr($line,$_POST['password'])) $passCheck = 'true';
        }
        fclose($h);
        
        //Check if credentials were found and start session.
        if ($emailCheck == 'true' && $passCheck == 'true'){
            session_start();
            echo 'You have successfully signed into your account. You may now <a href="index.php">Return to home.</a>.';
            return "";
        }
        else{
            echo 'Something went wrong. Please try again.';
            //Error check
            //echo 'Email? '.$emailCheck.' Password? '.$passCheck;
            return "";
        }
    }
}
if(count($_POST)>0){
    $error=signin();
    if(isset($error[0])) echo $error;
}

?>

<form action="signin.php" method="POST">
    Sign in to your account:<br />
    Email
    <input type="email" name="email" required /><br />
    Password
    <input type="password" name="password" required minlength=8 /><br />
    <button type="submit">Sign into account</button>
</form>