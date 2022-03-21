<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = "";
$email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Remove all illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Voer een E-mail adres in.";
    } elseif(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_err = "Voer een geldig E-mail adres in.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wachtwoord vergeten</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Wachtwoord vergeten</h2>
        <p>Er wordt een E-mail naar u gestuurd met verdere informatie</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>E-mail</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>   
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="E-mail aanvragen">
                <a class="btn btn-link ml-2" href="login.php">Annuleren</a>
            </div>
        </form>
    </div>    
</body>
</html>