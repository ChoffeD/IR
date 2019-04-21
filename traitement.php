<html>
<head>
    <title>Ma page de traitement</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Unknown</title>
    <meta name="generator" content="LibreOffice 5.3.6.1 (Linux)"/>
    <meta name="author" content="Manu Dufait"/>
    <meta name="created" content="2019-04-16T15:30:05"/>
    <meta name="changedby" content="calibre"/>
    <meta name="changed" content="2019-04-16T15:30:05"/>
    <meta name="AppVersion" content="03.0033"/>
    <meta name="DocSecurity" content="0"/>
    <meta name="HyperlinksChanged" content="false"/>
    <meta name="LinksUpToDate" content="true"/>
    <meta name="ScaleCrop" content="false"/>
    <meta name="ShareDoc" content="false"/>
    <style type="text/css">
        @page { size: 8.5in 11in; margin: 1in }
        p { margin-bottom: 0.1in; line-height: 120% }
    </style>
</head>
<body>

<p style="margin-bottom: 0in; font-variant: normal; letter-spacing: normal; font-style: normal; line-height: 115%">
<p><h3>Merci de votre participation</h3></p>
<span style="display: inline-block; border: none; padding: 0in"><font face="Times, serif"><font size="3" style="font-size: 12pt"><span style="background: #ffffff"><font color="#000000"> N’hésitez pas à nous contacter par
mail&nbsp;<font color="#0563c1"><u>choffe.damien@gmail.com</u></font>&nbsp;ou&nbsp;<font color="#0563c1"><u>ilef.trabelsi@outlook.com</u></font>&nbsp;si
vous souhaitez avoir un retour de votre participation et/ou pour
recevoir la clé USB.&nbsp;&nbsp;</span></span></font></font></font></p>




<?php
// on teste la déclaration de nos variables
if (isset($_POST['valide'])) {
    // on affiche nos résultats
    $ip = getUserIpAddr();
    $handle = fopen("IR/Data/data".$ip.".csv", "a");
    $handle2 = fopen("IR/Data/Metadata".$ip.".csv", "a");
    $list = array();
    $i = 0;
    foreach($_POST as $key=>$data){
        if($data != '0' ) {
            preg_match('/^(File[0-9][0-9]?)$/', $key, $out);
            if(sizeof($out)>0) {
                fputcsv($handle2, array($key, $data), ';');
            } else {
                preg_match('/File([0-9][0-9]?)_([0-9]_[0-9])_(-?[0-9])_wav/', $key, $keyword);
                if (sizeof($keyword) >= 3) {
                    $file = $keyword[1];
                    $factor = $keyword[2];
                    $factor = preg_replace('/_/', '.', $factor);
                    $pitch = $keyword[3];
                    $note = $data;
                    $list[$i] = array($file, $factor, $pitch, $note);
                    $i++;
                }
            }
        }
    }
    foreach($list as $fields) {
        fputcsv($handle, $fields, ';');
    }
    $test = array("FIN");
    fputcsv($handle, $test, ';');
    fputcsv($handle2, $test, ';');


    fclose($handle);
    fclose($handle2);
    if($file != '10')  {
        ?> <p><h3>Vous vous êtes arrêtés au fichier <?php echo $file?></h3></p>
        <?php
    }
}



function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>

</body>
</html>