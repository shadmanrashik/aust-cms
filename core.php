<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Dhaka");
$date = date(("Y-m-d"));
$currentPage = $_SERVER['REQUEST_URI'];
$alert = FALSE;

function createInvoiceNo() {
    $chars = "003232303232023232023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

$orderFinalcode='ACMS-'.createInvoiceNo();
$purchaseFinalcode = 'ORDN-'.createInvoiceNo();
$onlineOrderFinalcode='ACMSOO-'.createInvoiceNo();

function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function formatMoney($number, $fractional=false) {
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}

function loggedin() {   //checks the current session
    if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
        return true;
    } else {
        return false;
    }
}

function loggedinadmin() {   //checks the current session
    if (isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
        if ($_SESSION['userType'] == 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
