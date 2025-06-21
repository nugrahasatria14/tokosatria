<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Tokopedia</title>
  <style>
    * {
      margin: 0; padding: 0;
      box-sizing: border-box;
      font-family: sans-serif;
    }
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #667eea, #764ba2);
      padding: 1rem;
    }
    .container {
      width: 100%;
      max-width: 360px;
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.2);
      text-align: center;
    }
    h1 {
      color: #fff;
      margin-bottom: 1.5rem;
    }
    .form-group {
      margin-bottom: 1.25rem;
      text-align: left;
    }
    .form-group label {
      display: block;
      margin-bottom: 0.25rem;
      color: #fff;
      font-size: 0.9rem;
    }
    .form-group input {
      width: 100%;
      padding: 0.6rem;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
    }
    .form-group input:focus {
      outline: 2px solid #667eea;
    }
    button {
      width: 100%;
      padding: 0.75rem;
      border: none;
      border-radius: 6px;
      background: #38a169;
      color: white;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background: #2f855a;
    }
    .link {
      margin-top: 0.75rem;
      font-size: 0.9rem;
    }
    .link a {
      color: #fff;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <form action="../controllers/login.php" method="POST" class="container">
    <h1>Tokopedia</h1>
    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" name="email" type="email" placeholder="name@domain.com" required />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" name="password" type="password" placeholder="••••••••" required />
    </div>
    <button type="submit">Login</button>
    <div class="link">
      Belum punya akun? <a href="register.php">Register</a>
    </div>
  </form>
</body>
</html>
