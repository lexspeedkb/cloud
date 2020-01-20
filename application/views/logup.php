<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card center-card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">LogUp</h5>
        <span style="color: red"><?=$errorMessage?></span>
        <form action="/auth/logup" method="POST">
            Login<br>
            <input type="text" name="login"><br>
            Name<br>
            <input type="text" name="name"><br>
            Password<br>
            <input type="password" name="password"><br>
            Re-enter password<br>
            <input type="password" name="password_re"><br>
            <input type="hidden" name="log" value="1"><br>
            <input type="submit" class="btn btn-primary" value="LogUp"><br>
        </form>
        <a href="/auth/login">Have an account?</a>
    </div>
</div>