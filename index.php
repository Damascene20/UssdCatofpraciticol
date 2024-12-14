<?php
session_start(); // Start session once at the beginning

// Database connection
function connectDatabase() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "rp_student_registration";
    $conn = new mysqli($host, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Main menu
function mainMenu() {
    return "CON Welcome to Rwanda Polytechnic Student Registration\n" .
           "1. TUMBA COLLEGE\n2. MUSANZE COLLEGE\n3. HUYE COLLEGE\n" .
           "4. KIGALI COLLEGE\n5. NGOMA COLLEGE\n" .
           "n. Next Menu\n99. Exit";
}

// Next menu
function nextMenu() {
    return "CON Additional Options:\n" .
           "6. GISHALI COLLEGE\n7. KITABI COLLEGE\n8. KARONGI COLLEGE\n" .
           "9. Make Payment\n98. Back\n99. Exit";
}

// Handle registration
function handleRegistration($conn, $input) {
    $level = count($input);
    $response = "";

    switch ($level) {
        case 2: // College selection
            $_SESSION['college'] = $input[0]; // Store selected college
            $response = "CON Choose Department:\n" .
                        "1. ICT Engineering\n2. Mechanical Engineering\n" .
                        "3. Civil Engineering\n4. Veterinary Technology\n" .
                        "5. Crop Production\n98. Back";
            $_SESSION['previousOption'] = "departmentSelection";
            break;
        case 3: // Department selection
            $_SESSION['department'] = $input[1]; // Store selected department
            $response = "CON Create Account Enter Full Names:";
            break;
        case 4:
            $_SESSION['full_name'] = $input[2]; // Store full name
            $response = "CON Enter ID Card Number:";
            break;
        case 5:
            $_SESSION['id_card'] = $input[3]; // Store ID card number
            $response = "CON Enter Phone Number:";
            break;
        case 6:
            $_SESSION['phone'] = $input[4]; // Store phone number
            $response = "CON Enter Validation Email:";
            break;
        case 7:
            $_SESSION['email'] = $input[5]; // Store email address
            $response = "CON Enter Current Password:";
            break;
        case 8:
            $_SESSION['password'] = $input[6]; // Store password
            $response = "CON Confirm Password:";
            break;
        case 9:
            $password = $_SESSION['password'];
            if ($input[7] !== $password) {
                $response = "END Passwords do not match. Try again.";
            } else {
                // Generate Registration Number
                $year = date("Y");
                $random_number = rand(10, 99); // Random 2-digit number
                $_SESSION['reg_number'] = "RP" . $year . $random_number;

                // Save registration details to the database
                $stmt = $conn->prepare("INSERT INTO students (college, department, full_name, id_card, phone, email, password, reg_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $stmt->bind_param("ssssssss", $_SESSION['college'], $_SESSION['department'], $_SESSION['full_name'], $_SESSION['id_card'], $_SESSION['phone'], $_SESSION['email'], $hashedPassword, $_SESSION['reg_number']);

                if ($stmt->execute()) {
                    $response = "END Registration successful! Your Registration Number is " . $_SESSION['reg_number'];
                } else {
                    $response = "END Registration failed. Please try again.";
                }
                $stmt->close();
            }
            break;
    }

    return $response;
}

// Handle the payment process
function handlePayment($conn, $input) {
    $level = count($input);
    $response = "";

    switch ($level) {
        case 2: // Enter registration number
            $_SESSION['reg_number'] = $input[1]; // Store registration number
            $response = "CON Enter Reg Rumber:";
            break;
        case 3: // Enter registration number
            $_SESSION['reg_number'] = $input[1]; // Store registration number
            $response = "CON Enter Amount:";
            break;

        case 4: // Enter amount
            $_SESSION['amount'] = $input[2]; // Store amount
            $response = "CON Enter PIN:";
            break;

        case 5: // Enter PIN
            $_SESSION['pin'] = $input[3]; // Store PIN
            $response = "CON Confirm PIN:";
            break;

        case 6: // Confirm PIN
            if ($_SESSION['pin'] !== $input[4]) {
                $response = "END PINs do not match. Try again.";
            } else {
                // Hash the PIN before binding to the statement
$hashedPin = password_hash($_SESSION['pin'], PASSWORD_BCRYPT);

// Save payment details to the database
$stmt = $conn->prepare("INSERT INTO payments (amount, reg_number, pin) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $_SESSION['amount'], $_SESSION['reg_number'], $hashedPin);

if ($stmt->execute()) {
    $response = "END Payment successful!";
} else {
    $response = "END Payment failed. Try again. Error: " . $stmt->error;
}
$stmt->close();
            }
            break;
    }

    return $response;
}

// Main logic
$conn = connectDatabase();
$sessionId = $_POST["sessionId"] ?? null;
$serviceCode = $_POST["serviceCode"] ?? null;
$phoneNumber = $_POST["phoneNumber"] ?? null;
$text = $_POST["text"] ?? "";
$input = explode("*", $text);
$level = count($input);
$response = "";

if ($text == "") {
    $response = mainMenu();
    $_SESSION['previousOption'] = "mainMenu";
} elseif (strtolower($input[0]) == "n") {
    $response = nextMenu();
    $_SESSION['previousOption'] = "nextMenu";
} elseif ($input[0] == "99") {
    $response = "END Thank you for using Rwanda Polytechnic USSD.";
} elseif ($input[0] == "98") {
    // Back functionality
    if ($_SESSION['previousOption'] == "nextMenu") {
        $response = mainMenu();
        $_SESSION['previousOption'] = "mainMenu";
    } elseif ($_SESSION['previousOption'] == "departmentSelection") {
        $response = mainMenu();
        $_SESSION['previousOption'] = "mainMenu";
    } else {
        $response = "END Invalid option.";
    }
} elseif (in_array($input[0], range(1, 5))) {
    $response = handleRegistration($conn, $input);
} elseif ($input[0] == "9") {
    // Payment handling
    $response = handlePayment($conn, $input);
} else {
    $response = "END Invalid option. Try again.";
}

$conn->close();
header('Content-Type: text/plain');
echo $response;
?>
