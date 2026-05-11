<?php
include_once '../tools/common.php';

assert_session();


include_header("../styles/home.css")

    ?>
<!-- <link rel="stylesheet" href="../styles/home.css"> -->

<div class="sidebar ct-container ct-affected ct-active">
    <div class="sidebar-container">
        <div class="top">
            <img class="ct-toggler clickable" src="../images/site_images/x.svg" alt="Close">
        </div>
        <form class="filter-area" method="get">

            <button class="clickable search-button" type="submit">Search</button>

            <div class="top">
                <h2>Filters</h2>
            </div>

            <div class="filters">
                <div class="rating">
                    <h3>Rating</h3>
                    <label>Min Rating: <input type="number" name="min_rating" min="0" max="5" step="0.1"
                            value="<?= $_GET['min_rating'] ?? '0' ?>"></label>
                    <label>Max Rating: <input type="number" name="max_rating" min="0" max="5" step="0.1"
                            value="<?= $_GET['max_rating'] ?? '5' ?>"></label>
                </div>
                <div class="playtime">
                    <h3>Playtime</h3>
                    <label>Min Playtime: <input type="number" name="min_playtime" min="0" step="1"
                            value="<?= $_GET['min_playtime'] ?? '0' ?>"></label>
                    <label>Max Playtime: <input type="number" name="max_playtime" min="0" step="1"
                            value="<?= $_GET['max_playtime'] ?? '' ?>"></label>
                </div>
                <div class="platforms">
                    <h3>Platforms</h3>
                    <?php

                    // Get all platforms
                    $platforms = get_all_platforms();

                    // Get previously selected platforms
                    $selected_platforms = $_GET['platforms'] ?? [];

                    foreach ($platforms as $platform) {
                        // Check if current platform was selected
                        $checked = in_array($platform, $selected_platforms);
                        ?>
                        <label><input type="checkbox" name="platforms[]" value="<?php echo $platform; ?>" <?php echo $checked ? 'checked' : ''; ?>><?php echo $platform; ?></label>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="content">
    <h1>Games</h1>

    <div class="game-cards">
        <?php
        echo var_dump($_GET);

        $gamez = get_games_from_database($_GET);

        foreach ($gamez as $game_data) {
            game_card($game_data);
        }
        ?>
    </div>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>
    <h2>
        hello
    </h2>

</div>
<script src="../tools/class toggler/class toggler.js"></script>

<!-- <a href="admin.php">admin page</a> -->