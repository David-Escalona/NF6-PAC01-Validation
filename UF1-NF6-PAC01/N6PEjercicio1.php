<?php
$db = mysqli_connect('localhost', 'root', 'root') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

// Inicializar variables para evitar errores de "undefined"
$people_fullname = '';
$people_isdirector = '';

// Validación y procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar la entrada del formulario
    $people_fullname = isset($_POST['people_fullname']) ? trim($_POST['people_fullname']) : '';
    $people_isdirector = isset($_POST['people_isdirector']) ? (int)$_POST['people_isdirector'] : 0;

    // Validaciones
    $errors = array();

    // Validar que el nombre no esté vacío
    if (empty($people_fullname)) {
        $errors[] = 'Please enter a full name.';
    }

    // Procesar si no hay errores
    if (empty($errors)) {
        // Si es una acción de edición, actualizar el registro existente
        if (isset($_POST['people_id'])) {
            $people_id = (int)$_POST['people_id'];
            $query = "UPDATE people SET people_fullname = '$people_fullname', people_isdirector = $people_isdirector WHERE people_id = $people_id";
        } else {
            // Si es una acción de agregar, insertar un nuevo registro
            $query = "INSERT INTO people (people_fullname, people_isdirector) VALUES ('$people_fullname', $people_isdirector)";
        }

        // Ejecutar la consulta
        $result = mysqli_query($db, $query) or die(mysqli_error($db));

        // Redirigir después de procesar el formulario
        header('Location: people.php');
        exit();
    }
}

// Obtener datos para la edición si es una acción de edición
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $people_id = (int)$_GET['id'];
    $query = "SELECT * FROM people WHERE people_id = $people_id";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    // Si se encuentra el registro, cargar datos para la edición
    if ($row = mysqli_fetch_assoc($result)) {
        $people_fullname = $row['people_fullname'];
        $people_isdirector = $row['people_isdirector'];
    }
}
?>

<html>

<head>
    <title>People database</title>
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
    <form action="N6PEjercicio1.php" method="post">
        <table>
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="people_fullname" value="<?php echo htmlspecialchars($people_fullname); ?>" /></td>
            </tr>
            <tr>
                <td>Is Director:</td>
                <td>
                    <select name="people_isdirector">
                        <option value="1" <?php echo ($people_isdirector == 1) ? 'selected="selected"' : ''; ?>>Yes</option>
                        <option value="0" <?php echo ($people_isdirector == 0) ? 'selected="selected"' : ''; ?>>No</option>
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
                    <input type="submit" name="submit" value="<?php echo isset($_GET['action']) ? ucfirst($_GET['action']) : 'Add'; ?>" />
                </td>
            </tr>
        </table>

        <?php
        // Mostrar errores de validación
        if (!empty($errors)) {
            echo '<div style="color: red; margin-top: 10px;">';
            echo implode('<br>', $errors);
            echo '</div>';
        }
        ?>
    </form>
</body>

</html>

