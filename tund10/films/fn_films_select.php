<?php
$database = "if20_johan_le_1";
//var_dump($GLOBALS);
function readfilmselect($selected)
{
    $notice = "<p>Kahjuks filme ei leitud!</p> \n";
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
        $notice = '<select name="filminput">' . "\n";
        $notice .= '<option value="" selected disabled>Film</option>' . "\n";
        $notice .= $films;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function readstudioselect($studio)
{
    $notice = "<p>Kahjuks stuudioid ei leitud!</p> \n";
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
function readhumanselect($human)
{
    $notice = "<p>Kahjuks inimesi ei leitud!</p> \n";
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
function readpositionselect($position)
{
    $notice = "<p>Kahjuks ameteid ei leitud!</p> \n";
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
function readquoteselect($position)
{
    $notice = "<p>Kahjuks tsistaate ei leitud!</p> \n";
    $notice = "err";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT quote_id, quote_text FROM quote");
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
        $notice = '<select name="quoteinput" id="quoteinput">' . "\n";
        $notice .= '<option value="" selected disabled>Tsitaat</option>' . "\n";
        $notice .= $positions;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function readgenreselect($selected)
{
    $notice = "<p>Kahjuks žanre ei leitud!</p> \n";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT genre_id, genre_name FROM genre");
    echo $conn->error;
    $stmt->bind_result($idfromdb, $genrefromdb);
    $stmt->execute();
    $genres = "";
    while ($stmt->fetch()) {
        $genres .= '<option value="' . $idfromdb . '"';
        if (intval($idfromdb) == $selected) {
            $genres .= " selected";
        }
        $genres .= ">" . $genrefromdb . "</option> \n";
    }
    if (!empty($genres)) {
        $notice = '<select name="genreinput">' . "\n";
        $notice .= '<option value="" selected disabled>Vali žanr</option>' . "\n";
        $notice .= $genres;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}