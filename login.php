<?php
// Initialize the session
session_start();
 // Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 // Include config file
require_once "databaseConn.php";
// Define variables and initialize with empty values
$accountnum = $password = "";
$accountnum_err = $password_err = "";
 // Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
     // Check if accountnum is empty
    if(empty(trim($_POST["acctNo"]))){
        $accountnum_err = "Please your Account Number.";
    } else{
        $accountnum = trim($_POST["acctNo"]);
    }
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    // Validate credentials
    if(empty($accountnum_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT userID, username, password FROM syst_acct WHERE username = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_accountnum);
            // Set parameters
            $param_accountnum = $accountnum;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                // Check if accountnum exists, if yes then verify password
                if($stmt->num_rows == 1){
                    // Bind result variables
                    $stmt->bind_result($id, $accountnum, $hashed_password);
                    if($stmt->fetch()){
                        // if(password_verify($password, $hashed_password)){
                        if($password === $hashed_password){
                            // Password is correct, so start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["acctNo"] = $accountnum;
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid." . $hashed_password;
                        }
                    }
                } else{
                    // Display an error message if accountnum doesn't exist
                    $accountnum_err = "No account found with that Account Number.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            $stmt->close();
        }
    }
    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>Login Page</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="form-group <?php echo (!empty($accountnum_err)) ? 'has-error' : ''; ?>">
        <label for="acctNo">Account Number</label><br>
        <input type="text" id="username" name="acctNo" value="<?php echo $accountnum ?>" required><br>
        <span class="help-block"><?php echo $accountnum_err; ?></span>
      </div>
      <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" required> <br><br>
        <span class="help-block"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group">
      <input type="submit" value="Login" name="btnLogin">
      </div>
    </form>
  </body>
</html>
