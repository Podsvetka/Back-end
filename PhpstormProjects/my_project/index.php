<?php
$title = "";
$total = 0;
$items = [];

if (isset($_GET["search"]) && !empty($_GET["search"])) {
    $json = file_get_contents("https://www.googleapis.com/customsearch/v1?key=AIzaSyAJGaw8xbkehi95j_DGMWTDiGtA7lnZ9rI&cx=b5f4e47c12f3f4f62&q=" . $_GET["search"]);
    $data = json_decode($json, true);

    if ($json !== false) {
        $data = json_decode($json, true);

        if (isset($data["queries"]["request"][0])) {
            $title = $data["queries"]["request"][0]["title"];
            $total = $data["queries"]["request"][0]["totalResults"];
        } else {
            $title = "No results found.";
        }

        if (isset($data["items"])) {
            $items = $data["items"];
        }
    } else {
        $title = "Failed to fetch data.";
    }
} else {
    $title = "Please enter a search query.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>My Browser</h2>
<form method="GET" action="index.php">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" value=""><br><br>
    <input type="submit" value="Submit">
</form>
<?php echo $title ?>
</h2>

<?php
foreach ($data["items"] as $item) {

    ?>
    <div >
        <div >
            <a target="_blank" href="<?php echo $item["link"] ?>">
                <?php echo $item["title"] ?>
            </a>
        </div>
        <div><?php echo $item["displayLink"] ?></div>
        <div"><?php echo $item["snippet"] ?></div>
    </div>

    <?php
}
?>
</body>
</html>



