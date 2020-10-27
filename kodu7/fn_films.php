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

function old_readpersonsinfilms()
{
    $notice = "Pole sellist tegelast";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    //$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
    $stmt = $conn->prepare("SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id");
    echo $conn->error;
    $stmt->bind_result($first_namefromdb, $last_namefromdb, $rolefromdb, $titlefromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<p>" . $first_namefromdb . " " . $last_namefromdb;
        if (!empty($rolefromdb)) {
            $lines .= " on tegelane " . $rolefromdb;
        }
        $lines .= ' Filmis "' . $titlefromdb . '".' . "</p>\n";
    }
    if (!empty($lines)) {
        $notice = $lines;
    }
    $stmt->close();
    $conn->close();
    return $notice;
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


