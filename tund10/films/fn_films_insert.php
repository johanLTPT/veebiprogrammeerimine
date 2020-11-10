<?php
$database = "if20_johan_le_1";
//var_dump($GLOBALS);
function new_movie_by_production_company($film, $stuudio)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT movie_by_production_company_id FROM movie_by_production_company WHERE movie_id = ? AND production_company_id = ?");
    echo $conn->error;
    $stmt->bind_param("ii", $film, $stuudio);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Olemas";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO movie_by_production_company (movie_id, production_company_id) VALUES(?,?)");
        echo $conn->error;
        $stmt->bind_param("ii", $film, $stuudio);
        if ($stmt->execute()) {
            $notice = "Success!";
        } else {
            $notice = "ERROR: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function new_person_in_movie($film, $human, $position, $role)
{
    if ($position != 1) {
        $role = null;
    }
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT person_in_movie_id FROM person_in_movie WHERE person_id = ? AND movie_id = ? AND position_id = ? AND role = ?");
    echo $conn->error;
    $stmt->bind_param("iiis", $human, $film, $position, $role);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Olemas";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO person_in_movie (person_id, movie_id, position_id, role) VALUES(?,?,?,?)");
        echo $conn->error;
        $stmt->bind_param("iiis", $human, $film, $position, $role);
        if ($stmt->execute()) {
            $notice = "Success!";
        } else {
            $notice = "ERROR: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function new_movie_genre($selectedfilm, $selectedgenre)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT movie_genre_id FROM movie_genre WHERE movie_id = ? AND genre_id = ?");
    echo $conn->error;
    $stmt->bind_param("ii", $selectedfilm, $selectedgenre);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Selline seos on juba olemas!";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO movie_genre (movie_id, genre_id) VALUES(?,?)");
        echo $conn->error;
        $stmt->bind_param("ii", $selectedfilm, $selectedgenre);
        if ($stmt->execute()) {
            $notice = "Uus seos edukalt salvestatud!";
        } else {
            $notice = "Seose salvestamisel tekkis tehniline tõrge: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
    return $notice;
}
function new_movie($titleinput, $production_yearinput, $durationinput, $descriptioninput)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT movie_id FROM movie WHERE title = ? AND production_year = ? AND duration = ?");
    echo $conn->error;
    $stmt->bind_param("sii", $titleinput, $production_yearinput, $durationinput);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Selline film on juba olemas!";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO movie (title, production_year, duration, description) VALUES(?,?,?,?)");
        echo $conn->error;
        $stmt->bind_param("siis", $titleinput, $production_yearinput, $durationinput, $descriptioninput);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function new_genre($genreinput, $descriptioninput)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT genre_id FROM genre WHERE genre_name = ? and description = ?");
    echo $conn->error;
    $stmt->bind_param("ss", $genreinput, $descriptioninput);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Selline Zanr on juba olemas!";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO genre (genre_name, description) VALUES(?,?)");
        echo $conn->error;
        $stmt->bind_param("ss", $genreinput, $descriptioninput);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function new_position($positioninput, $descriptioninput)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT position_id FROM position WHERE position_name = ? and description = ?");
    echo $conn->error;
    $stmt->bind_param("ss", $positioninput, $descriptioninput);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Selline amet on juba olemas!";
    } else {
        $stmt->close();
        $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
        $stmt = $conn->prepare("INSERT INTO position (position_name, description) VALUES(?,?)");
        echo $conn->error;
        $stmt->bind_param("ss", $positioninput, $descriptioninput);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function new_quote($quoteinput, $film, $human, $role)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT person_in_movie_id FROM person_in_movie WHERE person_id = ? AND movie_id = ? AND role = ?");
    echo $conn->error;
    $stmt->bind_param("iis", $human, $film, $role);
    $stmt->bind_result($person_in_movie_id);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Olemas";
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO quote (quote_text, person_in_movie_id) VALUES(?,?)");
        echo $conn->error;
        $stmt->bind_param("si", $quoteinput, $person_in_movie_id);
        if ($stmt->execute()) {
            $notice = "Success!";
        } else {
            $notice = "ERROR: " . $stmt->error;
        }
    } else {
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function new_person($f_name, $l_name, $birthdate)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT person_id FROM person WHERE first_name = ? AND last_name = ? AND birth_date = ?");
    echo $conn->error;
    $stmt->bind_param("sss", $f_name, $l_name, $birthdate);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Selline isik on juba olemas!";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO person (first_name, last_name, birth_date) VALUES(?,?,?)");
        echo $conn->error;
        $stmt->bind_param("sss", $f_name, $l_name, $birthdate);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function new_production_company($company_name, $company_address)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT production_company_id FROM production_company WHERE company_name = ? and company_address = ?");
    echo $conn->error;
    $stmt->bind_param("ss", $company_name, $company_address);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Selline Stuudio on juba olemas!";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO production_company (company_name, company_address) VALUES(?,?)");
        echo $conn->error;
        $stmt->bind_param("ss", $company_name, $company_address);
        $stmt->execute();
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
