<?php
    require 'snap.php';
    session_start();

    if(!isset($_SESSION['snap']) || isset($_GET["players"])) {
        $players = is_numeric($_GET["players"]) ? $_GET["players"] : 2;

        $_SESSION["snap"] = new Snap($players);
    }

    if (isset($_POST["player"])) {
        $_SESSION["snap"]->playCard($_POST["player"]);
    }
?>

<head>
    <title>Snap</title>
</head>
<body>
Next Player:
    <div id="centrePile">
        Centre Pile: <?=$_SESSION["snap"]->getCentrePileCount();?> card(s)
        Top Card: <?php print_r($_SESSION["snap"]->viewCentrePileTopCard());?>
    </div>

    <?php
        for ($players = 0; $players < $_SESSION["snap"]->getPlayers(); $players++) {
            ?>
            <form name="play" method="POST">
                <div id="player<?=$players?>">
                    Player <?=$players+1?>:
                    <?=$_SESSION["snap"]->getCardCount($players);?> Cards.
                    <input name="player" type="hidden" value="<?=$players?>">
                    <input type="submit" value="Play Card">
                </div>
            </form>

            <?php
        }
    ?>
