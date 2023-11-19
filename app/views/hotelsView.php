<?php
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hotels</title>
</head>
<style>
    a {
        font-weight: bold;
        text-decoration: none;
        color: black;
    }
</style>

<body>
    <h1>Hotels List</h1>
    <?php
    $_SESSION['asd'] = 'asd';
    $mo = $_SESSION['asd'];
    // var_dump($users) 
    ?>
    <ul>
        <?php foreach ($hotels as $hotel) { ?>
            <li>
                <?= $hotel['name']; ?>
                <br>
                <br>
                <button>
                    <a href="show?id=<?= $hotel["id"] ?>">show hotel information</a>
                </button>
                <button>
                    <a href="update?id=<?= $hotel["id"] ?>">edit hotel information</a>
                </button>
                <button>
                    <a href="delete?id=<?= $hotel["id"] ?>">delete hotel information</a>
                </button>
                <br>
                <br>
            </li>
        <?php } ?>
    </ul>