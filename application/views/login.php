<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="card center-card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">LogIn</h5>
        <span style="color: red"><?=$errorMessage?></span>
        <form action="/auth/login" method="POST">
            Login<br>
            <input type="text" name="login"><br>
            Password<br>
            <input type="password" name="password"><br>
            <input type="hidden" name="log" value="1"><br>
            <input type="submit" class="btn btn-primary" value="LogIn"><br>
            <br>
        </form>
        <a href="/auth/logup">Need registration?</a>
    </div>
</div>