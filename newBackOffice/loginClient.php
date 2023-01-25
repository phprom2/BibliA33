<?php
$login = ($_POST["login"]);
$pwd = md5(($_POST["pwd"]));

require '../sqlconnect.php';
$sql = "SELECT *  FROM client WHERE CLIENT_MAIL = ? AND CLIENT_MDP = ?";

$stmt = $connection->prepare($sql);
$stmt->bindValue(1, $login);
$stmt->bindValue(2, $pwd);
$stmt->execute();
$result = $stmt->fetch();
$count = $stmt->rowCount();

if ($count > 0) {
    session_start();
    $_SESSION['CLIENT_MAIL']=$login;
    $_SESSION['CLIENT_ID']=$result['CLIENT_ID'];
    header('Location: accueilClient.php');
} else {
    ?>
    <script>alert("Erreur: Nom d'utilisateur ou mot de passe incorrect.");
            window.location.href = "../connexionClient.php";
    </script>
    <?php
}

?>

