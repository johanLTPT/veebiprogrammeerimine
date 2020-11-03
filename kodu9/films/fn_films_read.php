<?php
$database = "if20_johan_le_1";
//var_dump($GLOBALS);
function read_person_in_movie($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT first_name, last_name, role, position_name, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id JOIN position ON position.position_id = person_in_movie.position_id";
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
        if ($sortby == 5) {
            if ($sortorder == 2) {
                $stmt = $conn->prepare($SQLsentence . " ORDER BY position_name DESC");
            } else {
                $stmt = $conn->prepare($SQLsentence . " ORDER BY position_name");
            }
    }

    echo $conn->error;
    $stmt->bind_result($first_namefromdb, $last_namefromdb, $rolefromdb, $positionfromdb, $titlefromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $first_namefromdb . " " . $last_namefromdb . "</td>";
        $lines .= "\t <td>" . $rolefromdb . "</td>";
        $lines .= "\t <td>" . $titlefromdb . "</td> \n";
        $lines .= "\t <td>" . $positionfromdb . "</td>";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Nimi &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a>&nbsp;<a href="?sortby=2&sortorder=1">🔺</a>&nbsp;<a href="?sortby=2&sortorder=2">🔻</a></th>' . "\n";
        $notice .= '<th>Roll &nbsp;<a href="?sortby=3&sortorder=1">🔼</a>&nbsp;<a href="?sortby=3&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Film &nbsp;<a href="?sortby=4&sortorder=1">🔼</a>&nbsp;<a href="?sortby=4&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Amet &nbsp;<a href="?sortby=5&sortorder=1">🔼</a>&nbsp;<a href="?sortby=5&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function read_genre($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT genre_name, description FROM genre";
    if ($sortby == 0 and $sortorder == 0) {
        $stmt = $conn->prepare($SQLsentence);
    }
    
    if ($sortby == 1) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY genre_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY genre_name");
        }
    }
    if ($sortby == 2) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY description DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY description");
        }
    }


    echo $conn->error;
    $stmt->bind_result($genre_namefromdb, $descfromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $genre_namefromdb ."</td>";
        $lines .= "\t <td>" . $descfromdb . "</td>";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Zanr &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Kirjeldus &nbsp;<a href="?sortby=2&sortorder=1">🔼</a>&nbsp;<a href="?sortby=2&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function read_movie_by_production_company($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT company_name, title FROM production_company JOIN movie_by_production_company ON production_company.production_company_id = movie_by_production_company.production_company_id JOIN movie ON movie.movie_id = movie_by_production_company.movie_id";
    if ($sortby == 0 and $sortorder == 0) {
        $stmt = $conn->prepare($SQLsentence);
    }
    
    if ($sortby == 1) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY company_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY company_name");
        }
    }
    if ($sortby == 2) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title");
        }
    }


    echo $conn->error;
    $stmt->bind_result($comp_namefromdb, $titlefromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $comp_namefromdb . "</td>";
        $lines .= "\t <td>" . $titlefromdb . "</td> \n";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Firma &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Film &nbsp;<a href="?sortby=2&sortorder=1">🔼</a>&nbsp;<a href="?sortby=2&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function read_movie_genre($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT genre_name, title FROM genre JOIN movie_genre ON genre.genre_id = movie_genre.genre_id JOIN movie ON movie.movie_id = movie_genre.movie_id";
    if ($sortby == 0 and $sortorder == 0) {
        $stmt = $conn->prepare($SQLsentence);
    }
    
    if ($sortby == 1) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY genre_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY genre_name");
        }
    }
    if ($sortby == 2) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title");
        }
    }


    echo $conn->error;
    $stmt->bind_result($genrefromdb, $titlefromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $genrefromdb . "</td>";
        $lines .= "\t <td>" . $titlefromdb . "</td> \n";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Zanr &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Film &nbsp;<a href="?sortby=2&sortorder=1">🔼</a>&nbsp;<a href="?sortby=2&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function read_movie($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT title, production_year, duration, description FROM movie";
    if ($sortby == 0 and $sortorder == 0) {
        $stmt = $conn->prepare($SQLsentence);
    }
    
    if ($sortby == 1) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title");
        }
    }
    if ($sortby == 2) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY production_year DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY production_year");
        }
    }
    if ($sortby == 3) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY duration DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY duration");
        }
    }
    if ($sortby == 4) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY description DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY description");
        }
    }


    echo $conn->error;
    $stmt->bind_result($titlefromdb, $yearfromdb, $durationfromdb,$descfromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $titlefromdb ."</td>";
        $lines .= "\t <td>" . $yearfromdb ."</td>";
        $lines .= "\t <td>" . $durationfromdb ."</td>";
        $lines .= "\t <td>" . $descfromdb . "</td>";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Pealkiri &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Aasta &nbsp;<a href="?sortby=2&sortorder=1">🔼</a>&nbsp;<a href="?sortby=2&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Kestvus &nbsp;<a href="?sortby=3&sortorder=1">🔼</a>&nbsp;<a href="?sortby=3&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Kirjeldus &nbsp;<a href="?sortby=4&sortorder=1">🔼</a>&nbsp;<a href="?sortby=4&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function read_person($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT first_name, last_name, birth_date FROM person";
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
            $stmt = $conn->prepare($SQLsentence . " ORDER BY birth_date DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY birth_date");
        }
    }



    echo $conn->error;
    $stmt->bind_result($first_namefromdb, $last_namefromdb, $birth_date);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $first_namefromdb . " " . $last_namefromdb . "</td>";
        $lines .= "\t <td>" . $birth_date ."</td>";

        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Inimene &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a>&nbsp;<a href="?sortby=2&sortorder=1">🔺</a>&nbsp;<a href="?sortby=2&sortorder=2">🔻</a></th>' . "\n";
        $notice .= '<th>Sünniaasta &nbsp;<a href="?sortby=2&sortorder=1">🔼</a>&nbsp;<a href="?sortby=2&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function read_position($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT position_name, description FROM position";
    if ($sortby == 0 and $sortorder == 0) {
        $stmt = $conn->prepare($SQLsentence);
    }
    
    if ($sortby == 1) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY position_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY position_name");
        }
    }
    if ($sortby == 2) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY description DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY description");
        }
    }


    echo $conn->error;
    $stmt->bind_result($position_namefromdb, $descfromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $position_namefromdb ."</td>";
        $lines .= "\t <td>" . $descfromdb . "</td>";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Amet &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Kirjeldus &nbsp;<a href="?sortby=2&sortorder=1">🔼</a>&nbsp;<a href="?sortby=2&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function read_production_company($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT company_name, company_address FROM production_company";
    if ($sortby == 0 and $sortorder == 0) {
        $stmt = $conn->prepare($SQLsentence);
    }
    
    if ($sortby == 1) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY company_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY company_name");
        }
    }
    if ($sortby == 2) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY company_address DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY company_address");
        }
    }


    echo $conn->error;
    $stmt->bind_result($company_namefromdb, $addressfromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $company_namefromdb ."</td>";
        $lines .= "\t <td>" . $addressfromdb . "</td>";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Firma nimi &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Aadress &nbsp;<a href="?sortby=2&sortorder=1">🔼</a>&nbsp;<a href="?sortby=2&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
function read_quote($sortby, $sortorder)
{
    $notice = "Pole";
    //andmebaasi lugemine
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $SQLsentence = "SELECT quote_text, first_name, last_name, role, title FROM quote JOIN person_in_movie ON quote.person_in_movie_id = person_in_movie.person_in_movie_id JOIN person ON person_in_movie.person_id = person.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id";
    if ($sortby == 0 and $sortorder == 0) {
        $stmt = $conn->prepare($SQLsentence);
    }
    
    if ($sortby == 1) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY quote_text DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY quote_text");
        }
    }
    if ($sortby == 2) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY first_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY first_name");
        }
    }
    if ($sortby == 3) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY last_name DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY last_name");
        }
    }
    if ($sortby == 4) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY role DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY role");
        }
    }
    if ($sortby == 5) {
        if ($sortorder == 2) {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title DESC");
        } else {
            $stmt = $conn->prepare($SQLsentence . " ORDER BY title");
        }
    }

    echo $conn->error;
    $stmt->bind_result($quotefromdb, $first_namefromdb, $last_namefromdb, $rolefromdb, $titlefromdb);
    $stmt->execute();
    $lines = "";
    while ($stmt->fetch()) {
        $lines .= "<tr> \n";
        $lines .= "\t <td>" . $quotefromdb . "</td>";
        $lines .= "\t <td>" . $first_namefromdb . " " . $last_namefromdb . "</td>";
        $lines .= "\t <td>" . $rolefromdb . "</td>";
        $lines .= "\t <td>" . $titlefromdb . "</td> \n";
        $lines .= "</tr> \n";
    }
    if (!empty($lines)) {
        $notice = "<table>\n";
        $notice .= "<tr> \n";
        $notice .= '<th>Tsitaat &nbsp;<a href="?sortby=1&sortorder=1">🔼</a>&nbsp;<a href="?sortby=1&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Nimi &nbsp;<a href="?sortby=2&sortorder=1">🔼</a>&nbsp;<a href="?sortby=2&sortorder=2">🔽</a>&nbsp;<a href="?sortby=3&sortorder=1">🔺</a>&nbsp;<a href="?sortby=3&sortorder=2">🔻</a></th>' . "\n";
        $notice .= '<th>Roll &nbsp;<a href="?sortby=4&sortorder=1">🔼</a>&nbsp;<a href="?sortby=4&sortorder=2">🔽</a></th>' . "\n";
        $notice .= '<th>Film &nbsp;<a href="?sortby=5&sortorder=1">🔼</a>&nbsp;<a href="?sortby=5&sortorder=2">🔽</a></th>' . "\n";
        $notice .= "</tr> \n";
        $notice .= $lines;
        $notice .= "</table> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}
