    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $db = new mysqli("localhost", "providence", "bb1wy", "Providence");

    $start = 'site00.php';
    
    function analyze_website($website) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "localhost/websites/" . $website);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $html = curl_exec($ch);

        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $dom = new DOMDocument();

        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $dom_title = $dom->getElementsByTagName('title');
        $title = htmlspecialchars($dom_title[0]->nodeValue);
        
        $descritpion = htmlspecialchars($xpath->evaluate('string(//meta[@name="description"]/@content)'));

        $links = $dom->getElementsByTagName('a');
        $url_list = "";
        $url_array = array();

        // Concaténation des urls dans un chaine de caractères
        foreach ($links as $link) {
            $url = $link->nodeValue;
            $url_list = $url_list . $url. " ";
        }

        $query = "INSERT INTO website VALUES ('$website', '$title', '$descritpion', '$url_list')";

        $GLOBALS['db']->query($query);

        $query = "SELECT url FROM website";

        // Vérifie si le site est déjà dans la base de données
        foreach ($links as $link) {
            $previous_urls = array();
            $result = $GLOBALS['db']->query($query);
            $rows = $result->fetch_all();
            foreach ( $rows as $row) {
                array_push($previous_urls, $row[0]);
            }
            if (!in_array($link->nodeValue, $previous_urls)) {
                analyze_website($link->nodeValue);
            }
        }
    }
    
    // Récursivité
    analyze_website($start);
    
    ?>