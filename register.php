<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
      function myFunction() {
        var x = document.getElementById("userType");

        var userfield = document.getElementById("userField");

        if ( x.options[x.selectedIndex].text == "User") {
          userField.style.display = "block";
          guestField.style.display = "none";
        } else if(x.options[x.selectedIndex].text == "Guest"){
          guestField.style.display = "block";
          userField.style.display ="none";
        }else {
          
        }
      }
    </script>
  </head>
  <body>
    <h1>User Registration</h1>
    <form action="register.php">

      <label for="IDType">Select ID Type: </label>
      <select name="userType" id="userType" onclick="myFunction();">
        <option value="User">User</option>
        <option value="Guest">Guest</option>
      </select><br><br>

      <fieldset>
        <div class="" id="userField">
          <label for="username">Username:</label><br>
          <input type="text" id="username" name="username" required><br>

          <label for="email">Email:</label><br>
          <input type="text" id="email" name="email" required><br><br>

          <label for="password">Password:</label><br>
          <input type="password" id="password" name="password" required><br>

          <label for="confirmpassword">Confirm Password:</label><br>
          <input type="password" id="confirmPass" name="confirmPass" required> <br><br>

          <fieldset style="width:80%;">
            <legend>User's Information</legend>

            <label for="fullname">Fullname</label><br>
            <input type="text" id="fname" name="fname" placeholder="Enter First Name" required>
            <input type="text" id="mname" name="mname" placeholder="Enter Middle Name" required>
            <input type="text" id="lname" name="lname" placeholder="Enter Last Name" required><br>

            <label for="Address">Address</label><br>
            <input type="text" id="address" name="address" placeholder="Your Billing Address" required><br>

            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" placeholder="Enter Email Address" required><br>

            <label for="contact">Contact</label><br>
            <input type="text" id="contact" name="contact" placeholder="Your Contact Number" required><br>

          </fieldset><br>
        </div>
        <div class="" id = "guestField" style="display:none;">
          <label for="username">Guest Name</label><br>
          <input type="text" id="guestname" name="guestname" required><br>

          <label for="gEmail">Email</label><br>
          <input type="text" id="gEmail" name="gEmail" required><br><br>

          <label for="gContact">Contact Number</label><br>
          <input type="text" id="gContact" name="gContact" required><br>

          <label for="gAddress">Address:</label><br>
          <input type="gAddress" id="gAddress" name="gAddress" required> <br><br>
        </div>
      </fieldset><br>

      <input type="submit" value="Login" name="btnRegister">
    </form>
  </body>
</html>
