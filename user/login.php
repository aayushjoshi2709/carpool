<?php
    
    require("../partials/header.php");
?>
    <div class="container border p-3 px-4 my-5 shadow bg-white rounded"  style="width: 24rem">
    <form>
        <h1 class="display-2 text-center m-4">Login</h1>
        <h1 class="lead text-center m-4">User</h1>

  <div class="form-outline mb-4">
    <input type="email" name="email" id="email" class="form-control" />
    <label class="form-label" for="email">Email address</label>
  </div>
  <div class="form-outline mb-4">
    <input type="password" name="pass" id="pass" class="form-control" />
    <label class="form-label" for="pass">Password</label>
  </div>
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="rememberme" checked />
        <label class="form-check-label" for="rememberme"> Remember me </label>
      </div>
    </div>

    <div class="col">
      <a href="#!">Forgot password?</a>
    </div>
  </div>
  <div class="text-center"> 
     <button type="button" class="btn btn-primary  btn-block mb-4 m-auto">Sign in</button>
  </div>
  <div class="text-center">
    <p>Not a member? <a href="./signup.php">Register</a></p>
  </div>
</form>
    </div>
<?php
    require("../partials/footer.php");
?>
    