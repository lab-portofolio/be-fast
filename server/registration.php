<?php
    include "./connection.php";

    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        switch ($action) {
            case "join":
                echo checkOnDB() ? insertToDB() : updateToDB();
                break;
        }
    }

    function checkOnDB() {
        $full_name = $_POST["full_name"];
        $check = conn()->query("Select * from players where full_name='$full_name'");
        createSession($check->fetch_object());
        if ($check->num_rows > 0) return false;
        return true;
    }

    function insertToDB() {
        $full_name = $_POST["full_name"];
        $current_date = date("Y-m-d H:i:s");
        $insertStatus = conn()->query("Insert into players values(
            '',
            '$full_name',
            0,
            'join at $current_date'
        )");
        return $insertStatus ? 200:404;
    }

    function updateToDB() {
        $full_name = $_POST["full_name"];
        $current_date = date("Y-m-d H:i:s");
        $updateStatus = conn()->query("update players set log='$current_date' where full_name='$full_name'");
        return $updateStatus ? 200:404;
    }

    function createSession($userAuth) {
        session_start();
        $_SESSION["userAuth"] = $userAuth;
    }
?>