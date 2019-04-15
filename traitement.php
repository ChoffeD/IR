<html>
<head>
    <title>Ma page de traitement</title>
</head>
<body>
<?php
// on teste la déclaration de nos variables
if (isset($_POST['valide'])) {
    // on affiche nos résultats
     $handle = fopen("data.csv", "a");
     $handle2 = fopen("Metadata.csv", "a");
     $list = array();
     $i = 0;
    foreach($_POST as $key=>$data){
        preg_match('/File([0-9])_([0-9]_[0-9])_(-?[0-9])_wav/', $key, $keyword);
        if(sizeof($keyword)>=3) {
            $file = $keyword[1];
            $factor = $keyword[2];
            $factor = preg_replace('/_/', '.', $factor);
            $pitch  = $keyword[3];
            $note = $data;
            $list[$i] = array($file,$factor, $pitch, $note);
            $i++;
        }
    }
    var_dump($list);
    foreach($list as $fields) {
        fputcsv($handle, $fields, ';');
    }

    fclose($handle);
}
?>
</body>
</html>