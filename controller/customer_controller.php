<?php

session_start();

require_once("../model/customer_model.php");

class Customer_Controller extends Customer
{
    public function selectCustomer_infoByEmail($email)
    {
        $result = parent::getCustomer_infoByEmail($email);

        if ($result->num_rows > 0) {
            $response = 1;
        } else {
            $response = 0;
        }

        return $response;
    }

    public function selectCustomer_infoByNIC($nic)
    {
        $result = parent::getCustomer_infoByNIC($nic);

        if ($result->num_rows > 0) {
            $response = 1;
        } else {
            $response = 0;
        }

        return $response;
    }

    public function createNewCustomer($fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $nic, $contact, $uimg, $email, $pw)
    {
        $result = parent::insertNewCustomer($fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $nic, $contact, $uimg, $email, $pw);

        return $result;
    }

    public function updateCustomer($fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $contact, $uimg, $customerId)
    {
        $result = parent::editCustomer($fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $contact, $uimg, $customerId);

        if ($result) {
            $response = "Changed Applied";
            $status = "success";
        } else {
            $response = "Something Went Wrong. Task Fail";
            $status = "danger";
        }

        header("Location: ../view/editCustomer.php?response=$response&status=$status");
    }

    public function updatePassword($customerId, $newPw, $currPw)
    {
        $cusInfo = parent::getCustomer_infoById($customerId);
        $cusArray = $cusInfo->fetch_assoc();

        if (isset($_SESSION["resetKey"])) {

            $result = parent::editPassword($customerId, md5($newPw));

            if ($result) {

                unset($_SESSION["resetKey"]);

                $customer_array = array(
                    "cusId" => $customerId,
                    "cusFname" => $cusArray["customer_fname"],
                    "cusLname" => $cusArray["customer_lname"],
                    "cusUimg" => $cusArray["customer_img"]
                );

                $_SESSION["customer"] = $customer_array;

                header("Location: ../view/dashboard.php");
            } else {
                $response = "Something Went Wrong. Task Fail";
                $status = "danger";

                header("Location: ../view/changePassword.php?response=$response&status=$status");
            }
        } else if ($cusArray["login_password"] == md5($currPw)) {
            $result = parent::editPassword($customerId, md5($newPw));

            if ($result) {
                $response = "Password Reset Successfully";
                $status = "success";
            } else {
                $response = "Something Went Wrong. Task Fail";
                $status = "danger";
            }

            header("Location: ../view/changePassword.php?response=$response&status=$status");
        } else {
            $response = "Sorry..Current Password Incorrect";
            $status = "danger";

            header("Location: ../view/changePassword.php?response=$response&status=$status");
        }
    }
}

$cusCont_obj = new Customer_Controller($conn);

//////////////////////// Switch Requests ///////////////////////
$request = isset($_GET["type"]) ? $_GET["type"] : "";

switch ($request) {

    case 'checkEmail':

        $email = $_GET["email"];

        echo $cusCont_obj->selectCustomer_infoByEmail($email);

        break;

    case 'checkNIC':

        $nic = $_GET["nic"];

        echo $cusCont_obj->selectCustomer_infoByNIC($nic);

        break;

    case 'addNewCustomer':

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $nic = $_POST["nic"];
        $contact = "0" . $_POST["contact"];
        $gender = $_POST["gender"];
        $postalId = $_POST["postalcode"];
        $pw = md5($_POST["pw"]);
        $addr1 = $_POST["addr1"];
        $addr2 = $_POST["addr2"];
        $addr3 = $_POST["addr3"];
        $email = $_POST["email"];

        if ($_FILES["uimg"]["name"] != "") {
            $uimg = $_FILES["uimg"]["name"];
            $uimg = time() . "_" . $uimg;

            $tmp_location = $_FILES["uimg"]["tmp_name"];
            $permanent = "../image/users/$uimg";
        } else {
            $uimg = ($gender == "M") ? "defaultImageM.jpg" : "defaultImageF.jpg";
        }

        $result = $cusCont_obj->createNewCustomer($fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $nic, $contact, $uimg, $email, $pw);

        if ($result) {

            move_uploaded_file($tmp_location, $permanent);

            $getResult = $result->fetch_assoc();
            $customerId = $getResult["nextCusId"];

            $customer_array = array(
                "cusId" => $customerId,
                "cusFname" => $fname,
                "cusLname" => $lname,
                "cusUimg" => $uimg
            );

            $_SESSION["customer"] = $customer_array;

            header("Location: ../view/dashboard.php");
        } else {
            $response = "Something Went Wrong. Task Fail";
            $status = "danger";

            header("Location: ../view/registerForm.php?response=$response&status=$status");
        }

        break;

    case 'editCustomer':

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $contact = "0" . $_POST["contact"];
        $gender = $_POST["gender"];
        $postalId = $_POST["postalcode"];
        $addr1 = $_POST["addr1"];
        $addr2 = $_POST["addr2"];
        $addr3 = $_POST["addr3"];

        $uimg = $_SESSION["customer"]["cusUimg"];

        if ($_FILES["uimg"]["name"] != "") {
            $uimg = $_FILES["uimg"]["name"];
            $uimg = time() . "_" . $uimg;

            $tmp_location = $_FILES["uimg"]["tmp_name"];
            $permanent = "../image/users/$uimg";

            move_uploaded_file($tmp_location, $permanent);

            unlink("../image/users/" . $_SESSION["customer"]["cusUimg"]);

            $_SESSION["customer"]["cusUimg"] = $uimg;
        }

        $_SESSION["customer"]["cusFname"] = $fname;
        $_SESSION["customer"]["cusLname"] = $lname;

        $customerId = $_SESSION["customer"]["cusId"];

        $cusCont_obj->updateCustomer($fname, $lname, $addr1, $addr2, $addr3, $postalId, $gender, $contact, $uimg, $customerId);

        break;

    case 'changePW':

        $customerId = $_POST["customerId"];
        $newPw = $_POST["npw"];
        $currPw = isset($_POST["pw"]) ? $_POST["pw"] : "";

        $cusCont_obj->updatePassword($customerId, $newPw, $currPw);

        break;
}
