<?php
require_once 'PhoneCallManager.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhoneCallManagerFactory
 *
 * @author zohaib
 * Date 11-Aug-2012
 * A Factory Class for Generating the objects of Phone Call Manager Class
 */
class PhoneCallManagerFactory {
    
    private static  $iCallManager = null;
    
    private function __construct() {
        
    }

    public static function CreateCallManagerFactory() {

        if (!isset(self::$iCallManager)) {
            $iCallManager = new PhoneCallManager();
        }
        return $iCallManager;
    }
}

?>
