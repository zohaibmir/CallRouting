<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Error Page</title>        
    </head>
    <body>
        <h2>
        An Error Has Occurred</h2>
        <h3 style="color:#cd0a0a">Error Message: <?php echo $_REQUEST["mesg"] ?></h3>
    <p>
        An unexpected error occurred on our website. The website administrator has been notified.
    </p>
    
    <ul>
        <li>
            <a ID="lnkHome" href="index.php">Return to the homepage</a></li>
    </ul>
    </body>
</html>