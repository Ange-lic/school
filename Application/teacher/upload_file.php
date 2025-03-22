<?php 
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
    if (isset($_POST['submit'])) {
        $fileLocation = $_FILES['pdf']['tmp_name'];
        $fileName = generateRandomString();
        $destination = "../../uploads/{$fileName}.pdf";
        move_uploaded_file($fileLocation, $destination);
        $response = new \StdClass;
        $response->link = "http://".$protocol.$_SERVER["HTTP_HOST"] . "/uploads/{$fileName}.pdf";   
        echo stripslashes(json_encode($response)); 
    }
?>