<?php
    require("../partials/header.php");
    require("../conn.php");
?>
<?php
    $model = "";
    $seat = "";
    $rent = "";
    $image = "";
    $status = 0;
    if(!isset($_SESSION["userid"]) || 
    !isset($_SESSION["usertype"])||
    $_SESSION["usertype"] != "agency"
    ){
        header("Location: ../index.php");
        die(); 
    }
    function validate($str, $conn){
        $str = stripcslashes($str);   
        $str = mysqli_real_escape_string($conn, $str);  
        return $str;
    }
    if(isset($_GET["vehicleNo"])){
        $vehicleNumber = validate($_GET["vehicleNo"], $conn);
        $stmt = $conn->prepare("SELECT * from registeredvehicles where vehicleNumber = ?;");
        $stmt->bind_param("i", $vehicleNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_array(MYSQLI_NUM);
            $model = $row[1];
            $seat = $row[2];
            $rent = $row[3];
            $image = $row[4];
            if($_SESSION["userid"] != $row[5]){
                header("Location: ../index.php");
                die(); 
            }
        }
    }if(isset($_POST["submit"]) && isset($_GET["vehicleNo"])){
        $model = validate($_POST["model"], $conn);
        $seats = validate($_POST["seats"], $conn);
        $rent = validate($_POST["rent"], $conn);
        $image = validate($_POST["image"], $conn);
        $vehicleNumber = validate($_GET["vehicleNo"], $conn);
        $stmt = $conn->prepare("UPDATE registeredvehicles set vehicleModel = ?, seatingCapacity = ?, rentPerDay = ?, ImageUrl = ? where vehicleNumber = ?;");
        $stmt->bind_param("sidsi", $model, $seats, $rent, $image, $vehicleNumber);
        if($stmt->execute()){
            $status = 1;
        }
    }
?>
<div class="container border p-3 px-4 my-5 shadow bg-white rounded addupdatevehicle">
    <form method="post" action="#">
        <h1 class="display-2 text-center m-4">Update Vehicle</h1>
        <?php
            if($status == 1){
                    echo '<div class="alert alert-success" role="alert">
                        Vehicle Updated Successfully.
                    </div>';
            }
        ?>
        <div class="form-outline mb-2">
            <input type="text" id="model" value= "<?php echo $model;?>" name="model" class="form-control" />
            <label class="form-label" for="model">Model</label>
        </div>
        <div class="form-outline mb-2">
            <input type="number" id="seats" value= "<?php echo $seat;?>" name="seats" class="form-control" />
            <label class="form-label" for="seats">Seating Capacity</label>
        </div>
        <div class="form-outline mb-2">
            <input type="number" id="rent" value= "<?php echo $rent;?>" name="rent"  class="form-control" />
            <label class="form-label" for="rent">Rent Per Day</label>
        </div>
        <div class="form-outline mb-2">
            <input type="text" id="image"  value= "<?php echo $image;?>" name="image" class="form-control" />
            <label class="form-label" for="image">Image url</label>
        </div>
        <div class="text-center">
            <button type="submit" name="submit" value="submit" class="btn btn-primary  btn-block mb-4 m-auto">Update Vehicle</button>
        </div>
    </form>
</div>
<?php
    require("../partials/footer.php");
?>