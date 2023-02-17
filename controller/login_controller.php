<?php

session_start();

require_once("../model/customer_model.php");

class Login_Controller extends Customer
{
    public function login($email, $pw, $keepLog)
    {
        $result = parent::getCustomer_infoByEmail($email);

        if ($result->num_rows > 0) {
            $cusInfo = $result->fetch_assoc();

            if ($cusInfo["login_password"] == md5($pw)) {

                $customer_array = array(
                    "cusId" => $cusInfo["customer_id"],
                    "cusFname" => $cusInfo["customer_fname"],
                    "cusLname" => $cusInfo["customer_lname"],
                    "cusUimg" => $cusInfo["customer_img"]
                );

                $_SESSION["customer"] = $customer_array;
                unset($_SESSION["otp"]);

                if ($keepLog == "yes") {
                    setcookie("cusEmail", $email, time() + 3600, "/");
                }

                header("Location: ../view/dashboard.php");
            } else {
                $response = "Login Credentials Doesn't Match";
                $status = "danger";

                header("Location: ../view/login.php?response=$response&status=$status");
            }
        } else if (isset($_SESSION["otp"])) {

            if ($_SESSION["otp"]["email"] == $email && $_SESSION["otp"]["num"] == $pw) {
                unset($_SESSION["otp"]);
                header("Location: ../view/registerForm.php?email=$email");
            } else {
                $response = "OTP Credentials Doesn't Match";
                $status = "danger";

                header("Location: ../view/login.php?response=$response&status=$status");
            }
        } else {
            $response = "You are Unregistered User !!";
            $status = "danger";

            header("Location: ../view/login.php?response=$response&status=$status");
        }
    }

    public function keepLogin($email)
    {
        $result = parent::getCustomer_infoByEmail($email);
        $getInfo = $result->fetch_assoc();

        $customer_array = array(
            "cusId" => $getInfo["customer_id"],
            "cusFname" => $getInfo["customer_fname"],
            "cusLname" => $getInfo["customer_lname"],
            "cusUimg" => $getInfo["customer_img"]
        );

        $_SESSION["customer"] = $customer_array;
        setcookie("cusEmail", $email, time() + 3600, "/");

        header("Location: ../view/dashboard.php");
    }

    public function checkCustomerEmail($email)
    {
        $result = parent::getCustomer_infoByEmail($email);

        return $result;
    }
}

$logCont_obj = new Login_Controller($conn);

//////////////////////// Switch Requests ///////////////////////
$request = isset($_GET["type"]) ? $_GET["type"] : "";

switch ($request) {

    case 'sendOTP':

        $email = $_POST["email"];
        $otp_num = rand(10000, 99999);

        $otp_array = array("email" => $email, "num" => $otp_num);

        include_once("../common/mailConfig.php");

        $subject = "Email Verfication Code";
        $body = "<h3>Your OTP is :- " . $otp_num . "</h3>";

        $mailResult = sendMail($email, $subject, $body);

        if ($mailResult) {

            $_SESSION["otp"] = $otp_array;

            $response = "Email has been sent";
            $status = "success";
        } else {
            $response = "Connection error. Try Again";
            $status = "danger";
        }

        header("Location: ../view/login.php?response=$response&status=$status");

        break;

    case 'login':

        $email = $_POST["email"];
        $pw = $_POST["pw"];
        $keepLog = isset($_POST["keepLogin"]) ? "yes" : "";

        $logCont_obj->login($email, $pw, $keepLog);

        break;

    case 'logout':

        unset($_SESSION["customer"]);
        setcookie("cusEmail", "", time() - 3600, "/");

        header("Location: ../view/login.php");

        break;

    case 'keepLogin':

        $email = $_GET["email"];

        $logCont_obj->keepLogin($email);

        break;

    case 'sendResetLink':

        $email = $_POST["email"];

        $checkEmail = $logCont_obj->checkCustomerEmail($email);

        if ($checkEmail->num_rows > 0) {

            $cusArray = $checkEmail->fetch_assoc();
            $customerId = base64_encode($cusArray["customer_id"]);
            $key = time() . rand(1000, 9999);
            $key = sha1($key);

            include_once("../common/mailConfig.php");

            $subject = "Reset Password";
            $body = "Reset your password via this link : http://localhost/bsrtextile/view/changePassword.php?resetKey=$key&customerId=$customerId";

            $sendMail = sendMail($email, $subject, $body);

            if ($sendMail) {

                $_SESSION["resetKey"] = $key;

                $response = "Reset Link Has Been Sent !!";
                $status = "success";
            } else {
                $response = "Something Went Wrong. Try Again";
                $status = "danger";
            }
        } else {
            $response = "Entered Email Doesn't Matching With Our Records";
            $status = "danger";
        }

        header("Location: ../view/passwordReset.php?response=$response&status=$status");

        break;
}
