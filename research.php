<!DOCTYPE html>
<html lang="en">
<?php

    $db = new mysqli("localhost", "providence", "bb1wy", "Providence");

    // Récupération des paramètres dans l'url

    if (isset($_GET["si"])) {
        $search = htmlspecialchars($_GET['si']);
        $search_array = explode(" ",$search);
        $search_string = "";

        // Ajout de chaque mot dans la recherche
        foreach ($search_array as $word){
            $search_string = $search_string . " OR name LIKE '%$word%' OR description LIKE '%$word%'";
        }

        /* $order = "ORDER BY case ";
        $relevance = 0;
        foreach ($search_array as $word){
            $order = $order . 
        "WHEN name LIKE '$word%' THEN $c
        WHEN name LIKE '%$word%' THEN 2
        WHEN a.title LIKE '%somthing' THEN 3
        ELSE 4 END;"
        }*/

        // Création de la requête SQL
        $query = "SELECT url, name, description FROM website WHERE name LIKE '% $search %' $search_string";

        $result = $db->query($query);
        $rows = $result->fetch_all();

        $number = sizeof($rows);

        // Affichage du code html résultant de la requête
        if ($number == 1){
            echo "<h4> Provid provided you $number result </h4> <br><br>";
        } else {
            echo "<h4> Provid provided you $number results </h4> <br><br>";
        }
        foreach ($rows as $row){
            echo "<p> $row[0] ";
            echo "<h4><a href='/websites/$row[0]'>$row[1]</a></h4>";
            echo "$row[2]</p> <br><br><br>";
        }

    }
?>
</html>