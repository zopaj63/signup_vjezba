<?php

require_once "./Database.php";

$db=new Database();
$pdo=$db->connect();

if (isset($_POST['registracija']))
{
    $ime=$_POST['ime'];
    $prezime=$_POST['prezime'];
    $email=$_POST['email'];
    $lozinka=$_POST['lozinka'];
    $lozinkap=$_POST['lozinkap'];

    if($lozinka===$lozinkap)
    {
        $stmt=$pdo->prepare("SELECT email FROM korisnici WHERE email=:email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $user=$stmt->fetch();

        if (!$user)
        {
            $token=bin2hex(random_bytes(16));
            $lozinka_hash=password_hash($lozinka, PASSWORD_DEFAULT);

            $stmt=$pdo->prepare("INSERT INTO korisnici (ime, prezime, email, lozinka, token) VALUES (:ime, :prezime, :email, :lozinka, :token)");
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
