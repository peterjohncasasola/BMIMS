<template>
  <div class="login-box">
    <div class="login-logo">
      <a href="#">
        <b>Hotel</b> Cresencia
      </a>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feed back"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
        </div>
      </form>
      <!-- <a href="#">I forgot my password</a> -->
      <br>
      <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
    </div>
  </div>
</template>

<script>
import { Sidebar, Footer, Header, Content } from "../../layout/index.js";

export default {
  name: "Login",
  components: {
    "app-footer": Footer,
    "app-header": Header,
    "app-sidebar": Sidebar,
    "app-content": Content
  }
};
</script>