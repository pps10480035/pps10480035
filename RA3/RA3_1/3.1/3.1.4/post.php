<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Datos recibidos: " . htmlspecialchars($_POST['dato']);
}
?>
<form method="post">
  <input type="text" name="dato">
  <input type="submit">
</form>
