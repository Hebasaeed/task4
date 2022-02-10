<?php
session_start();
function Clean($input,$flag = 0){

    $input =  trim($input);

    if($flag == 0){
    $input =  filter_var($input,FILTER_SANITIZE_STRING);   // <>>>>>
    }
    return $input;
}





$errors = []; 
//validate name 

if(empty($name)){
    $errors['name'] = "Field Required"; 
}elseif(!filter_var($name,FILTER_VALIDATE_STRING)){
    $errors['name']   = "Invalid name";
 }


//validate email 
if(empty($email)){
    $errors['email'] = "Field Required";
}elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
   $errors['Email']   = "Invalid Email";
}

// validate password 
if(empty($password)){
    $errors['password'] = "Field Required";
}elseif(strlen($password) < 6){
    $errors['Password'] = "Length Must be >= 6 characters";
}


// validate address
if(empty($address)){
    $errors['address'] = "Field Required";
}elseif(strlen($address) < 10){
    $errors['address'] = "Length Must be >= 10 characters";
}

//validate url
if(empty($url)){
    $errors['url'] = "Field Required"; 
}elseif(!filter_var($email,FILTER_VALIDATE_URL)){
    $errors['url']   = "Invalid url";
 }

 //validate gender 

if(empty($gender)){
    $errors['gender'] = "Field Required"; 
}elseif(!filter_var($gender,FILTER_VALIDATE_GENDER)){
    $errors['gender']   = "Invalid GGENDER";
 }


 if($_SERVER['REQUEST_METHOD'] == "POST"){

    $name     = Clean($_POST['name']);
    $password = Clean($_POST['password'],1);
    $email    = Clean($_POST['email']);
    $address  = $_POST['address'];
    $url      = $_POST['url'];
    $gender   = $_POST['gender'];


    echo $name.' ||<br> '.$email.' || <br>'.$password .' ||<br> '.$address.' || <br>'.$url .'||<br>'. $gender.'||<br>';
}







if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_FILES['image']['name'])) {

        $imgName  = $_FILES['image']['name'];
        $imgTemp  = $_FILES['image']['tmp_name'];
        $imgType  = $_FILES['image']['type'];   

        $nameArray =  explode('.', $imgName);
        $imgExtension =  strtolower(end($nameArray));

        $imgFinalName = time() . rand() . '.' . $imgExtension;

        $allowedExt = ['png', 'jpg'];

        if (in_array($imgExtension, $allowedExt)) {
            

            $disPath = 'uploadsimg/' . $imgFinalName;

            if (move_uploaded_file($imgTemp, $disPath)) {
                echo 'File Uploaded';
            } else {
                echo 'Error In Uploading Try Again';
            }
        } else {
            echo 'InValid Extension';
        }
    } else {

        echo ' Image Required';
    }
}


$_SESSION['Nname']=$name;
$_SESSION['Ppassword']=$password;
$_SESSION['Aaddress']=$address;
$_SESSION['Uurl']=$url;





?>





