<html>
<head>

<title>Tests </title>
<style>
h1{
	background: grey;
}
h3{
	background: khaki;
}
table{
margin:auto;
}
body{

background-image: url("back.jpg");
background-repeat: repeat;
	
}

</style>
</head>
<body>
<form action="traitement.php" method="post">
    <input type="submit" name="valide" value=" Save " />
	<?php 
		$ligne = 1;
		$indice  = 0 ;
		$transvox = array();
		$originals = array();
		for($i = 1; $i<=10; $i++) {
            $transvox["IR/testFile/File".$i."/pitch"] = "IR/testFile/File".$i."/transvox/File".$i."transvox".".wav";
            $originals["IR/testFile/File".$i."/transvox/File".$i."transvox".".wav"] = "IR/testFile/File".$i."/Original/File".$i.".wav";
        }

        $paths=array_keys($transvox);
        
	?>

<table>
<tr>
<th> <h1> Files  </h1></th>
<th> <h1>Original</h1></th>
<th> <h1>Notation </h1></th>
</tr>

 <?php foreach($originals as $key=>$file) {
if($ligne== 1 ){
 ?>

    <tr>
		<td> <h3> File Transvox </h3>  </td>


   </tr>


  <?php } $ligne++;  if ($ligne == 2 ){ ?>

   <tr>

		<td> <audio controls="controls">
					<source src="<?php echo $key?>" type="audio/wav" />
				</audio>
	  </td>
		<td>
	   </td>
	   <td> <input type="double" name ="<?php
           preg_match('/(File[0-9][0-9]?)/', $key, $output_array);
           echo $output_array[0]?>" value="0"  size ="4", pattern="([0-4](.[0-5])?)|5"> </td>

   </tr>
   <tr> <td> <h3> Files : <?php echo $indice; ?></h3> </td>
   <td>  </td>
   </tr>

   <?php } $i = -3; $ligne++;  if ($ligne == 3 ) {
     $files = new DirectoryIterator($paths[$indice]);//repertoire du fichier à changer
           foreach($files as $son){
               $i++;
		   	if($son->getFilename() != "." && $son->getFilename() != "..")
			     { $path=$paths[$indice];
				  $name= $path."/".$son->getFilename();
				   ?>

				 <tr>
				  <td>   <audio controls="controls">
					<source src="<?php echo $name ;?>" type="audio/wav" />
				    </audio>	    </td><td>
                     <?php if($i%5 ==0) {
                         echo
                     ' 	<audio controls="controls">
                             <source src="<?php echo $file?>" type="audio/wav" />
                         </audio>
                     ';}
                     ?></td>
				    <td> <input type="double" name ="<?php echo $son->getFilename()?>" value="0" size ="4", pattern="([0-4](.[0-5])?)|5"> </td>
				 </tr>






   <?php } } } $ligne = 1 ;$indice++;  } ?>
</table>

</form>
</body>

</html>