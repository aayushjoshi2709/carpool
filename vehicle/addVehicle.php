<?php
    require("../partials/header.php");
?>
<div class="container border p-3 px-4 my-5 shadow bg-white rounded" style="width: 30rem">
    <form>
        <h1 class="display-2 text-center m-4">Add Vehicle</h1>
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
            <input type="number" id="rent" name="image" class="form-control" />
            <label class="form-label" for="image">Image url</label>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-primary  btn-block mb-4 m-auto">Add Vehicle</button>
        </div>
    </form>
</div>
<?php
    require("../partials/footer.php");
?>