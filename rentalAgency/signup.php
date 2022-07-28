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
        $name = validate($_POST["name"], $conn);
        $address = validate($_POST["address"], $conn);
        $phone_no = validate($_POST["phone"], $conn);
        $username = validate($_POST["username"], $conn);
        $email = validate($_POST["email"], $conn);
        $password = validate($_POST["pass"], $conn);
        $stmt = $conn->prepare("SELECT * from rentalagency where username = ? or email = ?;");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO rentalagency values(NULL,?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("ssisss", $name, $address, $phone_no, $email, $username, $password);
            if($stmt->execute()){
                $status = 1;
                $_SESSION["userid"] = $conn->insert_id;
                $_SESSION["usertype"] = "agency";
                header("Location: ../index.php");
            }
        }else{
            $status = 2;
        }
        $stmt->close();
    }
    $conn->close();
?>
<div class="container border p-3 px-4 my-5 shadow bg-white rounded d-flex"  style="width: 30rem">
    <form action="#" method="post" id="form">
        <h1 class="display-2 text-center m-4">Signup</h1>
        <h1 class="lead text-center m-4">Rental Agency</h1>
        <?php
            if($status == 1){
                echo '<div class="alert alert-success" role="alert">
                    User successfully created.
                </div>';
            }else if($status == 2){
                echo '<div class="alert alert-danger" role="alert">
                    Username or Email already exist.
                </div>';
            }
        ?>
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
            
            <p class="text-danger my-0 py-0" id="notmatch"><p>
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
            <button type="submit" class="btn btn-primary  btn-block mb-4 m-auto">Sign Up</button>
        </div>
        <div class="text-center">
            <p>Already a member? <a href="./login.php">Login</a></p>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script>
        let form = document.getElementById("form");
        let cpass = document.getElementById("cpass");
        let pass = document.getElementById("pass");
        let notmatchtext = document.getElementById("notmatch");
        form.addEventListener('submit', (event)=>{
            event.preventDefault();
            if(cpass.value == pass.value){
                notmatchtext.innerHTML = "";
                let cipher = CryptoJS.MD5(pass.value);
                pass.value = cipher.toString();
                cpass.value = cipher.toString();
                console.log(cpass.value)
                form.submit();
            }else{
                notmatchtext.innerHTML = "Passwords does not match.";
            }
        })
    </script>
</div>
<?php
    require("../partials/footer.php");
?>