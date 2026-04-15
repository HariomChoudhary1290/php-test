<!DOCTYPE html>
<html>
<body>
<h2 style="color: green;">🚀 Jenkins Auto Trigger SUCCESS TEST</h2>

<p>Current Time: <?php echo date("Y-m-d H:i:s"); ?></p>

<div style="background-color: #f2f2f2; padding: 10px; margin-top: 10px;">
    <h3>🔥 CI/CD Working Check</h3>
    <ul>
        <li>GitHub Push ✅</li>
        <li>Webhook Trigger ✅</li>
        <li>Jenkins Build Running ✅</li>
    </ul>
</div>
<hr>
<p>Build Time: <?php echo date("Y-m-d H:i:s"); ?></p>
<h4>Auto Trigger Test 🔥</h4>
<form action="submit.php" method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    <button type="submit">Submit</button>
</form>
</body>
</html>