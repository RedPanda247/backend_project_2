<?php
// include_once '../styles/game-card.css';

?>

<link rel="stylesheet" href="../styles/game-card.css">

<div class="game-card">
    <div class="top">
        <img src="<?php echo $game_data["background_image"]; ?>" alt="">
    </div>
    <div class="bottom">
        <div class="title">
            <h3><?php echo $game_data["name"]; ?></h3>
        </div>
        <div class="plattforms">
            <?php foreach ($game_data["parent_platforms"] as $platform) {
                ?>
                <img src="<?php echo "../images/icons/" . $platform . ".svg" ?>" alt="platform logo">
                <?php
                // echo $platform;
            } ?>
        </div>
        <div class="icon-info">
            <div class="rating">
                <img src="../images/icons/star.svg" alt="star">
                <h3><?php echo $game_data["rating"] ?></h3>
            </div>
            <div class="comments">
                <img src="../images/icons/chat-icon.svg" alt="chat bubble">
                <h3>4</h3>
            </div>
            <div class="playtime">
                <img src="../images/icons/timer.svg" alt="timer">
                <h3><?php echo $game_data["playtime"] . "h" ?></h3>
            </div>
        </div>
    </div>
</div>