<?php
$database = "if20_johan_le_1";
function signup($firstname, $lastname, $email, $gender, $birthdate, $password){
    $notice = null;
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
    echo $conn->error;
    //Krüpteerime passwordi
    $options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
    $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);
    //edasi
    $stmt->bind_param("sssiss", $firstname, $lastname, $birthdate, $gender, $email, $pwdhash);
    if ($stmt->execute()) {
        $notice = "ok";
    } else {
        $notice = $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function signin($email, $password){
    $notice = null;
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
    echo $conn->error;
    $stmt->bind_param("s", $email);
    $stmt->bind_result($passwordfromdb);
    if ($stmt->execute()) {
        //tehnilisel korras
        if ($stmt->fetch()) {
            //kasutaja leiti
            if (password_verify($password, $passwordfromdb)) {
                //parool õige
                $stmt->close();
                $conn->close();
                header("Location: home.php");
                echo("korras");
                exit();
            } else {
                $notice = "Vale parool";
            }
            
        } else {
            $notice = "sellist kasutajat (" . $email .") ei leitud!";
        }
        
    } else {
        $notice = $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}