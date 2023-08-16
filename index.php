<?php
use RssFeedReader\RssParser\RssParser;
use RssFeedReader\Store\UrlStoreModel;

require_once __DIR__ . "/vendor/autoload.php";

$urlModel = new UrlStoreModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'] ?? false;

    if (!$url) {
        echo "URL not found";
        exit;
    }

    $line = [$url];
    $urlModel->insertUrl($line);
}

$urls = $urlModel->getAllUrls();


$parser = new RssParser();

$items = [];

foreach ($urls as $url) {
    $data = $parser->getAllItems($url[0]);
    array_push($items, ...$data);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <form method="POST">
            <div class="form-group">
                <label for="url-inp">URL</label>
                <input class="form-control" type="url" id="url-inp" name="url" placeholder="enter the URL">
            </div>
            <button class="btn btn-primary">Add</button>
        </form>

        <div class="container">
            <?php foreach ($items as $item): ?>
                <div class="card row">
                    <div class="col">
                        <h3><?= $item['title'] ?></h3>
                        <p><?= $item['description'] ?></p>
                        <a href="<?= $item['link']?>"><?= $item['link'] ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>