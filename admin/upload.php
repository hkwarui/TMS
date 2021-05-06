<?php
require_once '../includes/db_config.php';

$valid_extension = array('jpeg', 'jpg', 'png', 'gif'); //valid extensions
$path = 'upload/'; //upload directory

//check if the  image is uploaded.
if (isset($_FILES['avatar'])) {
    $sourcePath = $_FILES['avatar']['tmp_name'];
    $targetPath = $_FILES['avatar']['name'];
    $error = $_FILES['image']['error'];

    //Get  uploaded file extension
    $ext = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));

    // can upload same image using rand function
    $final_image  = rand(1000, 1000000) . $sourcePath;

    //check valid format
    if (in_array($ext, $valid_extension)) {
        $path = $path . strtolower($final_image);

        if(move_uploaded_file($targetPath, $path)){
           echo  '<img class="image-preview" src='.$targetPath.'class="upload-preview" />';
        }
}

}
}
if (is_array($_FILES['avatar'])) {
if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
$sourcePath = $_FILES['avatar']['tmp_name'];
$targetPath = "../upload/" . $_FILES['avatar']['name'];
if (move_uploaded_file($sourcePath, $targetPath)) {
?>
<img class="image-preview" src="<?php echo $targetPath; ?>" class="upload-preview" />
<?php
        }
    }
}
?>