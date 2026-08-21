<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard |
        <?php /** @var string $title */
        echo "{$title}" ?? "";
        ?>
    </title>
    <link rel="stylesheet" href="/assets/css/shop.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <script src="/assets/sweatAlert/sweat.js"></script>
</head>

<body>

    <!-- header -->


    <!-- parent/conteneur principale div1 d-flex -->
    <div class="sidebar">

        <!-- sidenav div2 width 20%-->
        <div class="sidebar-nav">

            <?php require_once PATH . "/views/partials/_nav-shops.html.php" ?>

        </div>

        <!-- Main div3 width 80%-->
        <?php require_once PATH . '/views/partials/header_shop.html.php' ?>