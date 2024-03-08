<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>MangaLib</title>
</head>
<body>
  <div class="container my-5">
    <h2>MyMangaLib</h2>
    <a class="btn btn-primary" href="/myMangaLib/create.php" role="button">New Manga Bookmark</a>
    <br>
    <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>CHAPTER</th>
        <th>TTTLE</th>
        <th>AUTHOR</th>
        <th>GENREs</th>
        <th>DATE-TIME</th>
        <th>RATING</th>
        <th>EDIT/DELETE</th>
      </tr>
    </thead>  
    <tbody>
    <?php
      $db_server = "localhost:3307";
      $db_user = "root";
      $db_pass = "";
      $db_name = "mymangalib";
      
      $conn = new mysqli($db_server, $db_user, $db_pass, $db_name);

      if($conn->connect_error){
        die("Connection Error: " . $conn->connect_error);
      }
      
      $sql = "SELECT * FROM mangalib";
      $result = $conn->query($sql);

      if(!$result){
        die("Invalid query: " . $conn->error); 
      }

      while($row = $result->fetch_assoc()){
        echo"
        <tr>
          <td>$row[ID]</td>
          <td>$row[chapterNo]</td>
          <td>$row[mangaName]</td>
          <td>$row[mangaAuthor]</td>
          <td>$row[Genres]</td>
          <td>$row[DATETIME]</td>
          <td>$row[RATING]</td>
          <td>
            <a class='btn btn-primary btn-sm' href='/myMangaLib/edit.php?ID=$row[ID]'>Edit</a>  
            <a class='btn btn-danger btn-sm' href='/myMangaLib/delete.php>ID=$row[ID]'>Delete</a>
          </td>
        </tr>
        ";
      }
    ?>
      
    <tbody>
    </table>
  </div>
</body>
</html>