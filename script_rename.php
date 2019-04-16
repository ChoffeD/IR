<?php
$pattern= array('/transvox/','/_synth_OLA_FFT_AVO/','/-2/','/-3/','/-4/','/-5/','/-6/','/-7/');
$replacement = array('','','_1','_2','_3','_-1','_-2','_-3');
$files = new DirectoryIterator("IR/testFile/File7/pitch");
$path = $files->getPath();
foreach($files as $son) {
    if ($son->getFilename() != "." && $son->getFilename() != "..") {
        $name =  $son->getFilename();
        preg_match('/File[0-9][0-9]?_[0-9].[0-9]_-?[0-9].wav/', $name, $output_array);
        if(sizeof($output_array)==0) {
            echo "<br>";
            echo $name;
            echo "</br>";
            $namechange = preg_replace($pattern, $replacement, $name);

            preg_match('/File[0-9][0-9]?_[0-9].[0-9].wav$/', $namechange, $output_array);
            if (sizeof($output_array) > 0) {
                echo 'test';
                $namechange = preg_replace('/.wav/', '_0.wav', $namechange);
            }
            $namechange = preg_replace('/__/', '_', $namechange);
            echo "<br>";
            echo $namechange;
            echo "</br>";
            rename($path . '/' . $name, $path . '/' . $namechange);
        }
    }
}
