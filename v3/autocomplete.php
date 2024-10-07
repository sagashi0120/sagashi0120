<?php
header("Content-Type: text/plain");
$q = urlencode($_GET["q"]);
if(!$q == "" || str_contains($q," ") || str_contains($q,"　")) {
    $strXml = simplexml_load_file("https://www.google.com/complete/search?q={$q}&output=toolbar");
    foreach($strXml->CompleteSuggestion as $key) {
        echo $key->suggestion["data"]."\n";
    }
} else {
    echo "";
}
?>