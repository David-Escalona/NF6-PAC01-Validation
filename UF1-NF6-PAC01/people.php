<?php
$db = mysqli_connect('localhost', 'root', 'root') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));
?>

<html>

<head>
    <title>Movie database</title>
    <style type="text/css">
        th { background-color: #999; }
        .odd_row { background-color: #EEE; }
        .even_row { background-color: #FFF; }
    </style>
</head>

<body>
    <table style="width:100%;">
        <tr>
            <th colspan="2">People <a href="people.php?action=add"> [ADD]</a></th>
        </tr>
        <?php
        $query = 'SELECT * FROM people';
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        $odd = true;
        while ($row = mysqli_fetch_assoc($result)) {
            echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
            $odd = !$odd;
            echo '<td style="width: 25%;">';
            echo $row['people_fullname'];
            echo '</td><td>';
            echo ' <a href="people.php?action=edit&id=' . $row['people_id'] . '"> [EDIT]</a>';
            echo ' <a href="delete.php?type=people&id=' . $row['people_id'] . '"> [DELETE]</a>';
            echo '</td></tr>';
        }
        ?>
    </table>

    <!-- Agregado el formulario -->
    <form action="process_form.php" method="post">
        <table>
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="people_fullname" value="<?php echo isset($people_fullname) ? $people_fullname : ''; ?>" /></td>
            </tr>
            <tr>
                <td>Is Director:</td>
                <td>
                    <select name="people_isdirector">
                        <option value="1" <?php echo (isset($people_isdirector) && $people_isdirector == 1) ? 'selected="selected"' : ''; ?>>Yes</option>
                        <option value="0" <?php echo (isset($people_isdirector) && $people_isdirector == 0) ? 'selected="selected"' : ''; ?>>No</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <?php
                    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                        echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
                    }
                    ?>
                    <input type="submit" name="submit" value="<?php echo isset($_GET['action']) ? ucfirst($_GET['action']) : ''; ?>" />
                </td>
            </tr>
        </table>
    </form>
</body>

</html>