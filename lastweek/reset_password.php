

<?php
// Create connection
$conn = new mysqli("localhost", "root", "chander", "customers");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // if (empty($token) || empty($new_password)) {
    //     die("Invalid request.");
    // }

    // Check if token exists and is valid
    $stmt = $conn->prepare("SELECT id FROM customer_info WHERE reset_token = ? AND token_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();


    if ($stmt->num_rows > 0) {
        echo "hi";
        // Fetch user ID correctly
        $stmt->bind_result($userId);
        $stmt->fetch();
       
        // Hash the new password
        $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);

        // Update password and clear reset token
        $updateStmt = $conn->prepare("UPDATE customer_info SET password = ?, reset_token = NULL, token_expiry = NULL WHERE id = ?");
        $updateStmt->bind_param("si", $hashedPassword, $userId); // Use $userId, not $stmt

        if ($updateStmt->execute()) {
            echo "Password updated successfully! <a href='index.html'>Login Here</a>";
        } else {
            echo "Error updating password.";
        }

        $updateStmt->close();
    } else {
        echo "Invalid or expired token!";
    }

    $stmt->close();
    $conn->close();
}
?>
