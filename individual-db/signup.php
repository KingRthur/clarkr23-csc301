<?php
require_once ('dbCl.php');

function signup(){
    if(count($_POST)>0){
        $pdo = connectDB();

        //Validate email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return('The email you entered is not valid.');
        $_POST['email']=strtolower($_POST['email']);

        //Validate password
        $_POST['password']=trim($_POST['password']);
        if(strlen($_POST['password']) < 8) return('The password must be at least 8 characters.');

        //Check if email is already registered
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$_POST['email']]);
        $numMatched = $stmt->rowCount();
        if($numMatched > 0){
            return('That email has already been registered.');
        }

        //Check if username is already registered
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$_POST['username']]);
        $numMatched = $stmt->rowCount();
        if($numMatched > 0){
            return('That username has already been registered.');
        }
        
        //Encrypt password
        $_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);

        //Insert data into the DB
        $userAtts = ['username' => $_POST['username'], 'password' => $_POST['password'], 'email' => $_POST['email']];
        try{
            $pdo->beginTransaction();
            $stmt = $pdo->prepare('INSERT INTO `users` (`username`, `password`, `email`) VALUES (:username,:password,:email)');
            $stmt -> execute($userAtts);
            $pdo->commit();
            //return "";
            //Notify user.
            echo "<p>Account successfully created!</p>";
            echo '<script type="text/JavaScript">window.location.replace("signin.php?redir=account-created");</script>';
            //Welcome
            echo 'You successfully registered your account. You may now <a href="signin.php">Sign in</a>.';
        }
        catch (Exception $e){
                $pdo->rollback();
                throw $e;
        }
    }
}

if(count($_POST)>0){
    $error=signup();
    if(isset($error[0])) echo $error;
}

?>

<form action="signup.php" method="POST">
    Register an account:<br/>
    Username
    <input type="text" name="username" required /><br />
    Email
    <input type="email" name="email" required /><br />
    Password
    <input type="password" name="password" required minlength=8 /><br />
    <button type="submit">Create account</button>
</form>