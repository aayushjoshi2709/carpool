<?php
    require("../partials/header.php");
?>
<div class="container border p-3 px-4 my-5 shadow bg-white rounded d-flex"  style="width: 30rem">
    <form>
        <h1 class="display-2 text-center m-4">Signup</h1>
        <h1 class="lead text-center m-4">Rental Agency</h1>

        <div class="row">
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="text" id="name" name="name" class="form-control" />
                    <label class="form-label" for="name">Name</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="number" id="phone" name="phone" class="form-control" />
                    <label class="form-label" for="phone">Phone No.</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="text" id="username" name="username" class="form-control" />
                    <label class="form-label" for="username">Username</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-outline mb-2">
                    <input type="text" id="address" name="address" class="form-control" />
                    <label class="form-label" for="address">Address</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-outline mb-4">
                    <input type="password" id="pass"  name="pass" class="form-control" />
                    <label class="form-label" for="pass">Password</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-outline mb-4">
                    <input type="password" id="cpass"  class="form-control" />
                    <label class="form-label" for="cpass">Confirm Password</label>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="button" class="btn btn-primary  btn-block mb-4 m-auto">Sign Up</button>
        </div>
        <div class="text-center">
            <p>Already a member? <a href="./login.php">Login</a></p>
        </div>
    </form>
</div>
<?php
    require("../partials/footer.php");
?>