agrega en este codigo todo el siguiente codigo
<?php
require 'conection.php';
$db = conectionBD();

$errores = [];

var_dump($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Quita el punto y coma al final de esta línea
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es válido"; // Corrige el mensaje de error
    }
    if (!$password) {
        $errores[] = "El Password es obligatorio"; // Corrige el mensaje de error
    }

    if (empty($errores)) {

        // Revisar si el usuario existe
        $query = "SELECT * FROM `usuarios` WHERE correo_electronico = '$email';";
        $resultado = mysqli_query($db, $query);

        if ($resultado) { // Verifica si la consulta se ejecutó correctamente
            if ($resultado->num_rows) {
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_array($resultado);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if ($auth) {
                    // El usuario está autenticado
                    session_start();
                    $_SESSION['usuario'] = $usuario['correo_electronico'];
                    $_SESSION['login'] = true;
                    echo "<pre>";
                    var_dump($_SESSION);
                    echo "</pre>";
                } else {
                    $errores[] = "El password es incorrecto";
                }
            } else {
                $errores[] = "El usuario no existe";
            }
        } else {
            $errores[] = "Error en la consulta: " . mysqli_error($db); // Manejo de errores en la consulta
        }
    }
}
?>

<main class="container seccion">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" novalidate>
        <fieldset>
            <legend>email y password</legend>

            <label for="email">Tu email</label>
            <input type="email" name="email" placeholder="Tu email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu password" id="password">
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>
