<?php
    include "./connection.php";

    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        switch ($action) {
            case "assesment":
                echo checkOnDB() ? insertToDB() : updateToDB();
                break;
            case "getTopRank":
                getToDB();
                break;
            case "getProfile":
                getProfile();
                break;
        }
    }

    function checkOnDB() {
        $player_id = $_POST["player_id"];
        $check = conn()->query("Select * from game_play where player_id=$player_id");
        if ($check->num_rows > 0) return false;
        return true;
    }

    function insertToDB() {
        $player_id = $_POST["player_id"];
        $wpm = $_POST["wpm"];
        $current_date = date("Y-m-d H:i:s");
        $insertStatus = conn()->query("Insert into game_play values(
            '',
            $player_id,
            $wpm,
            '$current_date'
        )");
        updateToDBPlayer();
        return $insertStatus ? 200:404;
    }

    function updateToDB() {
        $player_id = $_POST["player_id"];
        $wpm = $_POST["wpm"];
        $current_date = date("Y-m-d H:i:s");
        $updateStatus = conn()->query("update game_play set wpm='$wpm', tanggal='$current_date' where player_id='$player_id'");
        updateToDBPlayer();
        return $updateStatus ? 200:404;
    }

    function updateToDBPlayer() {
        $player_id = $_POST["player_id"];
        $xp = (($_POST["wpm"] * 2) / 3);
        $current_date = date("Y-m-d H:i:s");
        $updateStatus = conn()->query("update players set log='$current_date', xp=xp+'$xp' where id='$player_id'");

        $check = conn()->query("Select * from players where id='$player_id'");
        createSession($check->fetch_object());
        return $updateStatus;
    }

    function getToDB() {
        $fetch = conn()->query("Select * from view_game_play order by wpm desc");
        while ($item = $fetch->fetch_object()) {
            ?>
            <div class="w3-padding w3-white w3-row w3-border-bottom">
                <div class="w3-left">
                    <img src="./assets/image/user.png" style="max-width: 48px" class="w3-margin w3-circle w3-card">
                </div>
                <div class="w3-left">
                    <div class="w3-text-blue w3-large w3-margin-top"><?php echo $item->full_name; ?></div>
                    <div class="w3-text-dark-grey">
                        <span class="w3-large"><?php echo $item->xp; ?></span>
                        XP
                        <span class="w3-large"><?php echo $item->wpm; ?></span>
                        WPM
                    </div>
                </div>
                <span class="w3-right w3-text-grey"><?php echo $item->tanggal; ?></span>
            </div>
            <?php
        }
    }

    function getProfile() {
        $player_id = $_POST["player_id"];
        $check = conn()->query("Select * from players where id='$player_id'");
        while ($item = $check->fetch_object()) {
            ?>
            <div class="w3-padding w3-white w3-round w3-row w3-card">
                <div class="w3-col m4">
                    <img src="./assets/image/user.png" style="max-width: 100%" class="w3-margin w3-circle w3-card">
                </div>
                <div class="w3-col m8">
                    <div class="w3-text-blue w3-xlarge w3-margin-top"><?php echo $item->full_name; ?></div>
                    <div class="w3-text-dark-grey">
                        <span class="w3-xxxlarge"><?php echo $item->xp; ?></span>
                        XP
                    </div>
                </div>
            </div>
            <?php
        }
    }

    function createSession($userAuth) {
        session_start();
        $_SESSION["userAuth"] = $userAuth;
    }
?>