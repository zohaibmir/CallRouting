<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhoneCallManager
 *
 * @author zohaib
 */
require_once 'OperatorsList.php';
class PhoneCallManager implements IPhoneCallManager {

    private $phoneNumber;
    private $countryCode;
    private $objOperatorsList;
    private $isMatch;
    private $lowestCallPrice;
    private $matchedPrefix;
    private $operatorName;
    private $cheapOpeartosArray;

    public function __construct() {
        $this->isMatch = false;
        $this->lowestCallPrice = 999999;
        $this->matchedPrefix = 0;
        $this->operatorName = "";
        $this->cheapOpeartosArray = array();
    }

    public function SetPhoneNumber(IPhoneCall $objPhoneCall) {
        try {
            $this->phoneNumber = $objPhoneCall->getCountryCode() . $objPhoneCall->getAreaCode() . $objPhoneCall->getNumber();
            $this->countryCode = $objPhoneCall->getCountryCode();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function FindLowestCallPriceOperators() {
        $tempCallPrice = 0;
        $tempMatchFound= false;
        $this->objOperatorsList = new OperatorsList();
        foreach ($this->objOperatorsList as $OperatorName => $value) {
            $tempPrefixLength = 0;
            $tempLongestPrefix = 0;
            foreach ($this->objOperatorsList->$OperatorName as $Prefix => $OperatorPrice) {
                if (substr_compare($Prefix, $this->countryCode, 0, strlen($this->countryCode)) == 0) {
                    if (preg_match("/$Prefix/", $this->phoneNumber)) {
                        if ($this->IsLongestPrefix($Prefix, $tempPrefixLength)) {
                            $tempCallPrice = $OperatorPrice;
                            $tempLongestPrefix = $Prefix;
                            $tempMatchFound = true;
                        }
                    }
                }
            }
            $this->FindCheapestPriceOperator($tempCallPrice, $OperatorName, $tempLongestPrefix);
            
            if ($this->isMatch) {
                $arrayKey = $OperatorName . ',' . $tempLongestPrefix;
                $this->cheapOpeartosArray[$arrayKey] = $tempCallPrice;
            }

            $this->isMatch == false;
        }
        return $tempMatchFound;
    }

    public function GetCheapestOperator() {
        return "<br /><span style='color: #a71010'>Cheapest Operator Name: </span>&nbsp; $this->operatorName <br />  <span style='color: #a71010'>Call Price:</span>&nbsp; $this->lowestCallPrice <br />  <span style='color: #a71010'> Matched Prefix: </span>&nbsp; $this->matchedPrefix<br /><br />";
    }

    public function GetAllMatchedOperators() {
        $output = '<div id="psdgraphics-com-table">
                <div id="psdg-header">
                    <span class="psdg-bold">All Ralevent Call Operators</span><br />
                    
                </div>
                <div id="psdg-top">
                    <div class="psdg-top-cell" style="text-align:left; padding-left: 24px;">Operator Name</div>
                    <div class="psdg-top-cell">Call Price</div>
                    <div class="psdg-top-cell">Prefix</div>                    
                </div>
                
                <div id="psdg-middle">';
        asort($this->cheapOpeartosArray);
        
        foreach ($this->cheapOpeartosArray as $key => $value) {
            $keyPrefix = explode(',', $key);
            $output = $output . "<div class='psdg-left'>$keyPrefix[0]</div>
                                 <div class='psdg-right'>$value</div>
                                 <div class='psdg-right'>$keyPrefix[1]</div>";
        }
        $output .= '<div id="psdg-bottom">
                        <div class="psdg-bottom-cell" style="width:129px; text-align:left; padding-left: 24px;"></div>
                        <div class="psdg-bottom-cell"></div>
                        <div class="psdg-bottom-cell" style="border:none;"></div>
                    </div>
                </div>
                </div>';
        return $output;
    }

    public function FindCheapestPriceOperator($tempCallPrice, $OperatorName, $tempLongestPrefix) {
        if ($tempCallPrice < $this->lowestCallPrice && $this->isMatch == true) {
            $this->lowestCallPrice = $tempCallPrice;
            $this->matchedPrefix = $tempLongestPrefix;
            $this->operatorName = $OperatorName;
        }
    }

    public function IsLongestPrefix($Prefix, &$PrefixLength) {

        if (strlen($Prefix) > $PrefixLength) {
            $PrefixLength = strlen($Prefix);
            $this->isMatch = true;
            return true;
        }
        return false;
    }

}

?>
