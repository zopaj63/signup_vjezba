<?php

require "autoload.php";

$config=new Config("config.ini");
$db=Database::getInstance($config);
$conn=$db->getConnection();

if (isset($_POST['login']))
{
    $email_login=$_POST['email'];
    $lozinka_login=$_POST['lozinka'];

    // dohvat iz baze
    $stmt=$conn->prepare("SELECT * FROM korisnici WHERE email=:email");
    $stmt->bindParam(":email", $email_login);
    $stmt->execute();

    $user=$stmt->fetch(); // asocijativni niz korisnika s tim emailom


    //test
    // print_r(array_values($user));


    if ($user && password_verify($lozinka_login, $user['lozinka'])) // provjera imamo li korisnika i usporedba unešene i hashirane lozinke iz baze
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