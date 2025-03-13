<?php
include 'database_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $item_model = $_POST['item_model'];
    $quantity = (int) $_POST['quantity']; // Convert to integer for safety
    $supply_date = $_POST['supply_date'];
    $supply_to = $_POST['supplied_to'];
    $received_person = $_POST['received_person'];

    // Start transaction for data consistency
    $conn->begin_transaction();

    try {
        // Insert into `items_supplied` table
        $insertQuery = "INSERT INTO item_supplied (item_name, item_model, quantity, supplied_date, supplied_to, received_person_name) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssisss", $item_name, $item_model, $quantity, $supply_date, $supply_to, $received_person);
        $stmt->execute();

        // Check available quantity before reducing
        $checkQuery = "SELECT quantity FROM items_to_be_supplied WHERE item_name = ? AND item_model = ?";
        $stmtCheck = $conn->prepare($checkQuery);
        $stmtCheck->bind_param("ss", $item_name, $item_model);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($row = $resultCheck->fetch_assoc()) {
            $availableQuantity = $row['quantity'];

            if ($availableQuantity >= $quantity) {
                // Reduce quantity in `items_to_be_supplied`
                $updateQuery = "UPDATE items_to_be_supplied SET quantity = quantity - ? WHERE item_name = ? AND item_model = ?";
                $stmtUpdate = $conn->prepare($updateQuery);
                $stmtUpdate->bind_param("iss", $quantity, $item_name, $item_model);
                $stmtUpdate->execute();
            } else {
                throw new Exception("Not enough stock available.");
            }
        } else {
            throw new Exception("Item not found in items_to_be_supplied table.");
        }

        // Commit transaction if successful
        $conn->commit();
        // Redirect to `supply_orders.php` with success message
        header("Location: supply_orders.php?success=1");
        exit();

    } catch (Exception $e) {
       $conn->rollback(); // Rollback if any error occurs
        header("Location: supply_orders.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
