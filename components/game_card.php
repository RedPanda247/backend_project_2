<?php
// include_once '../styles/game-card.css';

if (!isset($game_data)) {
    die;
}

?>

<link rel="stylesheet" href="../styles/game-card.css">

<div class="game-card">
    <div class="top">
        <img src="<?php echo $game_data["background_image"]; ?>" alt="">
    </div>
    <div class="bottom">
        <div class="title">
            <?php echo $game_data["name"]; ?>
        </div>
        <div class="plattforms">
            <?php foreach ($game_data["parent_platforms"] as $data) {
                $platform = $data["platform"];
                ?> 
                <img src="<?php echo "../images/icons/" . $platform["slug"] . ".svg" ?>" alt="platform logo">
                <?php
                echo $platform["slug"];
            } ?>
        </div>
        <div class="icon-info">
            <div class="rating">
                <?php echo $game_data["rating"] ?>
            </div>
            <div class="comments">

            </div>
        </div>
    </div>
</div>