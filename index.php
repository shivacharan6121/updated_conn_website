<?php
session_start();
require_once 'db_config.php';

// Set the current form based on the query parameter or session
$current_form = isset($_GET['form']) ? $_GET['form'] : (isset($_SESSION['current_form']) ? $_SESSION['current_form'] : 'add-part');

$show_confirmation = false; // Flag to control confirmation box
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['form_type'])) {
        $form_type = $_POST['form_type'];
        $current_form = $_POST['current_form'];

        // Store form data in session
        $_SESSION['form_type'] = $form_type;
        $_SESSION['current_form'] = $current_form;

        switch ($form_type) {
            case 'add_part':
                $part_no = $conn->real_escape_string($_POST['part_name']);
                $make = $conn->real_escape_string($_POST['make']);
                $quantity = (int)$_POST['conn_count'];

                // Check if part already exists
                $check_sql = "SELECT quantity FROM part WHERE Nomenclature = '$part_no' AND make = '$make'";
                $result = $conn->query($check_sql);

                if ($result->num_rows > 0) {
                    $_SESSION['alert'] = [
                        'type' => 'error',
                        'message' => "Entered part number <strong>$part_no</strong> from <strong>$make</strong> already exists!"
                    ];
                } else {
                    $_SESSION['Nomenclature'] = $part_no;
                    $_SESSION['make'] = $make;
                    $_SESSION['quantity'] = $quantity;
                    $message = "Are you sure you want to add the part number <strong>$part_no</strong> from <strong>$make</strong> with <strong>$quantity</strong> connectors?";
                    $show_confirmation = true;
                }
                break;

            case 'add_conn':
                $part_no = $conn->real_escape_string($_POST['conn_name']);
                $add_make = $conn->real_escape_string($_POST['add-make']);
                $add_quantity = (int)$_POST['pin_count'];

                // Check if part doesnot exist
                $check_sql = "SELECT quantity FROM part WHERE Nomenclature = '$part_no' AND make = '$add_make'";
                $result = $conn->query($check_sql);

                if ($result->num_rows == 0) {
                    $_SESSION['alert'] = [
                        'type' => 'warning',
                        'message' => "Part number <strong>$part_no</strong> from <strong>$add_make</strong> does not exist! Please add the part first."
                    ];
                } else {
                    $_SESSION['Nomenclature'] = $part_no;
                    $_SESSION['make'] = $add_make;
                    $_SESSION['quantity'] = $add_quantity;
                    $message = "Are you sure you want to add <strong>$add_quantity</strong> connectors to part number <strong>$part_no</strong> from <strong>$add_make</strong>?";
                    $show_confirmation = true;
                }
                break;

            case 'required_conn':
                $part_no = $conn->real_escape_string($_POST['part_name']);
                $req_make = $conn->real_escape_string($_POST['req-make']);
                $remove_quantity = (int)$_POST['req_conn'];

                // Check if part doesnot exist
                $check_sql = "SELECT quantity FROM part WHERE Nomenclature = '$part_no' AND make = '$req_make'";
                $result = $conn->query($check_sql);

                if ($result->num_rows == 0) {
                    $_SESSION['alert'] = [
                        'type' => 'warning',
                        'message' => "Part number <strong>$part_no</strong> from <strong>$req_make</strong> does not exist! Please add the part first."
                    ];
                }
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $current_quantity = $row['quantity'];
                    
                    if ($remove_quantity > $current_quantity) {
                        $_SESSION['alert'] = [
                            'type' => 'warning',
                            'message' => "Insufficient connectors of part number <strong>$part_no</strong> from <strong>$req_make</strong>!\n\nAvailable: <strong>$current_quantity</strong>\nRequired: <strong>$remove_quantity</strong>\nShortage: <strong>" . ($remove_quantity - $current_quantity)."</strong>"
                        ];
                    } else {
                        $_SESSION['Nomenclature'] = $part_no;
                        $_SESSION['make'] = $req_make;
                        $_SESSION['remove_quantity'] = $remove_quantity;
                        $message = "Are you sure you want to remove <strong>$remove_quantity</strong> connectors of part number <strong>$part_no</strong> from <strong>$req_make</strong>?";
                        $show_confirmation = true;
                    }
                }
                break;
        }
    }

    if (isset($_POST['confirm'])) {
        // Perform database operations after confirmation
        $form_type = $_SESSION['form_type'];
        $part_no = $_SESSION['Nomenclature'];
        $make = $_SESSION['make'];

        switch ($form_type) {
            case 'add_part':
                $quantity = $_SESSION['quantity'];
                $usedqty = 0;
                $availableqty = $quantity;
                $sql = "INSERT INTO part (Nomenclature, make, quantity, usedqty, availableqty) VALUES ('$part_no', '$make', $quantity, $usedqty, $availableqty)";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['alert'] = [
                        'type' => 'success',
                        'message' => "New part number <strong>$part_no</strong> added successfully from <strong>$make</strong> with <strong>$quantity</strong> connectors!"
                    ];
                } else {
                    $_SESSION['alert'] = [
                        'type' => 'error',
                        'message' => "Error adding part: " . $conn->error
                    ];
                }
                break;

            case 'add_conn':
                $add_quantity = $_SESSION['quantity'];
                $check_sql = "SELECT quantity, availableqty, usedqty FROM part WHERE Nomenclature = '$part_no' AND make = '$make'";
                $result = $conn->query($check_sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $current_quantity = $row['quantity'];
                    $current_availableqty = $row['availableqty'];
                    $new_quantity = $current_quantity + $add_quantity;
                    $availablequty = $current_availableqty + $add_quantity;
                    $usedqty = $row['usedqty'];
                    $sql = "UPDATE part SET quantity = $new_quantity, availableqty = $availablequty WHERE Nomenclature = '$part_no' AND make = '$make'";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['alert'] = [
                            'type' => 'success',
                            'message' => "Successfully added <strong>$add_quantity</strong> connectors to part number <strong>$part_no</strong> from <strong>$make</strong>\n\n    Total quantity: <strong>$new_quantity</strong> \n  Used quantity: <strong>$usedqty</strong> \n   Available quantity: <strong>$availablequty</strong>"
                        ];
                    } else {
                        $_SESSION['alert'] = [
                            'type' => 'error',
                            'message' => "Error adding connectors: " . $conn->error
                        ];
                    }
                } 
                break;
            

            case 'required_conn':
                $remove_quantity = $_SESSION['remove_quantity'];
                $check_sql = "SELECT quantity, availableqty, usedqty FROM part WHERE Nomenclature = '$part_no' AND make = '$make'";
                $result = $conn->query($check_sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $current_quantity = $row['quantity'];
                    $current_availableqty = $row['availableqty'];
                    $current_usedqty = $row['usedqty'];
                    $available_quantity = $current_availableqty - $remove_quantity;
                    $usedqty = $current_usedqty + $remove_quantity;
                    $total_quantity = $current_quantity;
                    $sql = "UPDATE part SET availableqty = $available_quantity, usedqty = $usedqty WHERE Nomenclature = '$part_no' AND make = '$make'";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['alert'] = [
                            'type' => 'success',
                            'message' => "Removed <strong>$remove_quantity</strong> connectors of part number <strong>$part_no</strong> from <strong>$make</strong>\n\nAvailable quantity: <strong>$available_quantity</strong>\nUsed quantity: <strong>$usedqty</strong>\nTotal quantity: <strong>$total_quantity</strong>"
                        ];
                    } else {
                        $_SESSION['alert'] = [
                            'type' => 'error',
                            'message' => "Error removing connectors: " . $conn->error
                        ];
                    }
                }
                break;
        }

        // Clear session data
        unset($_SESSION['form_type'], $_SESSION['Nomenclature'], $_SESSION['make'], $_SESSION['quantity'], $_SESSION['add_quantity'], $_SESSION['remove_quantity']);

        // Redirect to the current form
        header("Location: index.php?form=$current_form");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connector Management System</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
    <style>
        .confirmation-box {
            display: <?php echo $show_confirmation ? 'block' : 'none'; ?>;
            position: fixed;
            top: 50%;
            left: 50%;
            width: 800px;
            height: 150px;
            transform: translate(-50%, -50%);
            background-color: #1e283a;
            color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: 1000;
        }
        .overlay {
            display: <?php echo $show_confirmation ? 'block' : 'none'; ?>;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
    </style>

</head>
<body>
    <div class="header">
        <img src="aircraft.gif" alt="Logo" class="header-gif">&nbsp;
        <h1>Connector Management System</h1>
    </div>

    <div class="menu-bar">
        <a href="index.php">Home</a>
        <a href="download.php">Download</a>
        <a href="view.php">View</a>
        <a href="#">Logout</a>
    </div>

    <?php if (isset($_SESSION['alert'])): ?>
    <div class="alert alert-<?php echo $_SESSION['alert']['type']; ?>">
        <?php echo $_SESSION['alert']['message']; ?>
        <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span>
    </div>
    <?php unset($_SESSION['alert']); endif; ?>

    <div class="container">
        <div class="toggle-buttons">
            <button class="toggle-btn <?php echo $current_form == 'add-part' ? 'active' : ''; ?>" onclick="showForm('add-part')">Add Part</button>
            <button class="toggle-btn <?php echo $current_form == 'add-conn' ? 'active' : ''; ?>" onclick="showForm('add-conn')">Add Connectors</button>
            <button class="toggle-btn <?php echo $current_form == 'required-conn' ? 'active' : ''; ?>" onclick="showForm('required-conn')">Required Connectors</button>
        </div>

        <!-- Add Part Form -->
        <form id="add-part" class="form-section <?php echo $current_form == 'add-part' ? 'active' : ''; ?>" action="index.php" method="POST">
            <input type="hidden" name="form_type" value="add_part">
            <input type="hidden" name="current_form" value="add-part">
            <div class="form-group">
                <label for="part-name">Enter New Part No:</label>
                <input type="text" id="part-name" name="part_name" placeholder="Enter new part number" required>
            </div>
            <div class="form-group">
                <label for="make">Make:</label>
                <input type="text" id="make" name="make" placeholder="Enter make name" required>
            </div>
            <div class="form-group">
                <label for="part-conn">Enter No. of Conn:</label>
                <input type="number" id="part-conn" name="conn_count" placeholder="Enter number of connectors" required>
            </div>
            <button type="submit" class="submit-btn">Add Part</button>
        </form>

        <!-- Add Connectors Form -->
        <form id="add-conn" class="form-section <?php echo $current_form == 'add-conn' ? 'active' : ''; ?>" action="index.php" method="POST">
            <input type="hidden" name="form_type" value="add_conn">
            <input type="hidden" name="current_form" value="add-conn">
            <div class="form-group">
                <label for="conn-name">Enter Part No:</label>
                <input type="text" id="conn-name" name="conn_name" placeholder="Enter existing part number" required>
            </div>
            <div class="form-group">
                <label for="add-make">Make:</label>
                <input type="text" id="add-make" name="add-make" placeholder="Enter make name" required>
            </div>
            <div class="form-group">
                <label for="pin-count">Enter No. of Additional Conn:</label>
                <input type="number" id="pin-count" name="pin_count" placeholder="Enter number of additional connectors" required>
            </div>
            <button type="submit" class="submit-btn">Add Connectors</button>
        </form>

        <!-- Required Connectors Form -->
        <form id="required-conn" class="form-section <?php echo $current_form == 'required-conn' ? 'active' : ''; ?>" action="index.php" method="POST">
            <input type="hidden" name="form_type" value="required_conn">
            <input type="hidden" name="current_form" value="required-conn">
            <div class="form-group">
                <label for="req-part">Enter Part No:</label>
                <input type="text" id="req-part" name="part_name" placeholder="Enter existing part number" required>
            </div>
            <div class="form-group">
                <label for="req-make">Make:</label>
                <input type="text" id="req-make" name="req-make" placeholder="Enter make name" required>
            </div>
            <div class="form-group">
                <label for="req-conn">Enter No. of Required Conn:</label>
                <input type="number" id="req-conn" name="req_conn" placeholder="Enter number of required connectors" required>
            </div>
            <button type="submit" class="submit-btn">Required Connectors</button>
        </form>
    </div>

    <div class="overlay"></div>
    <div class="confirmation-box">
        <p><?php echo $message; ?></p>
        <img src="fulfillment (1).gif" alt="Logo" class="confirmation-box-gif"><br>
        <form action="index.php" method="POST">
            <button type="submit" name="confirm" class="confirm">Confirm</button>
            <button type="button" name="cancel" class="cancel" onclick="window.location.href='index.php?form=<?php echo $current_form; ?>'">Cancel</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>