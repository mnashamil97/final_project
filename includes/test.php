<?php

// $conn = new mysqli("localhost", "root", "", "mydb");

// try {
//     $stmt = $conn->prepare("INSERT INTO employee(emp_name, emp_age, emp_salary, dep_no) VALUES(?,?,?,?)");

//     $name = "Hello";
//     $age = 44;
//     $salary = 44000.00;
//     $dep_no = 4;

//     $stmt->bind_param("sidi", $name, $age, $salary, $dep_no);

//     $stmt->execute();

//     $result = $conn->insert_id;
// } catch (Exception $e) {
//     $result  = false;
//     //die($e->getMessage());
// }

// if ($result) {
//     echo $result;
// } else {
//     echo 'Error';
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<style>
    .active {
        color: gold;
    }

    ul>li.active::after,
    ul>li.active::before {
        background-color: gold;
    }

    ul {
        list-style: none;
        padding: 0;
        display: flex;
    }

    li {
        width: 50%;
        position: relative;
        text-align: center;
    }

    li::before {
        font-family: "Font Awesome 6 Free";
        content: "\f21a";
        font-weight: 900;

        display: block;
        width: 50px;
        height: 50px;
        background-color: grey;
        border-radius: 50%;
        margin: 0 auto;
        box-sizing: border-box;
        padding-top: 12px;
        color: white;
        font-size: 20px;
    }

    li::after {
        content: "";
        position: absolute;
        width: 100%;
        background-color: grey;
        height: 5px;
        left: 0;
        top: 25px;
        z-index: -1;
    }

    /* ///////////// */
    .star-widget label {
        color: #444;
        font-size: 25px;
        -webkit-transition: all 0.2s ease;
        -o-transition: all 0.2s ease;
        transition: all 0.2s ease;
    }

    .inputs:not(:checked)~label:hover,
    .inputs:not(:checked)~label:hover~label,
    .inputs:checked~label {
        color: #fd4;
    }

    .inputs#rate-5:checked~label {
        color: #fe7;
        text-shadow: 0 0 20px #952;
    }

    input[name="rate"] {
        display: none;
    }
</style>

<body>

    <!-- <ul>
        <li class="">ABC</li>
        <li class="">EFG</li>
-->

    <div class="row">
        <div class="col-10 mx-auto">

            <div class="star-widget" style="float: left;">
                <input type="radio" name="rate" id="rate-5" class="inputs" value="5">
                <label for="rate-5" class="fas fa-star" style="float: right;"></label>
                <input type="radio" name="rate" id="rate-4" class="inputs" value="4">
                <label for="rate-4" class="fas fa-star" style="float: right;"></label>
                <input type="radio" name="rate" id="rate-3" class="inputs" value="3">
                <label for="rate-3" class="fas fa-star" style="float: right;"></label>
                <input type="radio" name="rate" id="rate-2" class="inputs" value="2">
                <label for="rate-2" class="fas fa-star" style="float: right;"></label>
                <input type="radio" name="rate" id="rate-1" class="inputs" value="1">
                <label for="rate-1" class="fas fa-star" style="float: right;"></label>
            </div>

        </div>
    </div>

</body>

</html>