<?php
  if( isset($_GET["ID"])) {
    $ID = $_GET["ID"];

    $db_server = "localhost:3307";
      $db_user = "root";
      $db_pass = "";
      $db_name = "mymangalib";
      
      $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

      $sql = "DELETE FROM mangalib" . 
              "WHERE ID = $ID";
      $conn->query($sql);

  }
  header("location: /myMangaLib/index.php");
  exit;
?>