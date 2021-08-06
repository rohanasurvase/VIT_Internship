<?php
	if(isset($_POST['submit'])){
		//The File
		$file=$_FILES['file'];	
		// File Name
		$fileName=$_FILES['file']['name'];
		// File temporary Name
		$fileTemp=$_FILES['file']['tmp_name'];
		// File Size
		$fileSize=$_FILES['file']['size'];
		//File Error
		$fileError=$_FILES['file']['error'];
		//Type
		$fileType=$_FILES['file']['type'];
		//Extension
		$fileExt=explode('.', $fileName);
		$fileActualExt=strtolower(end($fileExt));
		
		$allowed=array('html','css','js','java','pdf','docx','doc','png','jpeg','jpg','odf','xlsx');
		if(in_array($fileActualExt,$allowed)){
			if($fileError === 0){
				if($fileSize < 150000){
					//Creates unique ID based on the current microseconds
					$fileNameNew = uniqid('',true).'.'.$fileActualExt;
					$target_dir = "Uploads/".$fileNameNew;
					move_uploaded_file($fileTemp, $target_dir);
					header('Location: project.php?uploadsuccess');
					echo 
					'<div class="alert alert-success" role="alert"> SUCCESS!
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>';
				}else{
					echo'Your file is too big';
				}
			}else{
				echo 'Error in uploading file';
			}

		}else{
			echo "You cannot upload files of this type!";
		}
	}
?>