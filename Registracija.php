<?php


        echo '
            <h2>Registracijska forma</h2>
            <hr>
            <p>Ispunite sve podatke:</p>
            <form method="post" action="NekiController.php">
                <input type="text" name ="ime" placeholder="Ime" required><br><br>
                <input type="text" name ="prezime" placeholder="Prezime" required><br><br>
                <input type="email" name ="email" placeholder="E-mail" required><br><br>
                <input type="password" name ="lozinka" placeholder="Lozinka" required><br><br>
                <input type="password" name ="lozinkap" placeholder="Ponovljena lozinka" required><br><br>

                <input type="submit" value="Registriraj se">
            </form>
        ';





?>