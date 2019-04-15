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
<form>
	<?php 
		$ligne = 1;
		$indice  = 0 ;
		$transvox=array("IR/testFile/File1/pitch"=>"IR/testFile/File1/transvox/yapasdesoucismadame_synth_OLA_FFT_AVO.wav",
		"IR/testFile/File2/pitch"=>"IR/testFile/File2/transvox/vincent_synth_OLA_FFT_AVO.wav",
		"IR/testFile/File3/pitch"=>"IR/testFile/File3/transvox/PT_0500_synth_OLA_FFT_AVO.wav",
		"IR/testFile/File4/pitch"=>"IR/testFile/File4/transvox/file4_synth_OLA_FFT_AVO.wav",
		"IR/testFile/File5/pitch"=>"IR/testFile/File5/transvox/file5_synth_OLA_FFT_AVO.wav",		
		);
		$original=array("IR/testFile/File1/transvox/yapasdesoucismadame_synth_OLA_FFT_AVO.wav"=>"IR/testFile/File1/Original/yapasdesoucismadame.wav",
		"IR/testFile/File2/transvox/vincent_synth_OLA_FFT_AVO.wav"=>"IR/testFile/File2/Original/vincent.wav",
		"IR/testFile/File3/transvox/PT_0500_synth_OLA_FFT_AVO.wav"=>"IR/testFile/File3/Original/PT_0500.wav",
		"IR/testFile/File4/transvox/file4_synth_OLA_FFT_AVO.wav"=>"IR/testFile/File4/Original/file4.wav",
		"IR/testFile/File5/transvox/file5_synth_OLA_FFT_AVO.wav"=>"IR/testFile/File5/Original/file5.wav",		
		);
        $paths=array_keys($transvox); 
        
	?>

<table>
<tr>
<th> <h1> Files  </h1></th>
<th> <h1>Original</h1></th>
<th> <h1>Notation </h1></th>
</tr>

 <?php foreach($original as $key=>$file) {
if($ligne== 1 ){
 ?>

    <tr> 	
		<td> <h3> file Transvox </h3>  </td>   
		<td> 	<audio controls="controls">
					<source src="<?php echo $file?>" type="audio/wav" />
				</audio> 
	   </td>
	   <td> <input type="double" name ="<?php echo $file?>" value="1.00"  size ="4">
	   <input type ="submit" value="valider" name ="submit" />
	    </td>
	
   </tr>
  
   
  <?php } $ligne++;  if ($ligne == 2 ){ ?>
  
   <tr> 
		
		<td> <audio controls="controls">
					<source src="<?php echo $key?>" type="audio/wav" />
				</audio>  
	  </td>   
		<td> 	
	   </td>
	   <td> <input type="double" name ="<?php echo $key?>" value="1.00"  size ="4"> </td>
	
   </tr>
   <tr> <td> <h3> Files : </h3> </td>
   <td> <?php echo $indice; ?>  </td>
   <td>  </td>
   </tr>
  
   <?php }  $ligne++;  if ($ligne == 3 ) { 
    
     $files = new DirectoryIterator($paths[$indice]);//repertoire du fichier à changer
           foreach($files as $son){ 
		   	if($son->getFilename() != "." && $son->getFilename() != "..")
			     { $path=$paths[$indice];
				  $name= $path."/".$son->getFilename(); 
				   ?>
				 
				 <tr> 
				  <td>   <audio controls="controls">
					<source src="<?php echo $name ;?>" type="audio/wav" />
				    </audio>	    </td>
					<td></td>
				    <td> <input type="double" name ="<?php echo $name?>" value="1.00" size ="4"> </td> 
				 </tr>
   
  

   
   
   
   <?php } } } $ligne = 1 ;$indice++;  } ?>
   <input type="submit" name="valide" value=" Save " />
</table>

</form>
</body>

</html>