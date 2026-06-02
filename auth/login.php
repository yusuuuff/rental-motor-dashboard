<?php

session_start();
require '../config/koneksi.php';

if(isset($_POST['email'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare(
        "SELECT * FROM users WHERE email=?"
    );

    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nama'] = $user['nama'];

        header("Location: ../dashboard/index.php");
        exit;

    }else{
        // Login gagal, biarkan flow berlanjut ke form dengan pesan error
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Rental Motor Dashboard</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: url('https://images.unsplash.com/photo-1558981403-c5f91cbba527?q=80&w=2070&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin: 0;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(8px);
            z-index: 1;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem;
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 2;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-icon {
            width: 70px;height: 70px;
            background: var(--primary);
            color: white;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        h2 { color: white; font-weight: 800; letter-spacing: -0.5px; }
        p { color: rgba(255, 255, 255, 0.5); }

        .form-label { color: rgba(255, 255, 255, 0.8); font-weight: 600; font-size: 0.8rem; }

        .input-group {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }

        .input-group:focus-within {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .input-group-text {
            background: transparent !important;
            border: none !important;
            color: rgba(255, 255, 255, 0.5);
            padding-left: 1.2rem;
        }

        .form-control {
            background: transparent !important;
            border: none !important;
            color: white !important;
            padding: 0.8rem 1.2rem 0.8rem 0.5rem !important;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .btn-login {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 700;
            margin-top: 1rem;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.4);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            border-radius: 12px;
            padding: 0.8rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center">
        <div class="login-icon">
            <i class="bi bi-bicycle"></i>
        </div>
        <h2>LOG IN</h2>
        <p class="mb-4 text-uppercase fw-bold small">Rental Motor Management</p>
    </div>

    <?php if(isset($_POST['email'])): ?>
        <div class="alert-error">
            <i class="bi bi-x-circle me-1"></i> Email atau password salah!
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label text-uppercase">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="name@company.com" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label text-uppercase">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
        </div>

        <button type="submit" class="btn-login w-100">
            Sign In <i class="bi bi-arrow-right ms-2"></i>
        </button>
    </form>

    <div class="mt-5 text-center">
        <p class="small mb-0">&copy; 2024 Premium Rental Space</p>
    </div>
</div>

</body>
</html>