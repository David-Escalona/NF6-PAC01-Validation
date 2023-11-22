<?php
echo "<h1>Comentarios sobre el Documento y la Explicación del Profesor</h1>";

// Lista de los 10 conceptos más importantes aprendidos en este documento
$conceptos = array(
    "1. Conexión a la base de datos con MySQLi.",
    "2. Uso de consultas SQL para interactuar con la base de datos.",
    "3. Creación y manejo de formularios en HTML y PHP.",
    "4. Evitar inyecciones SQL mediante el uso de consultas preparadas.",
    "5. Manejo de sesiones y cookies para la autenticación de usuarios.",
    "6. Estilos CSS para mejorar la presentación de las páginas web.",
    "7. Uso de operadores ternarios para simplificar el código.",
    "8. Implementación de funciones de validación de datos.",
    "9. Control de errores y manejo de excepciones en PHP.",
    "10. Buenas prácticas de seguridad al desarrollar aplicaciones web."
);

// Calificación del documento y la explicación del profesor
$calificacionDocumento = 8;
$calificacionExplicacionProfesor = 9;

// Autoevaluación del estudiante
$autoevaluacionEstudiante = 7;

// Mejora sugerida
$mejora = "Podría profundizar más en el manejo de formularios y en la implementación de medidas de seguridad.";

// Mostrar resultados
echo "<h2>Conceptos más importantes:</h2>";
echo "<ul>";
foreach ($conceptos as $concepto) {
    echo "<li>$concepto</li>";
}
echo "</ul>";

echo "<h2>Calificación del Documento:</h2>";
echo "<p>Calificación: $calificacionDocumento</p>";

echo "<h2>Calificación de la Explicación del Profesor:</h2>";
echo "<p>Calificación: $calificacionExplicacionProfesor</p>";

echo "<h2>Autoevaluación del Estudiante:</h2>";
echo "<p>Autoevaluación: $autoevaluacionEstudiante</p>";

echo "<h2>Mejora Sugerida:</h2>";
echo "<p>$mejora</p>";

?>