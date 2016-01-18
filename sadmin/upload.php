<?php
$output_dir = '../images/'.$_GET['id'].'/';
if(isset($_FILES["file"]) && isset($_GET["id"]))
{
	$ret = array();
	
//	This is for custom errors;	
/*	$custom_error= array();
	$custom_error['jquery-upload-file-error']="File already exists";
	echo json_encode($custom_error);
	die();
*/
	$error =$_FILES["file"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["file"]["name"])) //single file
	{
 	 	$fileName = $_FILES["file"]["name"];

 	 	if(!file_exists($output_dir))
 	 	{
 	 		mkdir($output_dir);
 	 	}
 	 	if(file_exists($output_dir.$fileName))
 	 	{
 	 		$fileName = explode('.',$fileName)[0].'_'.date("Y-m-d_H-i").'.'.explode('.',$fileName)[1];
 	 	}
	 		move_uploaded_file($_FILES["file"]["tmp_name"],$output_dir.$fileName);
	    	$ret[]= $fileName;
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["file"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["file"]["name"][$i];
		move_uploaded_file($_FILES["file"]["tmp_name"][$i],$output_dir.$fileName);
	  	$ret[]= $fileName;
	  }
	}
    echo '../../images/'.$_GET['id'].'/'.$ret[0];
 }
 ?>