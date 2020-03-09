<?php

class User {
    public $name;
    public $email;
    private $password;
    
    
}

public function signIn(){
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

public function signOut(){
    $_SESSION=[];
    session_destroy();
}

public function signUp(){
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
            if(strstr($line,$_POST['email'])) return('The email is already registered.');
        }
        fclose($h);

        //TODO Encrypt password
        //$_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);

        //Apppend data to a file
        $h=fopen('database.csv.php','a+');
        fwrite($h,implode(';',[$_POST['email'],$_POST['password']])."\n");
        fclose($h);

        //Welcome
        echo 'You successfully registered your account. You may now <a href="signin.php">Sign in</a>.';
        return "";
    }
}

?>
