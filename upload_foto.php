<?php
function upload_foto($File)
{
	$uploadOk = 1;
	$hasil = array();
	$message = '';

	// Pastikan folder img ada
	if (!is_dir('img')) {
		mkdir('img', 0777, true); // Membuat folder img jika belum ada
	}

	// File properties:
	$FileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $File['name']); // Bersihkan nama file
	$TmpLocation = $File['tmp_name'];
	$FileSize = $File['size'];

	// Figure out what kind of file this is:
	$FileExt = explode('.', $FileName);
	$FileExt = strtolower(end($FileExt));

	// Allowed files:
	$Allowed = array('jpg', 'png', 'gif', 'jpeg');

	// Validasi mime-type file
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	$mime = finfo_file($finfo, $TmpLocation);
	finfo_close($finfo);

	$allowedMime = ['image/jpeg', 'image/png', 'image/gif'];

	// Check file size
	if ($FileSize > 500000) {
		$message .= "Sorry, your file is too large, max 500KB. ";
		$uploadOk = 0;
	}

	// Allow certain file formats
	if (!in_array($FileExt, $Allowed) || !in_array($mime, $allowedMime)) {
		$message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$message .= "Sorry, your file was not uploaded. ";
		$hasil['status'] = false;
	} else {
		// Create new filename:
		$NewName = date("YmdHis") . '.' . $FileExt;
		$UploadDestination = "img/" . $NewName;

		if (move_uploaded_file($TmpLocation, $UploadDestination)) {
			$message .= $NewName;
			$hasil['status'] = true;
		} else {
			$error_code = $File['error'];
			$message .= "Sorry, there was an error uploading your file. Error code: $error_code. ";
			$hasil['status'] = false;
		}
	}

	$hasil['message'] = $message;
	return $hasil;
}
?>