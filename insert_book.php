<!DOCTYPE html>
  <html>
    <head>
      <title>Book-O-Rama Book Entry Results</title>
    </head>
  <body>
    <h1>Book-O-Rama Book Entry Results</h1>

<?php
 if (!isset($_POST['ISBN']) || !isset($_POST['Author'])|| !isset($_POST['Title']) || !isset($_POST['Price'])) {
 echo "<p>You have not entered all the required details.<br/> Please go back and try again.</p>";
 exit;
}

// create short variable names
$isbn=$_POST['ISBN'];
$author=$_POST['Author'];
$title=$_POST['Title'];
$price=$_POST['Price'];
$price = doubleval($price);
$dbconn = pg_connect("host=localhost dbname=Book-O-Rama user=postgres password=123456");
 if (!$dbconn) {
echo "<p>Error: Could not connect to database.<br/>
Please try again later.</p>";
exit;
}
$query = "INSERT INTO \"public\".\"Books\" VALUES ('$isbn', '$author', '$title', '$price')";

$stmt = pg_query($query);
if(!$stmt){
echo "An error occured and the item was NOT added. \n";
exit; 
}
else{
	echo "<p>Book was succesfully inserted into the database</p>\n";
}


pg_close($db);
?>
</body>
</html> 
