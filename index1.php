<?php
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);
spl_autoload_register(function ($className) {
            $possibilities = array(
                'Cls' . DIRECTORY_SEPARATOR . $className . '.php',
                'Types' . DIRECTORY_SEPARATOR . $className . '.php',
                $className . '.php'
            );
            foreach ($possibilities as $file) {
                if (file_exists($file)) {
                    include_once($file);
                    return true;
                }
            }
            throw new Exception($file . "   Not Found");
        });
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript" src="Scripts/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="Scripts/jquery.autotab-1.1b.js"></script>        
        <script type="text/javascript" src="Scripts/jquery.validate.js"></script>        
        <script type="text/javascript" src="Scripts/validation.js"></script>     
        <!--script type="text/javascript" src="Scripts/ajaxSubmit.js"></script-->     
        <link href="css/main.css" type="text/css" media="screen, projection" rel="stylesheet" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Telephone Routing Application</title>   
    </head>
    <body>
        <fieldset>
            <form id="demoForm" method="post">


                <legend style="font-size:20px;color: cadetblue;text-align: center">Phone Call Auto Routing Application</legend>


                <div><strong>Phone Number:</strong></div>

                <input type="text" name="country_code" id="country_code" maxlength="4" size="3" /> -

                <input type="text" name="area_code" id="area_code" maxlength="4" size="3" /> -

                <input type="text" name="number" id="number" maxlength="7" size="5" />

                <p>                    
                    <input type="submit" name="submit" id="submit" style="float: left; clear: both; margin-left:200px;" value="Submit" />
                </p>
            </form>

            <div style="margin-top:20px;display: block;float: left">
                <div id="message" style="display: none;margin-top: 20px;">
                </div>
                <div id="waiting" style="display: none;">
                    Please wait<br />
                    <img src="images/ajax-loader.gif" title="Loader" alt="Loader" />
                </div>
            </div>
            <div class="success">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    try {
                        $objPhoneCall = new PhoneCall();
                        $objPhoneCall->setCountryCode((get_magic_quotes_gpc()) ? $_POST["country_code"] : addslashes($_POST["country_code"]));
                        $objPhoneCall->setAreaCode((get_magic_quotes_gpc()) ? $_POST["area_code"] : addslashes($_POST["area_code"]));
                        $objPhoneCall->setNumber((get_magic_quotes_gpc()) ? $_POST["number"] : addslashes($_POST["number"]));
                        $objCallManager = PhoneCallManagerFactory::CreateCallManagerFactory();
                        $objCallManager->SetPhoneNumber($objPhoneCall);
                        if ($objCallManager->FindLowestCallPriceOperators()) {
                            echo $objCallManager->GetCheapestOperator();
                            echo $objCallManager->GetAllMatchedOperators();
                        } else {
                            echo "<span style='color: #a71010'>No Operator Found for this Number</span>";
                        }
                    } catch (Exception $e) {
                        echo "<span style='color: #a71010'>" . $e->getMessage() . "</span>";
                        //header("Location: error.php?mesg=".$e->getMessage());
                    }
                }
                ?>
            </div>
        </fieldset>
    </body>
</html>
