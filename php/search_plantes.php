<?php

$post = preg_replace("/'/", "\\'", $_POST["search"]);
$post = preg_replace('/"/', "", $post);
$post = preg_replace('/;/', "", $post); // to avoid SQL injections

$mysqli = new mysqli("localhost", "root", "root", 'plantes');
$result = $mysqli->query("SELECT DISTINCT familles.name AS famille, genres.name AS genre, especes.name AS espece
                          FROM especes
                          INNER JOIN familles ON especes.famille_id = familles.id
                          INNER JOIN genres ON especes.genre_id = genres.id
                          WHERE familles.name LIKE \"$post%\"
                          OR genres.name LIKE \"$post%\"
                          OR especes.name LIKE \"$post%\"
                          ORDER BY espece;");

$arr = [];
foreach ($result as $row) {
  $arr[] = $row;
}

$json = json_encode($arr, JSON_UNESCAPED_UNICODE, 2);
echo $json;
