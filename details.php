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

if (isset($_COOKIE["visited"])){
    //exlode cookie into array 
    $valuesVisited = explode(",", $_COOKIE["visited"]);

    //check to see if number is in array 
        //if not then add then else nothing 
    if (array_search($key, $valuesVisited) == false){
        array_push($valuesVisited,$_GET["company"]);
    }
 
    //implode array 
    $valuesVisitedString = implode(",",$valuesVisited);

    //encode array 
    setrawcookie("visited", urlencode($valuesVisitedString)); 
}

else{    
    //set cookie 
    setrawcookie("visited", $_GET["company"]);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Companies</title>
</head>
<body> 
<h1>Company Details</h1>
<?php

    if(isset($_GET["company"]))
    {
        if(isset($companies[$_GET["company"]]))
        {
            //render the company info
            echo "<h2>" . $companies[$_GET["company"]][0] . "</h2>";
            echo "<p>Company Phone: " . $companies[$_GET["company"]][1] . "</p>";
        }
        else
        {
            //Default text
             echo "The company was not found.";
        }
    }
    else
    {
        //Default text
        echo "The company was not found.";
    }

?>

<a href="/">Back to list</a>

    </body>
</html>