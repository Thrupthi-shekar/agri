<?php
    session_start();
    require '../db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = dataFilter($_POST['name']);
        $mobile = dataFilter($_POST['mobile']);
        $user = dataFilter($_POST['uname']);
        $email = dataFilter($_POST['email']);
        $id = $_SESSION['id'];

        $_SESSION['Email'] = $email;
        $_SESSION['Name'] = $name;
        $_SESSION['Username'] = $user;
        $_SESSION['Mobile'] = $mobile;

        if ($_SESSION['Category'] == 1) {
            $sql = "UPDATE farmer SET fname='$name', fusername='$user', fmobile='$mobile', femail='$email' WHERE fid='$id';";
        } else {
            $sql = "UPDATE buyer SET bname='$name', busername='$user', bmobile='$mobile', bemail='$email' WHERE bid='$id';";
        }

        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $_SESSION['message'] = "Profile Updated successfully !!!";
            header("Location: ../profileView.php");
        }
        else
        {
            $_SESSION['message'] = "There was an error in updating your profile! Please Try again!";
            header("Location: ../Login/error.php");
        }
        
    }
    

    function dataFilter($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


?>
