<?php

    if(isset($_GET["term"])) {
        $term = $_GET["term"];
    }
    else {
        exit("Please enter a search request");
    }


    if(isset($_GET["type"])) {
        $type = $_GET["type"];
    }
    else {
        $type = "recipes";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Noodle</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="wrapper">

    <div class="header">
        <div class="headerContent">
        <div class="logoContainer">
         <a href="index.php"><img src="assets/img/logo/noodlepng.png" alt="Noodle Logo"></a>   
        </div>
        <div class="searchContainer">
            <form action="search.php" method="GET">
                <div class="searchBarContainer">
                    <input class="searchBox" type="text" name="term" placeholder="Feeling Hungry?">
                    <button class="searchButton">
                    <i class="fa fa-search"></i> &nbsp; Search
                    </button>
                </div>
            </form>

        </div>
        </div>

        <div class="tabsContainer">
            <ul class="tabsList">
                <li class="<?php echo $type == 'recipes' ? 'active' : '' ?>"><a href='<?php echo "search.php?term=$term&type=recipes"; ?>'>Recipes</a></li>
                <li class="<?php echo $type == 'images' ? 'active' : '' ?>"><a href='<?php echo "search.php?term=$term&type=images"; ?>'>Images</a></li>
            </ul>
        </div>

    </div>

    </div>
</body>
</html>