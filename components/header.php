<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h2>Profile</h2>
        </div>
    </header>
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
                }

                &.right {
                    flex-direction: row;
                    justify-content: end;
                }
            }

        }
    </style>