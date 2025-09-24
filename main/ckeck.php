<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Update in Progress</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #0e1117;
      color: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden;
      flex-direction: column;
    }

    .spinner {
      border: 6px solid rgba(255, 255, 255, 0.2);
      border-top: 6px solid #00d1b2;
      border-radius: 50%;
      width: 70px;
      height: 70px;
      animation: spin 1s linear infinite;
      margin-bottom: 20px;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    .message {
      font-size: 1.5rem;
      animation: fadeIn 1.5s ease-in-out infinite alternate;
    }

    @keyframes fadeIn {
      from { opacity: 0.4; transform: translateY(-5px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .subtext {
      margin-top: 10px;
      font-size: 0.9rem;
      color: #ccc;
    }
  </style>
</head>
<body>

  <div class="spinner"></div>
  <div class="message">Update in Progress...</div>
  <div class="subtext">Please don't refresh or close this page.</div>

</body>
</html>
