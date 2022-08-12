<?php
$callListResouce = fopen("callList.csv", "r");
$companies = array();

if(!is_resource($callListResouce))
{
    echo "Could not open the file";
    exit();
}

while($line = fgets($callListResouce))
{
    $companies[] = explode(",", $line);
}

fclose($callListResouce);

//check to see if cookie exists
if (isset($_COOKIE["visited"])){ 
    // yes: explode array cookie
    $valuesVisited = explode(",", $_COOKIE["visited"]);
}
else{
    //no: set empty array 
    $valuesVisited = array();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Companies</title>
</head>
<body> 
<h1>Company Listing</h1>
<ul>
<?php

    foreach($companies as $key => $value)
    {
        //check to see if company is in the cookie if so indcate visited
            if(array_search($key, $valuesVisited) !== false )
            {
                echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "-- VISITED </a></li>";
            }
            else{
                echo "<li><a href='details.php?company=" . urlencode($key) . "'>" . $value[0] . "</a></li>";
            }
    }
?>
</ul>

    </body>
</html>