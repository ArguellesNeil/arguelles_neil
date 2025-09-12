<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Student</title>

  <style>
    :root {
      --primary: #6B5B9A;
      --primary-hover: #5A4C7A;
      --bg: #f4f5f7;
      --text: #333;
      --muted: #B0B3B8;
      --radius: 12px;
      font-family: 'Roboto', sans-serif;
    }

    body {
      margin: 0;
      background: var(--bg);
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      color: var(--text);
    }

    .container {
      width: 100%;
      max-width: 480px;
      padding: 35px;
      background: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(107,91,154,0.15));
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 40px rgba(0,0,0,0.1);
      border-radius: var(--radius);
      animation: fadeIn 0.6s ease;
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
    }

    .header h2 {
      margin: 0;
      font-size: 2rem;
      font-weight: 700;
      color: var(--primary);
      position: relative;
    }

    .header h2::after {
      content: '';
      display: block;
      height: 3px;
      width: 60%;
      background: var(--primary);
      margin: 8px auto 0;
      border-radius: 3px;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 25px;
    }

    .form-group {
      position: relative;
    }

    input {
      width: 100%;
      padding: 14px 14px 14px 14px;
      border-radius: var(--radius);
      border: 1px solid #ccc;
      font-size: 1rem;
      background: #fff;
      transition: all 0.3s;
    }

    input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 6px rgba(107, 91, 154, 0.4);
    }

    label {
      position: absolute;
      top: 50%;
      left: 14px;
      transform: translateY(-50%);
      font-size: 1rem;
      color: var(--muted);
      pointer-events: none;
      transition: all 0.2s ease;
    }

    input:focus + label,
    input:not(:placeholder-shown) + label {
      top: -8px;
      left: 12px;
      background: #fff;
      padding: 0 6px;
      font-size: 0.8rem;
      color: var(--primary);
    }

    button {
      background: linear-gradient(135deg, var(--primary), var(--primary-hover));
      color: #fff;
      padding: 14px;
      border: none;
      border-radius: var(--radius);
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 20px rgba(107, 91, 154, 0.4);
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 25px rgba(90, 76, 122, 0.5);
    }

    .back-link {
      display: block;
      margin-top: 20px;
      font-size: 0.95rem;
      text-decoration: none;
      text-align: center;
      color: var(--muted);
      transition: color 0.3s;
    }

    .back-link:hover {
      color: var(--primary);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h2>ADD STUDENT</h2>
    </div>

    <form method="POST">
      <div class="form-group">
        <input type="text" name="fname" placeholder=" " required>
        <label>First Name</label>
      </div>
      <div class="form-group">
        <input type="text" name="lname" placeholder=" " required>
        <label>Last Name</label>
      </div>
      <div class="form-group">
        <input type="email" name="email" placeholder=" " required>
        <label>Email</label>
      </div>
      <button type="submit">SAVE RECORD</button>
    </form>

    <a class="back-link" href="<?= base_url() ?>students">← BACK TO LIST</a>
  </div>

</body>
</html>
