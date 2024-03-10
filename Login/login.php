<?php
    session_start();
    // echo $_POST['name'];
    // echo $_POST['pass'];
    // echo $_POST['category'];
    $user = dataFilter($_POST['name']);
    $pass = $_POST['pass'];
    $category = dataFilter($_POST['category']);
    // echo $user;
    // echo $pass;
    // echo $category;
    require '../db.php';

if($category == 1)
{
    $sql = "SELECT * FROM farmer WHERE fusername='$user'";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);

    if($num_rows == 0)
    {
        // echo "hello db";
        $_SESSION['message'] = "Invalid farmer User Credentialss!";
        header("location: error.php");
    }

    else
    {
        $User = $result->fetch_assoc();

        if ($_POST['pass'] == $User['fpassword'])
        {
            $_SESSION['id'] = $User['fid'];
            // $_SESSION['Hash'] = $User['fhash'];
            $_SESSION['Password'] = $User['fpassword'];
            $_SESSION['Email'] = $User['femail'];
            $_SESSION['Name'] = $User['fname'];
            $_SESSION['Username'] = $User['fusername'];
            $_SESSION['Mobile'] = $User['fmobile'];
            $_SESSION['Addr'] = $User['faddress'];
            $_SESSION['Active'] = $User['factive'];
            $_SESSION['picStatus'] = $User['picStatus'];
            $_SESSION['picExt'] = $User['picExt'];
            $_SESSION['logged_in'] = true;
            $_SESSION['Category'] = 1;
            $_SESSION['Rating'] = 0;

            if($_SESSION['picStatus'] == 0)
            {
                $_SESSION['picId'] = 0;
                $_SESSION['picName'] = "profile0.png";
            }
            else
            {
                $_SESSION['picId'] = $_SESSION['id'];
                $_SESSION['picName'] = "profile".$_SESSION['picId'].".".$_SESSION['picExt'];
            }
            //echo $_SESSION['Email']."  ".$_SESSION['Name'];

            header("location: profile.php");
        }
        else
        {
            // echo "hello password";
            //echo mysqli_error($conn);
            $_SESSION['message'] = "Invalid former password Credentials!";
            header("location: error.php");
        }
    }
}
else
{
    $sql = "SELECT * FROM buyer WHERE busername='$user'";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);

    if($num_rows == 0)
    {
        // echo 'db';
        $_SESSION['message'] = "Invalid buyer User!";
        header("location: error.php");
    }

    else
    {
        $User = $result->fetch_assoc();

        if (($_POST['pass'])==($User['bpassword']))
        {
            $_SESSION['id'] = $User['bid'];
            // $_SESSION['Hash'] = $User['bhash'];
            $_SESSION['Password'] = $User['bpassword'];
            $_SESSION['Email'] = $User['bemail'];
            $_SESSION['Name'] = $User['bname'];
            $_SESSION['Username'] = $User['busername'];
            $_SESSION['Mobile'] = $User['bmobile'];
            $_SESSION['Addr'] = $User['baddress'];
            $_SESSION['Active'] = $User['bactive'];
            $_SESSION['logged_in'] = true;
            $_SESSION['Category'] = 0;

            //echo $_SESSION['Email']."  ".$_SESSION['Name'];

            header("location: profile.php");
        }
        else
        {
            echo $_POST['pass'];
            echo $User['bpassword'];
            // echo "pass";
            //echo mysqli_error($conn);
            // $_SESSION['message'] = "Invalid buyer password!";
            // header("location: error.php");
        }
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
