<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'add':
            if (isset($_GET['type'])) {
                switch ($_GET['type']) {
                    case 'movie':
                        $error = array();
                        // ... (rest of your code for adding a movie)
                        break;
                }
            }
            break;

        case 'edit':
            if (isset($_GET['type'])) {
                switch ($_GET['type']) {
                    case 'movie':
                        $error = array();
                        // ... (rest of your code for editing a movie)
                        break;
                }
            }
            break;
    }
}

if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
<html>
<head>
    <title>Commit</title>
</head>
<body>
    <p>Done!</p>
</body>
</html>

