
<?php 
include 'db.php';

if (!isset($_SESSION["id"])) {
    header("Location:login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = $conn -> prepare("select * from blog where id = ? and user_id = ?");
    $sql -> bind_param("ii", $id, $_SESSION["id"]);
    $sql -> execute();

    $output = $sql -> get_result();
    $result = $output -> fetch_assoc();

    if (!$result) {
        header("Location:dashboard.php");
        exit;
    }
} else {
    header("Location:dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $id = $_POST["id"];

    $sql = $conn -> prepare(
        "update blog set title = ?, contnet = ? where id = ? and user_id = ?"
    );

    $sql -> bind_param("ssii", $title, $content, $id, $_SESSION["id"]);

    if ($sql -> execute()) {
        header("Location:dashboard.php");
        exit;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Edit Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <main>
        <h2 class="text-center mt-3">Edit Blog</h2>

        <div class="container col-7 my-3 p-3 border rounded shadow">

            <form action="" method="POST">

                <input type="hidden" name="id" value="<?= $result["id"] ?>">

                <div class="mb-3">
                    <label class="form-label">Blog Title</label>
                    <input
                        type="text"
                        class="form-control"
                        name="title"
                        value="<?= $result["title"] ?>"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">Blog Content</label>
                    <textarea
                        class="form-control"
                        name="content"
                        rows="4"
                        required
                    ><?= $result["contnet"] ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning">
                    Update Blog
                </button>

                <a href="dashboard.php" class="btn btn-secondary">
                    Cancel
                </a>

            </form>
        </div>
    </main>
</body>
</html>
