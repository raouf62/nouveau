<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script type="text/javascript">
        function validationFormulaire() {
            var x = document.forms["formContact"]["messageContact"].value;
            if ((x == null) || (x == '')) {
                alert("Vous avez oublié d'insérer un message");
                return false;
            }
        }

    </script>
</head>

<body>


    <?php
   
    
    if (isset ($_POST["envoyez"])) {
        if (!isset($_POST['messageContact']) || ($_POST["messageContact"]=="")){
           echo "veullez saisir un message"; 
        }
        else {
            if (!isset($_POST['email']) || ($_POST['email']=='')){
                $_POST['email']='';
            }
            
            elseif (isset($_POST['autorisation'])){
                $adressMail = $_POST['email'];
                $db = new PDO("mysql:host=exmachinefmci.mysql.db; dbname=exmachinefmci; charset=UTF8", 'exmachinefmci', "carp310M");
                $resultat = $db->prepare('INSERT INTO `raouf`(`mail`) VALUES (:adressMail)');
                $resultat->execute(array('adressMail'=>$adressMail));
            }    
            
            $message = 'Vous avez revcu un message via votre site internet, le voici: ' .$_POST['messageContact'];
            $headers = 'MIME-Version: 1.0' ."\r\n";
            $headers .= 'content-type: text/html; charset=UTF8' .'\r\n';
            $headers .= 'From: '.$_POST['email'].'\r\n'.'Reply-To: ' .$_POST['email']."\r\n".'X-Mailer: PHP/'.phpversion();
            mail ('bendiab-abderraouf@hotmail.fr', 'formulaire de contact', $message, $headers);
                // confirmation
                echo ('Votre message a &eacute;t&eacute; envoy&eacute; <br>');
            
        }
    }
   
   ?>





    <form method="post" name="formContact" onsubmit="validationFormulaire()">
        <br>
        <a href="index.html">retour au CV</a>
        <br><br>
        <fieldset style="width: 600px">
            <legend>ID</legend>
            <label for="nom">Nom</label>
            <input type="text" name="nom" autofocus placeholder="Votre nom">
            <br><br>
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" placeholder="Votre prénom">
            <br><br>
            <label for="email">Mail</label>
            <input type="email" name="email" placeholder="*****@mail.com">
            <br><br>
            <label for="tel">Tel</label>
            <input type="tel" placeholder="Votre numéro de téléphone" size="30">
        </fieldset>
        <br><br>
        <fieldset style="width: 600px">
            <legend>Message </legend>
            <textarea cols="50" rows="20" name="messageContact"></textarea>
            <br><br>
            <input type="checkbox" name="autorisation">
            <label>Je vous autorise à conserver ces coordonnées</label>
            <br><br>
        </fieldset>
        <input type="submit" name="envoyez" value="envoyez">
    </form>

    <!--
    <form>
        <input type="text" name="">
        <select>
            <option></option>
            <option></option>
            <option></option>
        </select>
        <textarea></textarea>
        <input type="submit" value="envoyez">
    </form>
-->
</body>

</html>
