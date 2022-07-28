<?php
    require("../partials/header.php");
    require("../conn.php");
    $status = 0;
    
    // old user need to be logged out for a new user to login or signup
    if(isset($_SESSION["userid"]) && 
    isset($_SESSION["usertype"])){
        header("Location: ../index.php");
        die(); 
    }
    if(isset($_POST["email"])){
        function validate($str, $conn){
            $str = stripcslashes($str);   
            $str = mysqli_real_escape_string($conn, $str);  
            return $str;
        }
        $email = validate($_POST["email"], $conn);
        $password = validate($_POST["pass"], $conn);
        $stmt = $conn->prepare("SELECT * from rentalagency where email = ? and password = ?;");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
          $row = $result->fetch_array(MYSQLI_NUM);
          $status = 1;
          $_SESSION["userid"] = $row[0];
          $_SESSION["usertype"] = "agency";
          header("Location: ../index.php");
        }else{
            $status = 2;
        }
        $stmt->close();
    }
    $conn->close();
?>
<div class="container border p-3 px-4 my-5 shadow bg-white rounded" style="width: 24rem">
    <form action="#" method="post" id="form">
        <h1 class="display-2 text-center m-4">Login</h1>
        <h1 class="lead text-center m-4">Rental Agency</h1>
        <?php
            if($status == 1){
                echo '<div class="alert alert-success" role="alert">
                    Login Successful.
                </div>';
            }else if($status == 2){
                echo '<div class="alert alert-danger" role="alert">
                    Wrong email or password.
                </div>';
            }
        ?>
        <div class="form-outline mb-4">
            <input type="email" name="email" id="email" class="form-control" />
            <label class="form-label" for="email">Email address</label>
        </div>
        <div class="form-outline mb-4">
            <input type="password" id="pass" name="pass" id="password" class="form-control" />
            <label class="form-label" for="password">Password</label>
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
            <button type="submit" class="btn btn-primary  btn-block mb-4 m-auto">Sign in</button>
        </div>
        <div class="text-center">
            <p>Not a member? <a href="./signup.php">Register</a></p>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script>
    let form = document.getElementById("form");
    let pass = document.getElementById("pass");
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        let cipher = CryptoJS.MD5(pass.value);
        pass.value = cipher.toString();
        form.submit();
    })
    </script>
</div>
<?php
    require("../partials/footer.php");
?>