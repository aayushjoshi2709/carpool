<?php
    require("../partials/header.php");
    require("../conn.php");
    if(!isset($_SESSION["userid"]) || 
    !isset($_SESSION["usertype"]) ||
    $_SESSION["usertype"] !="agency"){
        header("Location: ../rentalAgency/login.php");
        die(); 
    }
?> 
  <h1 class="display-2 mt-4  text-center">Booked Vehicles</h1>
  <div class="container-sm bg-white shadow mx-auto mb-5 mt-2 overflow-auto">
  <table class="table w-100 table-striped">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Vehicle Number</th>
          <th scope="col">Vehicle Model</th>
          <th scope="col">Rent Per Day</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Rentel Price</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Address</th>
          <th scope="col">Phone No.</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $dateNow = date("Y-m-d");
        $result = $conn->query("SELECT registeredvehicles.vehicleNumber, registeredvehicles.vehicleModel, registeredvehicles.rentPerDay, bookedvehicles.startDate, bookedvehicles.endDate, bookedvehicles.rentalPrice, firstName, lastName, address,phoneNo from userdetails, registeredvehicles, bookedvehicles where registeredvehicles.vehicleNumber = bookedvehicles.vehicleNumber and bookedvehicles.agencyId = ".$_SESSION["userid"]." and userdetails.userId = bookedvehicles.userId and bookedvehicles.endDate >= '".$dateNow."';");
        if ($result->num_rows > 0) {
          $count = 1;
          while($row = $result->fetch_array(MYSQLI_NUM)){
            echo '<tr>
            <th scope="row">'.$count.'</th>
            <td>'.$row["0"].'</td>
            <td>'.$row["1"].'</td>
            <td>'.$row["2"].'</td>
            <td>'.$row["3"].'</td>
            <td>'.$row["4"].'</td>
            <td>'.$row["5"].'</td>
            <td>'.$row["6"]." ".$row["7"].'</td>
            <td>'.$row["8"].'</td>
            <td>'.$row["9"].'</td>
          </tr>';
          $count++;
          }
        }else{
            echo '<td colspan="10"><p class="alert alert-danger m-0" role="alert">
            No vehicles are currently booked.
        </p></td>';
        }
      ?>
      </tbody>
    </table>
      </div>
    </div>
  <div>
<?php
    require("../partials/footer.php");
?>
    