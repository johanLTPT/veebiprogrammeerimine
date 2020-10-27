<?php
$database = "if20_johan_le_1";
//var_dump($GLOBALS);
function readpersonsinfilms($sortby, $sortorder)
{
    $notice = "Pole sellist tegelast";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id";
    if ($sortby == 0 and $sortorder == 0) {
        $stmt = $conn->prepare($SQLsentence);
    }
    
    if ($sortby == 1) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY first_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY first_name");
        }
    }
    if ($sortby == 2) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY last_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY last_name");
        }
    }
    if ($sortby == 3) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY role DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY role");
        }
    }
    if ($sortby == 4) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title");
        }
    }

    echo $conn->error;
    $stmt->bind_result($first_namefromdb, $last_namefromdb, $rolefromdb, $titlefromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $first_namefromdb . " " . $last_namefromdb . "</td>";
        $lines .= "\t <td>" . $rolefromdb . "</td>";
        $lines .= "\t <td>" . $titlefromdb . "</td> \n";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Nimi &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Roll &nbsp;<a href="?sortby=3&sortorder=1">🔼</a>&nbsp;<a href="?sortby=3&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Film &nbsp;<a href="?sortby=4&sortorder=1">🔼</a>&nbsp;<a href="?sortby=4&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}