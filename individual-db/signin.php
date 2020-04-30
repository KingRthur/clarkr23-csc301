<?php
require_once ('dbCl.php');

function signin(){
    $emailCheck = 'false';
    $passCheck = 'false';
    if(count($_POST)>0){
        $pdo = connectDB();

        //Validate email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return('The email you entered is not valid.');
        $_POST['email']=strtolower($_POST['email']);

        //Validate password
        $_POST['password']=trim($_POST['password']);
        if(strlen($_POST['password']) < 8) return('The password must be at least 8 characters.');

        
        //Fetch account details by email
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$_POST['email']]);
        $numMatched = $stmt->rowCount();
        if($numMatched > 0){
            //Verify password from account
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($_POST['password'],$row['password'])){
                session_start();
                $_SESSION['user_id']=$row['id'];
                echo 'You have successfully signed into your account. You may now <a href="index.php">Return to home.</a>.';
                return "";
            }
            else return 'Incorrect password. Please try again.';
        }
        else return 'That email has not been registered. Please register an account.';
        
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
    <input type="password" name="password" required minlength=8 required/><br />
    <button type="submit">Sign into account</button>
</form>