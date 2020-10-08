<script>
    $("input").on("keydown", function (e) {
      return e.which !== 32;
    });​​​​​
</script>

<div id="id01" class="pmodal">

    <form class="pmodal-content animate" action="login_validate.php" method="post">

        <div class="imgcontainer">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close">&times;</span>
            <img src="img/loginlogo.png" alt="Avatar" class="avatar">
        </div>

        <div class="logincontainer">
            <input type="text" placeholder="Username" name="user" required id="userpass" maxlength="60">
            <input type="password" placeholder="Password" name="pass" required id="userpass" maxlength="60">
            <button type="submit" class="login">Login</button>
            <div style="text-align:center">
                <a href="#" class="forgot">Forgot password</a>
            </div>
        </div>

    </form>

</div>