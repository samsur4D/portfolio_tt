<?php
$uploadDir = 'uploads/';
$uploadFile = $uploadDir . basename($_FILES['photoUpload']['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST['submit'])) {
  $check = getimagesize($_FILES['photoUpload']['tmp_name']);
  if ($check !== false) {
    echo 'File is an image - ' . $check['mime'] . '.';
    $uploadOk = 1;
  } else {
    echo 'File is not an image.';
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES['photoUpload']['size'] > 500000) {
  echo 'Sorry, your file is too large.';
  $uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg'
  && $imageFileType != 'gif') {
  echo 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo 'Sorry, your file was not uploaded.';
  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES['photoUpload']['tmp_name'], $uploadFile)) {
    echo 'The file ' . htmlspecialchars(basename($_FILES['photoUpload']['name'])) . ' has been uploaded.';
  } else {
    echo 'Sorry, there was an error uploading your file.';
  }
}
?>
