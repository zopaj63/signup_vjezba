<?php

require "autoload.php";

$config=new Config("config.ini");
$db=Database::getInstance($config);
$conn=$db->getConnection();

if (isset($_POST['registracija']))
{
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $email=$_POST['email'];
    $lozinka=$_POST['lozinka'];
    $lozinkap=$_POST['lozinkap'];

    if($lozinka===$lozinkap) // usporedba lozinke i ponovljene lozinke
    {
        // dohvat iz baze
        $stmt=$conn->prepare("SELECT email FROM korisnici WHERE email=:email"); // traženje upisanog emaila u bazi
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user=$stmt->fetch(); // stvara asocijativni niz

        if (!$user) // ako upisani mail ne postoji...
        {
            $token=bin2hex(random_bytes(16)); // kreiranje tokena
            $lozinka_hash=password_hash($lozinka, PASSWORD_DEFAULT);  // hashiranje lozinke

            // upis korisnika u bazu
            $stmt=$conn->prepare("INSERT INTO korisnici (ime, prezime, email, lozinka, token) VALUES (:ime, :prezime, :email, :lozinka, :token)");
            $stmt->bindParam(":ime", $ime);
            $stmt->bindParam(":prezime", $prezime);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":lozinka", $lozinka_hash);
            $stmt->bindParam(":token", $token);

            if($stmt->execute())
            {
                $message_good= "Uspješna registracija";
            }
            else
            {
                $message_bad= "Došlo je do greške";
            }
        }
        else
        {
            $message_bad= "Korisnik s tim mailom već postoji";
        }

    }
    else
    {
        $message_bad= "Lozinka i ponovljena lozinka se ne podudaraju";
    }

}

?>
        <p>Već ste registrirani?</p>
        <button onclick="window.location.href='./Login.php';">Log in</button>
        <hr>
        <h2>Registracijska forma</h2>
            <hr>
            <p>Ispunite sve podatke:</p>
            <form method="post" action="">
                <input type="text" name ="ime" placeholder="Ime" required><br><br>
                <input type="text" name ="prezime" placeholder="Prezime" required><br><br>
                <input type="email" name ="email" placeholder="E-mail" required><br><br>
                <input type="password" name ="lozinka" placeholder="Lozinka" required><br><br>
                <input type="password" name ="lozinkap" placeholder="Ponovljena lozinka" required><br><br>

                <input type="submit" name="registracija" value="Registriraj se">
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
