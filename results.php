<!DOCTYPE html>
<html>
  <head>
   <title>Book-O-Rama Search Results</title>
  </head>
  <body>
    <h1>Book-O-Rama Search Results</h1>
<?php
// create short variable names
    $searchtype=$_POST['searchtype'];
    $searchterm=trim($_POST['searchterm']);
    if (!$searchtype || !$searchterm)
    {
      echo 'You have not entered search details.';
      exit;
    }

    switch($searchtype){
    case 'Title':
    case 'Author':
    case 'ISBN':
    	 break;
	default:
	echo '<p> That is not a valid search type.</p>';
	exit;
}
 $dbconn = pg_connect("host=localhost dbname=Book-O-Rama user=postgres password=123456");

$query = "SELECT \"ISBN\", \"Author\", \"Title\", \"Price\" FROM \"public\".\"Books\" WHERE \"$searchtype\"='$searchterm'";

$stmt = pg_query($query);
if(!$stmt){
echo "An error occured \n";
exit; 
}

$num_of_rows = pg_num_rows($stmt);
echo "<p>Number of results: $num_of_rows.</p>\n";
while($row = pg_fetch_row($stmt)){
echo "<p><strong>Title: \"$row[2]\"</strong>";
  echo "<br />Author: ". $row[1];
 echo "<br />ISBN: ".$row[0];
 echo "<br />Price: \$".number_format($row[3],2)."</p>";
echo "<br/>\n";
}


pg_close($db);
    ?>
    </body>
</html>
