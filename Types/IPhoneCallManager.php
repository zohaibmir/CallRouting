<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author zohaib
 */
interface IPhoneCallManager {
    //put your code here
    public function SetPhoneNumber(IPhoneCall $objPhoneCall);
    public function FindLowestCallPriceOperators();
    public function GetCheapestOperator();
    public function GetAllMatchedOperators();
    public function FindCheapestPriceOperator($tempCallPrice, $OperatorName, $tempLongestPrefix);
    public function IsLongestPrefix($Prefix, &$PrefixLength);
}

?>
