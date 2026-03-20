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
</div>