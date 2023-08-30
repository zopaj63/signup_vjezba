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
        $message_good= "Uspješan login";
    }
    else
    {
        $message_bad= "Login nije uspio";
    }

}

?>
        <p>Niste registrirani?</p>
        <button onclick="window.location.href='./Registracija.php';">Registracija</button>
        <hr>
        <h2>Login forma</h2>
            <hr>
            <p>Unesite mail i lozinku</p>
            <form method="post" action="">
                <input type="email" name ="email" placeholder="E-mail" required><br><br>
                <input type="password" name ="lozinka" placeholder="Lozinka" required><br><br>

                <input type="submit" name="login" value="Log in">
            </form>
            <hr>

<?php if ($message_good) ?>
    <h3 style="color: darkgreen";><?php echo $message_good; ?></h3>
<php endif; ?>
    
<?php if ($message_bad) ?>
    <h3  style="color: red";><?php echo $message_bad; ?></h3>
<php endif; ?>

<hr>
<a href="https://github.com/zopaj63/signup_vjezba" target="_blank">Git<a/>