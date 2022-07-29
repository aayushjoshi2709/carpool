<?php
    $status = 0;
    require("./partials/header.php");
    require("./conn.php");
    function validate($str, $conn){
      $str = stripcslashes($str);   
      $str = mysqli_real_escape_string($conn, $str);  
      return $str;
    }
    if(isset($_POST["submit"])){
      if(!isset($_SESSION["userid"])){
        header("Location: ./user/login.php");
        die(); 
      }
      if(isset($_SESSION["userid"]) && $_SESSION["usertype"] != "user"){
        $status = 2;
      }else{
        $vehicle_no = validate($_POST["vehicleno"], $conn);
        $user_id = validate($_SESSION["userid"], $conn);
        $start_date = $_POST["sdate"];
        $days = validate($_POST["days"], $conn);
        $end_date = date('Y-m-d', strtotime($start_date. ' + '.$days. 'days'));
        $stmt = $conn->prepare("SELECT rentPerDay, registeredBy from registeredvehicles where vehicleNumber = ?;");
        $stmt->bind_param("i", $vehicle_no);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
          $row = $result->fetch_array(MYSQLI_NUM);
          $rate =  $row[0];
          $agency_id = $row[1];
          $stmt = $conn->prepare("INSERT into bookedvehicles values(NULL, ?, ?, ?, ?, ?, ?);");
          $rentalPrice = ($rate * $days);
          $stmt->bind_param("iiissd", $vehicle_no, $user_id, $agency_id, $start_date, $end_date, $rentalPrice);
          if($stmt-> execute()){
              $status = 1;
          }
        }
      }
    }
?>
    <div class="container  mx-auto my-5">
      <?php
        if($status == 1){
                echo '<div class="alert alert-success" role="alert">
                    Vehicle booked successfully.
                </div>';
        }else if($status == 2){
            echo '<div class="alert alert-warning" role="alert">
            Please login as a user to book the vehicle.
        </div>';
        }
      ?>
      <div class="row my-auto d-flex justify-content-center">
      <?php
        $dateNow = date("Y-m-d");
        $result = $conn->query("SELECT * from registeredvehicles where vehicleNumber not in (SELECT vehicleNumber from bookedvehicles where endDate >='".$dateNow."');");
        if ($result->num_rows > 0) {
          while($row = $result->fetch_array(MYSQLI_NUM)){
            $str = '
            <div class="col-auto mb-3">
              <div class="card shadow p-1" style="width: 18rem" >
                <img src="'.$row[4].'" class="card-img-top" alt="..." style="height:200px"/>
                <div class="card-body">
                  <h5 class="card-title text-uppercase">'.$row[1].'</h5>
                  <p class="card-text">
                    <p class="m-0"><b>Seating Capacity: </b>'.$row[2].'</p>
                    <p> <b>Rent Per Day: </b>'.$row[3].'</p>
                  </p>
                  <form method="post" action="#">
                    <input type="hidden" value="'.$row[0].'"  name="vehicleno"/>       
                    <div class="row">
                    <div class="col">
                        <div class="form-outline mb-2">
                            <input type="date" required id="sdate" name="sdate" class="form-control" />
                            <label class="form-label" for="sdate" required>Start Date</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline mb-2">
                            <input type="number" required id="days" name="days" class="form-control" />
                            <label class="form-label" for="days" required>Days</label>
                        </div>
                    </div>
                    <div class="text-center">
                    <button name="submit" value="true" type="submit" class="btn btn-primary  btn-block m-auto">Book Now</button>
                    ';
                    if(isset($_SESSION["usertype"]) && isset($_SESSION["userid"]) && $_SESSION["usertype"] == "agency" && $_SESSION["userid"] == $row[5]){
                      $str = $str.'<a href="./vehicle/updateVehicle.php?vehicleNo='.$row[0].'" class="btn btn-warning  btn-block m-auto"><i class="fas fa-edit"></i></a>';
                    }
                    $str = $str.'</div>
                  </form>
                </div> 
              </div>
            </div>
          </div>';
          echo $str;
          ;
          }
        }else{
            echo "No vehicles are currently available";
        }
      ?>
      </div>
    </div>
<?php
    require("./partials/footer.php");
?>
    