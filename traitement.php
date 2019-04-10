<html>
<head>
    <title>Ma page de traitement</title>
</head>
<body>
<?php
// on teste la déclaration de nos variables
if (isset($_POST['submit'])) {
    // on affiche nos résultats
    $handle = fopen("data.csv", "a");
    $keyword =  preg_split('/[_]/', $_POST['submit']);
    $factor = $keyword[1];
    $pitch  = $keyword[2];
    $note   = $keyword[3];
    //var_dump($factor);
    $list = array(
        array($factor, $pitch, $note)
    );

    foreach($list as $fields) {
        fputcsv($handle, $fields, ';');
    }
    fclose($handle);
}
?>
</body>
</html>