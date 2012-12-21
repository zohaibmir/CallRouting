<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhoneCall
 *
 * @author zohaib
 * Date 08-Aug-2012
 * The Class act as a Business Entity.
 */

class PhoneCall implements IPhoneCall {
    private $countryCode;
    private $areaCode;
    private $phoneNumebr;
    
    public function __construct() {
        //echo "myClass init'ed successfuly!!!";
    }

    public function setCountryCode($countryCode) {
        $this->countryCode = ltrim($countryCode, "0");
        if($this->countryCode == 0 || empty($this->countryCode))
            throw new Exception("Please Enter a valid Numeric Country Code");
    }
    
    public function getCountryCode() {
        return $this->countryCode;
    }
    
    public function setAreaCode($areaCode) {
        $this->areaCode = $areaCode;
    }
    
    public function getAreaCode() {
        return $this->areaCode;
    }
    
    public function setNumber($phoneNumber) {
        $this->phoneNumebr = $phoneNumber;
    }
    
    public function getNumber() {
        return $this->phoneNumebr;
    }

}

?>
