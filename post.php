<?php

require_once 'Types/IPhoneCall.php';
require_once 'Types/IPhoneCallManager.php';
require_once 'Cls/PhoneCall.php';
require_once 'Cls/PhoneCallManagerFactory.php';
require_once 'Cls/PhoneCallManager.php';
$objPhoneCall = new PhoneCall();
sleep(3);

if (empty($_POST['country_code'])) {
    $return['error'] = true;
    $return['msg'] = 'You did not enter the Country Code.';
} elseif (empty($_POST['area_code'])) {
    $return['error'] = true;
    $return['msg'] = 'You did not enter the Area Code.';
} elseif (empty($_POST['number'])) {
    $return['error'] = true;
    $return['msg'] = 'You did not enter the Number.';
} else {
    $objPhoneCall->setCountryCode((get_magic_quotes_gpc()) ? $_POST["country_code"] : addslashes($_POST["country_code"]));
    $objPhoneCall->setAreaCode((get_magic_quotes_gpc()) ? $_POST["area_code"] : addslashes($_POST["area_code"]));
    $objPhoneCall->setNumber((get_magic_quotes_gpc()) ? $_POST["number"] : addslashes($_POST["number"]));
    $objCallManager = PhoneCallManagerFactory::CreateCallManagerFactory();
    $objCallManager->SetPhoneNumber($objPhoneCall);
    if ($objCallManager->FindLowestCallPriceOperators()) {
        $return['error'] = false;
        $return['msg'] = $objCallManager->GetCheapestOperator();
        $return['msg'] .= $objCallManager->GetAllMatchedOperators();
    }
    else {
        $return['error'] = true;
        $return['msg'] = "<span style='color: #a71010'>No Operator Found for this Number</span>";
    }
    
}

echo json_encode($return);