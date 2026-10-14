
<?php
include 'db.php';

if (!isset($_SESSION["id"])) {
    header("Location:login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conn -> prepare("delete from blog where id = ? and user_id = ?");
    $sql -> bind_param("ii", $id, $_SESSION["id"]);

    if ($sql -> execute()) {
        header("Location:dashboard.php");
        exit;
    }
}

header("Location:dashboard.php");
exit;
?>
