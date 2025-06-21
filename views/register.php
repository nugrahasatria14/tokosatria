<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>Register User</title>
  <style>
    * { margin:0; padding:0; box-sizing:border-box; font-family:Poppins, sans-serif; }
    body {
      display:flex; align-items:center; justify-content:center;
      min-height:100vh;
      background: linear-gradient(135deg,#667eea,#764ba2);
      padding:1rem;
    }
    form.container {
      width:100%; max-width:380px;
      background: rgba(255,255,255,0.2);
      backdrop-filter: blur(10px);
      border-radius:12px;
      padding:2rem;
      box-shadow:0 8px 24px rgba(0,0,0,0.2);
    }
    h1 {
      color:#fff; text-align:center; margin-bottom:1.5rem;
    }
    .form-group {
      margin-bottom:1rem;
    }
    .form-group label {
      display:block;
      margin-bottom:0.3rem;
      color:#fff;
      font-size:0.95rem;
    }
    .form-group input {
      width:100%;
      padding:0.6rem;
      border:none;
      border-radius:6px;
      font-size:1rem;
    }
    .form-group input:focus {
      outline:2px solid #667eea;
    }
    button {
      width:100%;
      margin-top:1rem;
      padding:0.75rem;
      border:none;
      border-radius:6px;
      background:#38a169;
      color:#fff;
      font-size:1rem;
      cursor:pointer;
      transition:background 0.3s;
    }
    button:hover {
      background:#2f855a;
    }
  </style>
</head>
<body>
  <form action="../controllers/register.php" method="POST" class="container">
    <h1>Register User</h1>
    <div class="form-group">
      <label for="username">Username</label>
      <input id="username" name="username" type="text" required placeholder="Masukkan username" />
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" name="email" type="email" required placeholder="name@domain.com" />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" name="password" type="password" required placeholder="••••••••" />
    </div>
    <div class="form-group">
      <label for="level">Level</label>
      <input id="level" name="level" type="text" required placeholder="User atau Admin" />
    </div>
    <button type="submit">Buat Akun</button>
  </form>
</body>
</html>
