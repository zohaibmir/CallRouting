<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author zohaib
 */
interface IPhoneCall {
    public function setCountryCode($countryCode);
    public function getCountryCode();
    public function setAreaCode($areaCode);
    public function getAreaCode();
    public function setNumber($phoneNumber);
    public function getNumber();
}

?>
