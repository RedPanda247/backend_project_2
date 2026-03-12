<?php
assert_session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        header {
            padding: 1.5rem;
            background-color: #111155;

            display: flex;

            &>* {
                display: flex;
                align-items: center;
                flex: 1;

                min-width: fit-content;

                &.left {
                    flex-direction: row;
                }

                &.center {
                    flex-direction: row;
                    justify-content: center;
                    gap: 2rem;
                }

                &.right {
                    flex-direction: row;
                    justify-content: end;
                }
            }

        }
    </style>
</head>

<body>
    <link rel="stylesheet" href="../styles/common.css">
    <header>
        <div class="left">
            <h2>Game libraryx</h2>
        </div>
        <div class="center">
            <a href="../sites/home.php">
                <h2>Home</h2>
            </a>
            <a href="../sites/home.php">
                <h2>Home</h2>
            </a>
            <a href="../sites/home.php">
                <h2>Home</h2>
            </a>
            <a href="../sites/home.php">
                <h2>Home</h2>
            </a>
        </div>
        <div class="right">
            <?php
            if (isset($_SESSION["logged_in"])) {
                ?>
                <a href="../sites/profile.php">
                    <h2>Profile</h2>
                </a>
                <?php
            } else {
                ?>
                <a href="../sites/login.php">
                    <h2>Login</h2>
                </a>
                <?php
            }
            ?>
        </div>
    </header>
    <main>