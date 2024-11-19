<?php
include("db.php");

if(isset($_POST["create"])){
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $class = mysqli_real_escape_string($conn, $_POST["class"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/'.$file_name;

    $sql = "INSERT INTO student (name, gender, email, address, class_id, created_at, image) VALUES ('$name', '$gender','$email', '$address', '$class', NOW(), '$file_name')";
    
    if(move_uploaded_file($tempname, $folder)){
        echo "File add";
    } else{
        echo "file not added";
    }


    if(mysqli_query($conn, $sql)){
        session_start();
        $_SESSION["create"] = "Student Added Successfully";
        header("Location: index.php");
    }else{
        echo "error" . mysqli_error($conn);
    }
}

if(isset($_POST["edit"])){
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $class = mysqli_real_escape_string($conn, $_POST["class"]);
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);

    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = 'images/'.$file_name;

    if (!empty($file_name)) {
        $sql = "UPDATE student SET name = '$name', gender = '$gender', email = '$email', address = '$address', class_id = '$class', image = '$file_name' WHERE id = $id";
    } else {
        $sql = "UPDATE student SET name = '$name', gender = '$gender', email = '$email', address = '$address', class_id = '$class' WHERE id = $id";
    }    
    
    if(move_uploaded_file($tempname, $folder)){
        echo "File add";
    } else{
        echo "file not added";
    }

    if(mysqli_query($conn, $sql)){
        session_start();
        $_SESSION["update"] = "Edited Student Record Successfully";
        header("Location: index.php");
    }else{
        echo "error" . mysqli_error($conn);
    }
}


    // This will print the query to the screen for debugging purposes
    // echo $sql;


    // echo "Name: " . $name . "<br>";
    // echo "Email: " . $email . "<br>";
    // echo "Address: " . $address . "<br>";
    // echo "Class: " . $class . "<br>";

?>