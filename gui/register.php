<link rel="stylesheet" href="design/css/message.css">
<script>
  ​$('input').keypress(function(e) {
    return e.which !== 32;
  });
</script>
<script>
  function reg_valid() {
   var xmlhttp = new XMLHttpRequest();
      // data
      var data = new FormData();
      var user = document.getElementsByName("reg_user")[0].value;
      var pass = document.getElementsByName("reg_pass")[0].value;
      var conPass = document.getElementsByName("reg_con")[0].value;
      var firstName = document.getElementsByName("reg_fname")[0].value;
      var lastName = document.getElementsByName("reg_lname")[0].value;
      data.append('user', user);
      data.append('pass', pass);
      data.append('conPass', conPass);
      data.append('firstName', firstName);
      data.append('lastName', lastName);
      // send POST-request
      xmlhttp.open("POST", "register_validate.php", true);
      xmlhttp.send(data);
      // recieve data
      xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          try { // catch JSON error
            var serverMess = JSON.parse(xmlhttp.responseText);
            document.getElementById("reg_mess").innerHTML = serverMess.mess;
            if (serverMess.mess == "OK") {
                document.getElementById("bubble_mess").innerHTML = "Register successfully";
                 $('#bubble').fadeIn(1000);
                     setTimeout(function() {
                        $('#bubble').fadeOut(2000);
                     }, 2000);
                $('#id02').hide();
            }
          }
          catch(e) {
            alert("Register failed!");
          }
        }
      }; /**/
    // stop event
    event.preventDefault();
  }
</script>

<div id="id02" class="pmodal">
  <form class="pmodal-content animate">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close">&times;</span>
      <img src="img/loginlogo.png" alt="Avatar" class="avatar">
    </div>

    <div class="logincontainer">
      <input type="text" placeholder="Username" name="reg_user" required id="userpass" maxlength="60">
      <input type="password" placeholder="Password" name="reg_pass" required id="userpass" maxlength="60">
      <input type="password" placeholder="Confirm Password" name="reg_con" required id="userpass" maxlength="60">
      <input type="text" placeholder="First Name" name="reg_fname" required id="userpass" maxlength="60">
      <input type="text" placeholder="Last Name" name="reg_lname" required id="userpass" maxlength="60">
      <div id="reg_mess" style="color:red; text-align: center"></div>
      <button type="button" class="login" onclick="reg_valid()">Register</button>
    </div>
  </form>
</div>