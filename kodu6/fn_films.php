<?php
$database = "if20_johan_le_1";
//var_dump($GLOBALS);
function readfilms()
{
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    //$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare("SELECT * FROM film");
    echo $conn->error;
    //seome tulemuse muutujaga
    $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb, $genrefromdb, $studiofromdb, $directorfromdb);
    $stmt->execute();
    $filmhtml = "  <ol>\n";
    while ($stmt->fetch()) {
        $filmhtml .= "\t<li>" . $titlefromdb . "\n";
        $filmhtml .= "\t\t<ul>\n";
        $filmhtml .= "\t\t\t<li>Valmimisaasta: " . $yearfromdb . "</li>\n";
        $filmhtml .= "\t\t\t<li>Kestvus: " . $durationfromdb . " min.</li>\n";
        $filmhtml .= "\t\t\t<li>Žanr: " . $genrefromdb . "</li>\n";
        $filmhtml .= "\t\t\t<li>Stuudio: " . $studiofromdb . "</li>\n";
        $filmhtml .= "\t\t\t<li>Lavastaja: " . $directorfromdb . "</li>\n";
        $filmhtml .= "\t\t</ul>\n";
        $filmhtml .= "\t</li>\n";
    }
    $filmhtml .= "  </ol>\n";
    $stmt->close();
    $conn->close();
    return $filmhtml;
}
function savefilm($titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES(?,?,?,?,?,?)");
    echo $conn->error;
    $stmt->bind_param("siisss", $titleinput, $yearinput, $durationinput, $genreinput, $studioinput, $directorinput);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

function readfilm($selected)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT movie_id, title FROM movie");
    echo $conn->error;
    $stmt->bind_result($idfromdb, $titlefromdb);
    $stmt->execute();
    $films = "";
    while ($stmt->fetch()) {
        $films .= '<option value="' . $idfromdb . '"';
        if (intval($idfromdb) == $selected) {
            $films .= " selected";
        }
        $films .= ">" . $titlefromdb . "</option> \n";
    }
    if (!empty($films)) {
        $notice = '<select name="filminput" id="filminput">' . "\n";
        $notice .= '<option value="" selected disabled>Film</option>' . "\n";
        $notice .= $films;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function readstudio($studio)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT production_company_id, company_name FROM production_company");
    echo $conn->error;
    $stmt->bind_result($idfromdb, $studiofromdb);
    $stmt->execute();
    $studios = "";
    while ($stmt->fetch()) {
        $studios .= '<option value="' . $idfromdb . '"';
        if ($idfromdb == $studio) {
            $studios .= " selected";
        }
        $studios .= ">" . $studiofromdb . "</option> \n";
    }
    if (!empty($studios)) {
        $notice = '<select name="studioinput" id="studioinput">' . "\n";
        $notice .= '<option value="" selected disabled>Stuudio</option>' . "\n";
        $notice .= $studios;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function readhuman($human)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT person_id, first_name FROM person");
    echo $conn->error;
    $stmt->bind_result($idfromdb, $humanfromdb);
    $stmt->execute();
    $humans = "";
    while ($stmt->fetch()) {
        $humans .= '<option value="' . $idfromdb . '"';
        if ($idfromdb == $human) {
            $humans .= " selected";
        }
        $humans .= ">" . $humanfromdb . "</option> \n";
    }
    if (!empty($humans)) {
        $notice = '<select name="humaninput" id="humaninput">' . "\n";
        $notice .= '<option value="" selected disabled>Isik</option>' . "\n";
        $notice .= $humans;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function readposition($position)
{
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT position_id, position_name FROM position");
    echo $conn->error;
    $stmt->bind_result($idfromdb, $positionfromdb);
    $stmt->execute();
    $positions = "";
    while ($stmt->fetch()) {
        $positions .= '<option value="' . $idfromdb . '"';
        if ($idfromdb == $position) {
            $positions .= " selected";
        }
        $positions .= ">" . $positionfromdb . "</option> \n";
    }
    if (!empty($positions)) {
        $notice = '<select name="positioninput" id="positioninput">' . "\n";
        $notice .= '<option value="" selected disabled>Amet</option>' . "\n";
        $notice .= $positions;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function newfilmandstudio($film, $stuudio)
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
function newfilmandhuman($film, $human, $position)
{
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT person_in_movie_id FROM person_in_movie WHERE person_id = ? AND movie_id = ? AND position_id = ?");
    echo $conn->error;
    $stmt->bind_param("iii", $human, $film, $position);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if ($stmt->fetch()) {
        $notice = "Olemas";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO person_in_movie (person_id, movie_id, position_id) VALUES(?,?,?)");
        echo $conn->error;
        $stmt->bind_param("iii", $human, $film, $position);
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