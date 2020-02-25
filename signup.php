<?php
function signup(){
    if(count($_POST)>0){
        //Check for database
        if(!file_exists('database.csv')){
            $h=fopen('database.csv','w+');
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
        $h=fopen('database.csv', 'r');
        while(!feof($h)){
            $line=fgets($h);
            if(strstr($line,$_POST['email'])) return('The email is already registered.');
        }
        fclose($h);

        //Encrypt password
        $_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);

        //Apppend data to a file
        $h=fopen('database.csv','a+');
        fwrite($h,implode(';',[$_POST['email'],$_POST['password']])."\n");
        fclose($h);

        //Welcome
        echo 'You successfully registered your account. You may now <a href="signin.php">Sign in</a>.';
        return "";
    }
}
if(count($_POST)>0){
    $error=signup();
    if(isset($error[0])) echo $error;
}

?>

<form action="signup.php" method="POST">
    Email
    <input type="email" name="email" required /><br />
    Password
    <input type="password" name="password" required minlength=8 /><br />
    <button type="submit">Create account</button>
</form>