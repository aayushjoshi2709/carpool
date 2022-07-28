<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <title>CarPool</title>
    <style>
      body{
        margin: 0px;
        padding: 0px;
        background-color: #F8BBD0;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success p-2">
      <a class="navbar-brand" href="#">CarPool</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="/carpool/"
              >Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/carpool/vehicle/bookedVehicles.php">Booked Vehicle</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/carpool/vehicle/addVehicle.php">Add Vehicle</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="navbarDropdownMenuLink"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Login / Signup
            </a>
            <div class="dropdown-menu mt-2 " aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="/carpool/user/login.php">Login User</a>
              <a class="dropdown-item" href="/carpool/rentalAgency/login.php">Login Agency</a>
              <hr class="m-0">
              <a class="dropdown-item" href="/carpool/user/signup.php">Signup User</a>
              <a class="dropdown-item" href="/carpool/rentalAgency/signup.php">Signup Agency</a>
              <hr class="m-0">
              <a class="dropdown-item" href="/carpool/logout.php">Logout</a>
              
            </div>
          </li>
        </ul>
      </div>
    </nav>