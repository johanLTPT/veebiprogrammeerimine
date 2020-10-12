<?php
$database = "if20_johan_le_1";
function signup($firstname, $lastname, $email, $gender, $birthdate, $password)
{
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

function signin($email, $password)
{
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
                //loen kasutaja infot
                $stmt = $conn->prepare("SELECT vpusers_id,firstname,lastname FROM vpusers WHERE email = ?");
                echo $conn->error;
                $stmt->bind_param("s", $email);
                $stmt->bind_result($idfromdb, $firstnamefromdb, $lastnamefromdb);
                $stmt->execute();
                $stmt->fetch();
                //Salvestame sessioonimuutujad
                $_SESSION["userid"] = $idfromdb;
                $_SESSION["userfirstname"] = $firstnamefromdb;
                $_SESSION["userlastname"] = $lastnamefromdb;
                //värvid lugeda profiilist, kui olemas
				$stmt->close();
				$stmt = $conn->prepare("SELECT bgcolor, txtcolor FROM vpuserprofiles WHERE userid = ?");
				$stmt->bind_param("i", $_SESSION["userid"]);
				$stmt->bind_result($bgcolorfromdb, $txtcolorfromdb);
				$stmt->execute();
				if($stmt->fetch()){
					$_SESSION["usertxtcolor"] = $txtcolorfromdb;
					$_SESSION["userbgcolor"] = $bgcolorfromdb;
				} else {
					$_SESSION["usertxtcolor"] = "#000000";
					$_SESSION["userbgcolor"] = "#FFFFFF";
				}
                $stmt->close();
                $conn->close();
                header("Location: home.php");
                exit();
            } else {
                $notice = "Vale parool";
            }
        } else {
            $notice = "sellist kasutajat (" . $email . ") ei leitud!";
        }
    } else {
        $notice = $stmt->error;
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function storeuserprofile($userdescription, $bgcolorinput, $txtcolorinput)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT vpuserprofiles_id FROM vpuserprofiles WHERE userid = ?");
    echo $conn->error;
    $notice = "";
    $stmt->bind_param("s", $_SESSION["userid"]);
    $stmt->bind_result($useridfromdb);
    if ($stmt->execute()) {

        if ($stmt->fetch()) {
            //kasutaja on juba tabelis
            $stmt->close();
            $stmt = $conn->prepare("UPDATE vpuserprofiles SET description = ?, bgcolor = ?, txtcolor = ? WHERE userid = ?");
            $stmt->bind_param("sssi", $userdescription, $bgcolorinput, $txtcolorinput, $_SESSION["userid"]);
        } else {
            //kasutajat pole tabelis
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO vpuserprofiles (userid, description, bgcolor, txtcolor) VALUES (?,?,?,?)");
            $stmt->bind_param("isss", $_SESSION["userid"], $userdescription, $bgcolorinput, $txtcolorinput);
        }
        if ($stmt->execute()) {
            $notice = "ok";
        } else {
            $notice = $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
    return $notice;
}

function readuserdescription()
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT vpuserprofiles_id FROM vpuserprofiles WHERE userid = ?");
    $stmt->bind_param("s", $_SESSION["userid"]);
    $stmt->bind_result($useridfromdb);
    if ($stmt->execute()) {

        if ($stmt->fetch()) {
            //kasutaja on juba tabelis
            $stmt->close();
            $stmt = $conn->prepare("SELECT description FROM vpuserprofiles WHERE userid = ?");
            $stmt->bind_param("s", $_SESSION["userid"]);
            $stmt->bind_result($userdescriptionfromdb);
            $stmt->execute();
            $stmt->fetch();
            
        } else {
            $userdescriptionfromdb = "tühi";
        }
        
    }

    $stmt->close();
    $conn->close();
    return $userdescriptionfromdb;
}
