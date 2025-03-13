<?php

include 'database_config.php'; // Your database connection

// Fetch items to be supplied
$queryToBeSupplied = "SELECT * FROM items_to_be_supplied";
$resultToBeSupplied = $conn->query($queryToBeSupplied);

// Fetch items already supplied
$querySupplied = "SELECT * FROM item_supplied";
$resultSupplied = $conn->query($querySupplied);

// Fetch distinct item names, models, quantities, and purchase dates for dropdowns
$queryItems = "SELECT item_name, item_model, quantity, items_purchased_date FROM items_to_be_supplied";
$resultItems = $conn->query($queryItems);

// Fetch users for "Supply To" dropdown
$queryUsers = "SELECT name FROM users";
$resultUsers = $conn->query($queryUsers);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Supply Orders</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
  <body>
    <?php include "sidebar.php"; ?>

    <div class="content" style="margin-left: 250px; padding: 20px;overflow-y: auto;  background-color: #f8f9fa;">
      <h2 class="mb-4">Supply Orders</h2>
      
      <!-- display message after stock supply s -->
      <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Supply Order Created Successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if (isset($_GET['error'])): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      <?php endif; ?>





      <!-- Bootstrap Tabs -->
      <ul class="nav nav-tabs mt-3" id="supplyOrdersTab" role="tablist">
        <li class="nav-item">
          <button class="nav-link active" id="stock-summary-tab" data-bs-toggle="tab" data-bs-target="#stock-summary" type="button" role="tab">
              Stock Summary
          </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="create-supply-order-tab" data-bs-toggle="tab" data-bs-target="#create-supply-order" type="button" role="tab">
                Create Supply Order
            </button>
        </li>
      </ul>

      <div class="tab-content mt-3">
        <!-- Stock Summary Tab -->
        <div class="tab-pane fade show active" id="stock-summary" role="tabpanel">
          <h4>Items to be Supplied</h4>
          <div class="table-responsive" style="max-height: 400px; overflow-y: scroll;">
            <table class="table table-bordered table-striped">
              <thead class="table-dark">
                <tr>
                  <th>Item Name</th>
                  <th>Model</th>
                  <th>Quantity</th>
                  <th>Purchased Date</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $resultToBeSupplied->fetch_assoc()): ?>
                <tr>
                  <td><?php echo $row['item_name']; ?></td>
                  <td><?php echo $row['item_model']; ?></td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><?php echo date("d M Y", strtotime($row['items_purchased_date'])); ?></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          
          <h4>Items Supplied</h4>
          <div class="table-responsive" style="max-height: 400px; overflow-y: scroll;">
            <table class="table table-bordered">
              <thead class="table-dark">
                <tr>
                <th>Item Name</th>
                <th>Model</th>
                <th>Quantity</th>
                
                <th>Supplied Date</th>
                <th>Supplied To</th>
                <th>Received Person</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $resultSupplied->fetch_assoc()): ?>
                <tr>
                <td><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['item_model']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo date("d M Y", strtotime($row['supplied_date'])); ?></td>
                <td><?php echo $row['supplied_to']; ?></td>
                <td><?php echo $row['received_person_name']; ?></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Create Supply Order Tab -->
        <div class="tab-pane fade" id="create-supply-order" role="tabpanel">
          <h4>Create Supply Order</h4>
          <form id="supplyOrderForm" action="process_supply_order.php" method="POST" class="p-4 border shadow">
            <div class="mb-3">
              <label for="item_name" class="form-label">Select Item</label>
              <select id="item_name" class="form-select" name="item_name" required>
                <option value="">Select Item</option>
                <?php while ($item = $resultItems->fetch_assoc()): ?>
                <option value="<?php echo $item['item_name']; ?>"><?php echo $item['item_name']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="mb-3">
              <label for="item_model" class="form-label">Select Model</label>
              <select id="item_model" name="item_model" class="form-select" required>
                <option value="">Select Model</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="quantity" class="form-label">Quantity <span id="available_quantity" class="text-danger"></span></label>
              <input type="number" id="quantity" name="quantity" class="form-control" required min="1">
            </div>
                
            

            <div class="mb-3">
              <label for="supply_date" class="form-label">Supply Date</label>
              <input type="date" id="supply_date" name="supply_date" class="form-control" required>
            </div>

            <div class="mb-3">
              <label>Supply To</label>
              <select class="form-select" name="supplied_to" required>
                <option value="">Select Person</option>
                <?php while ($user = $resultUsers->fetch_assoc()): ?>
                <option value="<?php echo $user['name']; ?>"><?php echo $user['name']; ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="received_person" class="form-label">Received Person Name</label>
              <input type="text" id="received_person" name="received_person" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
            
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        $("#item_name").change(function () {
            let itemName = $(this).val();
            if (itemName) {
                $.ajax({
                    url: "get_item_details.php",
                    type: "GET",
                    data: { item_name: itemName },
                    success: function (response) {
                        let data = JSON.parse(response);

                        // Update item model dropdown
                        $("#item_model").html('<option value="">-- Select Model --</option>');
                        data.models.forEach(model => {
                            $("#item_model").append('<option value="' + model + '">' + model + '</option>');
                        });

                        

                        // Update available quantity display
                        let availableQuantity = data.available_quantity || 0;
                        $("#available_quantity").text("(Available: " + availableQuantity + ")");
                        $("#quantity").attr("max", availableQuantity);
                         // Update purchased date dropdown
                    $("#purchased_date").html('<option value="">-- Select Purchased Date --</option>');
                    data.purchased_dates.forEach(date => {
                        $("#purchased_date").append('<option value="' + date + '">' + date + '</option>');
                    });
                    }
                });
            } else {
                $("#item_model").html('<option value="">-- Select Model --</option>');
                $("#available_quantity").text("");
                $("#quantity").attr("max", "");
                $("#purchased_date").html('<option value="">-- Select Purchased Date --</option>');

            }
        });
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
