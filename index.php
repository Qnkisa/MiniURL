<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniURL | URL Shortener</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    
    <header>
        <nav>
            <div class="nav-logo">
                <p>MiniURL</p>
                <img src="images/website-logo.png" alt="">
            </div>
        </nav>
    </header>

    <div class="main-div">
        <h1>Provide the URL to be shortened</h1>
        <form action="includes/shortenlink.inc.php" method="post">
            <input type="text" name="link" placeholder="Enter the link here...">
            <button type="submit" name="submit">Shorten URL</button>
        </form>
        <?php
            if(isset($_GET["error"])){
                echo '<div class="errors">';
                if($_GET["error"] == "emptyurl"){
                    echo "<p>Please provide a URL!</p>";
                }else if($_GET["error"] == "invalidurl"){
                    echo "<p>Please provide a valid URL!</p>";
                }else if($_GET["error"] == "none"){
                    echo "<p id='green-url'>Your url has been shortened!</p>";
                }
                echo "</div>";
            }
        ?>
        <div class="main-div-results">
            <?php
                include_once 'includes/dbh.inc.php';
                $query = "SELECT * FROM url_map";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $longUrl = $row["long_url"];
                    $shortUrl = $row["short_url"];
                    $urlId = $row["urlId"];
                    echo '<div class="result">';
                    echo '<div class="main-div-result">';
                    echo '<p>Long link: <a href="' . $longUrl .  '" target="_blank">' . $longUrl . '</a> </p>';
                    echo '<form action="includes/redirect.inc.php" method="post">';
                    echo '<p class="short-link-p">Short Link(Click Only): </p>';
                    echo '<input type="hidden" name="shorturlredirect" value="' . $shortUrl .  '">';
                    echo '<button type="submit" name="redirectuser" class="short-link-button">' . $shortUrl .  '</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '<div class="result-remove">';
                    echo '<form action="includes/removelink.inc.php" method="post">';
                    echo '<input type="hidden" name="shortlinkremove" value="' . $shortUrl .  '">';
                    echo '<button type="submit" name="removelink" class="remove-link">Remove Link</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            ?>
            
        </div>
    </div>

    <div class="desc-div">
        <h2>Key Benefits of Our URL Shortening Service</h2>
        <p>MiniURL provides a solution for shortening lengthy links from popular websites such as Instagram, Facebook, YouTube, Twitter, and LinkedIn, simply by pasting the long link and clicking the "Shorten URL" button. Once shortened, the new URL can be easily copied and shared through various mediums like websites, chat, and email.</p>
    </div>

    <div class="brag-div">
        <div class="brag">
            <ion-icon name="happy-outline" class="brag-icon"></ion-icon>
            <p>Easy to use</p>
            <span>Streamline your URL shortening process with our intuitive and user-friendly platform.</span>
        </div>
        <div class="brag">
            <ion-icon name="shield-half-outline" class="brag-icon"></ion-icon>
            <p>Secure</p>
            <span>Ensure the safety of your links with our secure and reliable URL shortening service.</span>
        </div>
        <div class="brag">
            <ion-icon name="phone-portrait-outline" class="brag-icon"></ion-icon>
            <p>Cross-platform</p>
            <span>Access your shortened links from anywhere and on any device with our cross-platform compatibility.</span>
        </div>
    </div>

    <footer>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>