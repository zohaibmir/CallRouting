  $(function() {
                                         
                jQuery("#country_code").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the Country Code in Numeric format"
                });
                jQuery("#area_code").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the City Code in Numeric format"
                });
                jQuery("#number").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the Phone Number in Numeric format"
                });
                
               $(document).ready(function() {
                $('#country_code, #area_code, #number').autotab_magic().autotab_filter('numeric');
                
            });
            });