<?php
assert_session();
?>
<div class="flash-messages-container">
    <?php
    // If flash message doesn't exist replace with empty array
    // Loop over flash messages
    foreach ($_SESSION["flash_messages"] ?? [] as $flash_message) {
    ?>
        <div class="flash-message">
            <h2><?php echo $flash_message; ?></h2>
        </div>
    <?php
    }

    // Delete flash messages
    $_SESSION["flash_messages"] = [];
    ?>
</div>

<style>
    .flash-messages-container {
        position: fixed;
        width: 100%;

        display: flex;
        flex-direction: column;
        align-items: center;

        /* Make it so this container does not block clicking on items under it */
        pointer-events: none;
    }

    /* Styling for flash message */
    .flash-message {

        /* Reenable pointer events for the messages to allow hover detection */
        pointer-events: auto;

        box-shadow: 4px 4px 4px black;
        padding: 2rem;
        background-color: darkgray;
        border-radius: 1rem;

        animation: flash_fade_out 4s linear forwards;

        display: flex;
        justify-content: center;
        align-items: center;

        /* Allow the hover scale to transition separatly from animation */
        transition: opacity 0.5s;
    }

    /* Pause the fade out animation if the user is hovering the message so they have time to read */
    /* Scale the massage to make it more clear that something actually happens when hovering */
    .flash-message:hover {
        animation-play-state: paused;
        scale: 1.05;
    }

    @keyframes flash_fade_out {
        0% {
            scale: 1;
        }

        90% {
            scale: 0.8;
        }

        100% {
            scale: 0.01;
        }
    }
</style>
<script>
    // Get all flash messages and hide them when their animation ends
    document.querySelectorAll('.flash-message').forEach(function(msg) {
        msg.addEventListener('animationend', function() {
            msg.style.display = 'none';
        });
    });
</script>