<?php
include("connect.php");
if(isset($_FILES['files'])){
    $errors= array();
	function GetImageExtension($imagetype)
    {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }
    }
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];
		$randNum = mt_rand();
		$ext= GetImageExtension($file_type);
		$imagename=$randNum."-".time().$ext;	
        if($file_size > 2097152){
			$errors[]='File size must be less than 2 MB';
        }		
        $query="INSERT into upload_data (`USER_ID`,`FILE_NAME`,`FILE_SIZE`,`FILE_TYPE`) VALUES(DEFAULT,'$imagename','$file_size','$file_type'); ";
        $desired_dir="user_data";
        if(empty($errors)==true){
			if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            move_uploaded_file($file_tmp,"$desired_dir/".$imagename);
			mysql_query($query) or die("Error: " . mysql_error());			
        }else{
                print_r($errors);
        }
    }
	if(empty($error)){
		echo "Success";
	}
}
?>


<form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="files[]" multiple/>
	<input type="submit"/>
</form>
<?php
	  $select_query = "SELECT `FILE_NAME` FROM  upload_data";
      $sql = mysql_query($select_query) or die(mysql_error());   
      while($row = mysql_fetch_array($sql,MYSQL_BOTH)){
?>

<table style="border-collapse: collapse; font: 12px Tahoma;" border="1" cellspacing="5" cellpadding="5">
<tbody><tr>
<td>
  <img style="width:200px;height:200px;" src="<?php echo "user_data/" . $row['FILE_NAME']; ?>" alt="" />
</td>
</tr>
</tbody></table>
<?php
  }
?>
