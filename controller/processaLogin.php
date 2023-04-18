<?php session_start();
if (isset($_POST['name'])) {
  $Log = $_POST['name'];
  $sen = $_POST['password'];
  $Log = htmlspecialchars($Log);
  $sen = htmlspecialchars($sen);
  $Log = $Log;
  $sen = md5($sen);
  include_once("../model/db_connection.php"); 
  $sql = "SELECT * FROM uses WHERE user = '$Log' AND sen = '$sen'";
  $sql2 = $conn->query($sql) or die($conn->error);
  $dado = $sql2->fetch_array();
  if ($dado['id_registro'] > 0) {
    $_SESSION['llusuario'] = $dado;
    if ($dado['tipo'] == "po") {
      $expira = time() + (60 * 60 * 12);
      $cookie = $dado['user'];
      setcookie('login', $cookie, $expira);
    } else {
      $expira = time() + (60 * 60 * 24 * 30);
      $cookie = $dado['user'];
      setcookie('login', $cookie, $expira);
    }
    if ($dado['tipo'] == "op") {
?>
      <script type="text/javascript">
        window.location.href = "../pages/welcome.php";
      </script>
    <?php
    } else {
    ?>
      <script type="text/javascript">
        window.location.href = "../pages/login.php";
      </script>
    <?php
    }
  } else {
    ?>
    <script type="text/javascript">
      alert("Não Cadastrado.");
      window.location.href = "../index.php";
    </script>
<?php
  }
}
?>
