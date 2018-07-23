<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php echo $_GET['ref']. ' '. strtoupper($_GET['translation']); ?> - Heb12 Bible Web</title>
    <link href="css/style.css" rel='stylesheet' />
</head>
<body>
    <header>
        <img src="favicon.ico" />
        <span id="title"><a href="/">Heb12 Bible</a></span>
        <form id="input" action="bible.php">
            <input type="text" name="ref" placeholder="Hebrews 4" />
            <select name="translation" id="translation">
                <option value="asv" <?php if ($_GET['translation'] == 'asv') {echo "selected";} ?>>ASV</option>
                <option value="kjv" <?php if ($_GET['translation'] == 'kjv') {echo "selected";} ?>>KJV</option>
                <option value="net">NET</option>
            </select>
            <input type="submit" value="Search" />
        </form>
    </header>
    <div id="wrapper">
        <h1><?php echo $_GET['ref']. ' '. strtoupper($_GET['translation']); ?></h1>
        <div id='scripture'>
            <?php
                if (gettype($_GET['ref']) == 'string') {
                    if ($_GET['translation'] == 'net') {
                        header("Access-Control-Allow-Origin: *");
                        try {
                            $ref = join("+" ,explode(" ", $_GET['ref']));
                            $url = 'http://labs.bible.org/api/?formatting=full&passage='. $ref;
                            // Set up cURL
                            $ch = curl_init();
                            // Set the URL
                            curl_setopt($ch, CURLOPT_URL, $url);
                            // don't verify SSL certificate
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // Return the contents of the response as a string
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            // Follow redirects
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            // Do the request
                            $response = curl_exec($ch);
                            curl_close($ch);
                            echo $response;
                        } catch(Exception $e) {
                            echo 'Internal server error.';
                        }
                    } else {
                        try {
                            $ref = join("+" ,explode(" ", $_GET['ref']));
                            $url = 'http://heb12.us-3.evennode.com/?ref='. $ref;
                            // Set up cURL
                            $ch = curl_init();
                            // Set the URL
                            curl_setopt($ch, CURLOPT_URL, $url);
                            // don't verify SSL certificate
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                            // Return the contents of the response as a string
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                            // Follow redirects
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                            // Do the request
                            $response = curl_exec($ch);
                            curl_close($ch);
                            echo $response;
                        } catch(Exception $e) {
                            echo 'Internal server error.';
                        }
                    }
                } else {
                    echo "Enter a Bible reference to be displayed here...";
                }
            ?>
        </div>
    </div>
</body>
</html>
