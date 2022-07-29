<?php 
    require("../partials/header.php");
    require("../conn.php");
    $status = 0;
    if(!isset($_SESSION["userid"]) || 
    !isset($_SESSION["usertype"]) ||
    $_SESSION["usertype"] !="agency"){
        header("Location: ../rentalAgency/login.php");
        die(); 
    }
    if(isset($_POST["model"])){
        function validate($str, $conn){
            $str = stripcslashes($str);   
            $str = mysqli_real_escape_string($conn, $str);  
            return $str;
        }
        $model = validate($_POST["model"], $conn);
        $seats = validate($_POST["seats"], $conn);
        $rent = validate($_POST["rent"], $conn);
        $image_url = validate($_POST["image"], $conn);
        $id = $_SESSION["userid"];
        $stmt = $conn->prepare("INSERT INTO registeredvehicles values(NULL,?, ?, ?, ?, ?);");
        $stmt->bind_param("sidsi", $model, $seats, $rent, $image_url, $id);
        if($stmt->execute()){
            $status = 1;
        }
        $stmt->close();
    }
?>
<div class="container border p-3 px-4 my-5 shadow bg-white rounded addupdatevehicle">
    <form method="post" action="#">
        <h1 class="display-2 text-center m-4">Add Vehicle</h1>
        <?php
            if($status == 1){
                echo '<div class="alert alert-success" role="alert">
                    Vehicle added successfully.
                </div>';
            }
        ?>
        <div class="form-outline mb-2">
            <input type="text" id="model" name="model" class="form-control" />
            <label class="form-label" for="model">Model</label>
        </div>
        <div class="form-outline mb-2">
            <input type="number" id="seats" name="seats" class="form-control" />
            <label class="form-label" for="seats">Seating Capacity</label>
        </div>
        <div class="form-outline mb-2">
            <input type="number" id="rent" name="rent" class="form-control" />
            <label class="form-label" for="rent">Rent Per Day</label>
        </div>
        <div class="form-outline mb-2">
            <input type="text" id="image" name="image" class="form-control" />
            <label class="form-label" for="image">Image url</label>
        </div>
        <div class="text-center">
            <button name="submit" type="submit" class="btn btn-primary  btn-block mb-4 m-auto">Add Vehicle</button>
        </div>
    </form>
</div>
<?php
    require("../partials/footer.php");
?>