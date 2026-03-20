<?php
assert_session();

include_flash_message();

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

            height: 6rem;


            .left,
            .left a {
                height: 100%;

                img {
                    height: 100%;
                }
            }

            &>* {
                display: flex;
                align-items: center;
                flex: 1;

                min-width: fit-content;

                &.left {}

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
    <link rel="stylesheet" href="../styles/common.css">
    <!-- Apply site specific css after to override common.css -->
    <?php if (isset($optional_css_path)) { ?>
        <link rel="stylesheet" href="<?php echo $optional_css_path; ?>"> <?php
    } else {
        echo "css path null";
    } ?>
</head>

<body>

    <header>
        <div class="left">
            <a href="../sites/home.php">
                <img src="../images/site_images/logo.png" alt="">
            </a>
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