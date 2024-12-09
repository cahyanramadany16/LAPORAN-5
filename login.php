<?php
session_start();

// Konfigurasi database
$host = "127.0.0.1"; // atau "localhost"
$user = "root"; // Username default di Laragon
$password = ""; // Password default di Laragon (kosong)
$dbname = "db_dani";

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']); // Mengecek apakah Remember Me dicentang

    // Query untuk memeriksa username dan password
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika login berhasil
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Set cookie jika Remember Me dicentang
        if ($remember) {
            setcookie("username", $username, time() + 3600, "/");
        } else {
            setcookie("username", "", time() - 3600, "/"); // Hapus cookie jika tidak dicentang
        }

        header("Location: dashboard.php"); // Arahkan ke dashboard
        exit;
    } else {
        // Jika login gagal
        $error = "Username atau password salah.";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styleLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .checkbox-container input[type="checkbox"] {
            margin-right: 10px;
        }
        .checkbox-container label {
            font-size: 14px;
            font-weight: 400;
            color: #333;
        }
        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 4px;
        }
        .login-button:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-image: url('resource/hotel.jpg'); background-size: cover; background-position: center;">
    <header>
        <h1>Welcome to Four Points by Sheraton Makassar</h1>
    </header>
    <main>
        <div class="login-container">
            <h2>Welcome Back</h2>
            <p>Please login to access your account</p>
            <!-- Tampilkan pesan error jika ada -->
            <?php if (!empty($error)): ?>
                <p class="error-message"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="<?= htmlspecialchars($_COOKIE['username'] ?? '') ?>" 
                        required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="checkbox-container">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        name="remember" 
                        <?= isset($_COOKIE['username']) ? 'checked' : '' ?>>
                    <label for="remember">Remember Me</label>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form> 
        </div>
    </main>
    <div class="footer">
        <p>&copy; 2023 Four Points by Sheraton Makassar</p>
    </div>
</body>
</html>
