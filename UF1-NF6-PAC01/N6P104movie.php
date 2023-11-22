<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

// Check if 'action' and 'id' are set in $_GET, otherwise set them to empty strings
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($action == 'edit') {
    // Retrieve the record's information 
    $query = 'SELECT
            movie_name, movie_type, movie_year, movie_leadactor, movie_director,
            movie_release, movie_rating
        FROM
            movie
        WHERE
            movie_id = ' . $id;
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    // Set values to blank
    $movie_name = '';
    $movie_type = 0;
    $movie_year = date('Y');
    $movie_leadactor = 0;
    $movie_director = 0;
    $movie_release = time();
    $movie_rating = 5;
}
?>

<html>
<head>
    <title><?php echo ucfirst($action); ?> Movie</title>
    <style type="text/css">
        <!--
        #error { background-color: #600; border: 1px solid #FF0; color: #FFF;
        text-align: center; margin: 10px; padding: 10px; }
        -->
    </style>
</head>
<body>

<?php
if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>

<form action="commit.php?action=<?php echo $action; ?>&type=movie" method="post">
    <table>
        <tr>
            <td>Movie Name</td>
            <td><input type="text" name="movie_name" value="<?php echo $movie_name; ?>"/></td>
        </tr>
        <tr>
            <td>Movie Type</td>
            <td>
                <select name="movie_type">
                    <?php
                    // select the movie type information
                    $query = 'SELECT movietype_id, movietype_label FROM movietype ORDER BY movietype_label';
                    $result = mysqli_query($db, $query) or die(mysqli_error($db));

                    // populate the select options with the results
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['movietype_id'] . '"';
                        echo $row['movietype_id'] == $movie_type ? ' selected="selected">' : '>';
                        echo $row['movietype_label'] . '</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>
        <!-- Continue with the rest of your form -->
        <!-- ... -->
    </table>
    <?php
    if ($action == 'edit') {
        echo '<input type="hidden" value="' . $id . '" name="movie_id" />';
    }
    ?>
    <input type="submit" name="submit" value="<?php echo ucfirst($action); ?>" />
</form>

</body>
</html>


