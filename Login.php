<?php

require_once "./Database.php";

$db=new Database();
$pdo=$db->connect();

if (isset($_POST['login']))
{
    $email_login=$_POST['email'];
    $lozinka_login=$_POST['lozinka'];

    
    $stmt=$pdo->prepare("SELECT * FROM korisnici WHERE email=:email");
    $stmt->bindParam(":email", $email_login);
    $stmt->execute();

    $user=$stmt->fetch();


    //test
        // print_r(array_values($user));


    if ($user && password_verify($lozinka_login, $user['lozinka']))
    {
        echo "Uspješan login";
    }
    else
    {
        echo "Login nije uspio";
    }

}

?>

        <h2>Login forma</h2>
            <hr>
            <p>Unesite mail i lozinku</p>
            <form method="post" action="">
                <input type="email" name ="email" placeholder="E-mail" required><br><br>
                <input type="password" name ="lozinka" placeholder="Lozinka" required><br><br>

                <input type="submit" name="login" value="Log in">
            </form>
