<?php

$db_server = "localhost:3307";
      $db_user = "root";
      $db_pass = "";
      $db_name = "mymangalib";
      
      $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

$ID = "";
$chapterNo = "";
$mangaName = "";
$mangaAuthor = "";
$Genres = "";
$RATING = "";

$errorMsg = "";
$succcessMsg = ""; 

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
  // get method to show data of the Client

  if( !isset($_GET["ID"])) {
    header("location: /myMangaLib/index.php");
    exit;
  }

  $ID = $_GET["ID"];

  //read the row selected
  $sql = "SELECT * FROM mangalib WHERE ID = $ID";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if (!$row) {
    header("location: /myMangaLib/index.php");
    exit;
  }
  
  $chapterNo = $row["chapterNo"];
  $mangaName = $row["mangaName"];
  $mangaAuthor = $row["mangaAuthor"];
  $Genres = $row["Genres"];
  $RATING = $row["RATING"];
}
else {
  // POST method: Update the data
  $ID = $_POST["ID"];
  $chapterNo = $_POST["chapterNo"];
  $mangaName = $_POST["mangaName"];
  $mangaAuthor = $_POST["mangaAuthor"];
  $Genres = $_POST["Genres"];
  $RATING = $_POST["RATING"];

  do {
    if ( empty($ID) || empty($chapterNo) || empty($mangaName) || empty($mangaAuthor) || empty($Genres) || empty($RATING) )
    {
      $errorMsg = "All fields are required to be filled";
      break;
    }

    $sql =  "UPDATE mangalib " .
            "SET chapterNo = '$chapterNo', mangaName = '$mangaName', mangaAuthor = '$mangaAuthor', Genres = '$Genres', RATING = '$RATING' " . 
            "WHERE ID = $ID";

    $result = $conn->query($sql);
    if(!$result){
      $errorMsg = "Invalid" . $conn->error;
      break;
    }

    $succcessMsg = "Bookmark Successfully updated";
    
    header("location: /myMangaLib/index.php");
    exit;

  } while(false);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Document</title>
</head>
<body>
  <div class="container my-5">
  <h2>New Manga Bookmark</h2>
  <form method="post">
  <?php
    if( !empty($errorMsg)){
      echo "
      <div class='row mb-3'>
        <div class='offset-sm-3 col-sm-3'>
          <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMsg</strong>
            <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
        </div>
      </div>
      ";
    }
    ?>
    
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">ID</label>
        <div class="col-sm-6">
        <input type="hidden" name="ID" value="<?php echo $ID; ?>">
        <?php echo $ID; ?>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Chapter</label>
        <div class="col-sm-6">
          <input type="number" class="form-control" name="chapterNo" value="<?php echo $chapterNo; ?>">
        </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Title</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="mangaName" value="<?php echo $mangaName; ?>">
        </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Author</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="mangaAuthor" value="<?php echo $mangaAuthor; ?>">
        </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">GENRES</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="Genres" value="<?php echo $Genres; ?>">
        </div>
    </div>
    <div class="row mb-3">
      <label class="col-sm-3 col-form-label">RATING</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="RATING" value="<?php echo $RATING; ?>">
        </div>
    </div>
    <?php
    if( !empty($successMsg)){
    echo "
    <div class='row mb-3'>
      <div class='offset-sm-3 col-sm-3'>
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>$successMsg</strong>
          <button type='button' class='close' data-bs-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
      </div>
    </div>
    ";
    }
    ?>
    <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid">
          <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
        <div class="col-sm-3 d-grid">
          <a class="btn btn-danger" href="/myMangaLib/index.php" role="button">Go back home</a>
        </div>
        >
    </div>

    
    
  </form>

  </div>
</body>
</html>