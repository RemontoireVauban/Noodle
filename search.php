<?php
include("config.php");
include("classes/SiteResultsProvider.php");

    if(isset($_GET["term"])) {
        $term = $_GET["term"];
    }
    else {
        exit("Please enter a search request");
    }


    $type = isset($_GET["type"]) ? $_GET["type"] : "sites";
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;

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

    <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
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
                    <input type="hidden" name="type" value="<?php echo $type; ?>">
                    <input class="searchBox" type="text" name="term" placeholder="Feeling Hungry?" value="<?php echo $term?>">
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

    <div class="mainResultsSection">

        <?php
        $resultsProvider = new SiteResultsProvider($con);
        $pageSize = 20;

        $numResults = $resultsProvider->getNumResults($term);

        echo "<p class='resultsCount'> $numResults results found</p>";

        echo $resultsProvider->getResultsHtml($page, $pageSize, $term);
    ?>
    </div>

    <div class="pageinationContainer">
        
                <?php
                $pagesToShow = 7;
                $numPages = ceil($numResults / $pageSize);
                $pagesLeft = min($pagesToShow, $numPages);

                $currentPage  = $page - floor($pagesToShow / 2);

                if($currentPage < 1) {
                    $currentPage =1;
                }

                if($currentPage + $pagesLeft > $numPages + 1) {
                    $currentPage = $numPages - $pagesLeft;
                }

                while($pagesLeft != 0 && $currentPage <= $numPages) {
                    if($currentPage == $page) {
                    echo "<div class='pageNumberContainer'>
                        <img src='assets/img/logo/egg-solid.svg'>
                        <span class='pageNumber'>$currentPage</span>
                        </div>";
                    }
                    else {
                    echo "<div class='pageNumberContainer'>

                        <a href='search.php?term=$term&type=$type&page=$currentPage'>

                        <img src='assets/img/logo/egg-solid.svg'>
                        <span class='pageNumber'>$currentPage</span>
                        </a>
                        </div>";   
                    }
                        $currentPage++;
                        $pagesLeft--;
                }
                ?>
    </div>

    <!-- <div>Icons made by <a href="https://www.flaticon.com/authors/vectors-market" title="Vectors Market">Vectors Market</a> from <a href="https://www.flaticon.com/"                 title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"                 title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->
    </div>
    <script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>