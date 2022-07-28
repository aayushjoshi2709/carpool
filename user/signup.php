<?php
    session_start();
    require("../conn.php");
    $status = 0;
    if(isset($_POST["email"])){
        function validate($str, $conn){
            $str = stripcslashes($str);   
            $str = mysqli_real_escape_string($conn, $str);  
            return $str;
        }
        $firstname = validate($_POST["fname"], $conn);
        $lastname = validate($_POST["lname"], $conn);
        $address = validate($_POST["address"], $conn);
        $phone_no = validate($_POST["phone"], $conn);
        $username = validate($_POST["username"], $conn);
        $email = validate($_POST["email"], $conn);
        $password = validate($_POST["pass"], $conn);
        $stmt = $conn->prepare("SELECT * from userdetails where username = ? or email = ?;");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            $stmt = $conn->prepare("INSERT INTO userdetails values(NULL,?, ?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("sssisss", $firstname, $lastname, $address, $phone_no, $email, $username, $password);
            if($stmt->execute()){
                $status = 1;
                $_SESSION["userid"] = $conn->insert_id;
                $_SESSION["usertype"] = "user";
            }
        }else{
            $status = 2;
        }
        $stmt->close();
    }
    $conn->close();
    require("../partials/header.php");
?>
<div class="container border p-3 px-4 my-5 shadow bg-white rounded"  style="width: 30rem">
    <form action="#" method="post" id="form">
        <h1 class="display-2 text-center m-4">Signup</h1>
        <h1 class="lead text-center m-4">User</h1>
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
                    <input type="text" id="fname" name="fname" class="form-control" />
                    <label class="form-label" for="fname" required>First Name</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="text" id="lname" name="lname" class="form-control" />
                    <label class="form-label" for="lname" required>Last Name</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="text" id="address" name="address" class="form-control" />
                    <label class="form-label" for="address" required>Address</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="number" id="phone" name="phone" class="form-control" />
                    <label class="form-label" for="phone" required>Phone No.</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email" required>Email address</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-outline mb-2">
                    <input type="text" id="username" name="username" class="form-control" />
                    <label class="form-label" for="username" required>Username</label>
                </div>
            </div>
        </div>
        <div class="row">
            <p class="text-danger my-0 py-0" id="notmatch"><p>
            <div class="col-6">
                <div class="form-outline mb-4">
                    <input type="password" id="pass" name="pass" class="form-control" />
                    <label class="form-label" for="pass" required>Password</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-outline mb-4">
                    <input type="password" id="cpass" class="form-control" />
                    <label class="form-label" for="cpass" required>Confirm Password</label>
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