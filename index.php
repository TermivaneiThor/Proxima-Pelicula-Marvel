<?php 
    // Definimos la constante con la URL de la API pública del MCU
    const API_URL = 'https://whenisthenextmcufilm.com/api';

    // Inicializamos una sesión cURL
    $ch = curl_init(API_URL);

    // Indicamos que queremos recibir el resultado como string (no imprimirlo directamente)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ejecutamos la petición y guardamos la respuesta
    $result = curl_exec($ch);

    // Cerramos la sesión de cURL
    curl_close($ch);

    // Decodificamos el JSON en un arreglo asociativo
    $data = json_decode($result, true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data["title"]); ?> - Próximo estreno del MCU</title>

    <!-- PicoCSS para estilos rápidos y responsive -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">

    <style>
        /* Activar modo oscuro si el sistema lo prefiere */
        :root {
            color-scheme: light dark;
        }

        /* Centramos todo en la pantalla con Grid */
        body {
            display: grid;
            place-content: center;
            min-height: 100vh;
            background-color: #0d1117; /* fondo oscuro tipo GitHub */
            color: #fff;
            text-align: center;
            padding: 2rem;
        }

        /* Estilo para el póster */
        img {
            border-radius: 20px;
            max-width: 300px;
            margin-bottom: 2rem;
        }

        /* Título principal */
        h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        /* Subtítulo (fecha de estreno) */
        h2 {
            font-size: 1.2rem;
            font-weight: normal;
            color: #aaa;
            margin-top: 0;
        }

        /* Días hasta el estreno */
        .days-left {
            font-size: 1.5rem;
            margin-top: 0.5rem;
            font-weight: bold;
        }

        /* Información sobre la siguiente película */
        .next-movie {
            margin-top: 1.5rem;
            font-size: 1rem;
            color: #ccc;
        }
    </style>
</head>
<body>
    <main>
        <!-- Imagen del póster de la película -->
        <img src="<?= htmlspecialchars($data["poster_url"]); ?>" 
             alt="Póster de <?= htmlspecialchars($data["title"]); ?>">

        <!-- Título con días restantes -->
        <h1><?= htmlspecialchars($data["title"]); ?> se estrena en</h1>

        <!-- Cantidad de días que faltan -->
        <p class="days-left"><?= htmlspecialchars($data["days_until"]); ?> días</p>

        <!-- Fecha de estreno -->
        <h2>Fecha de estreno: <?= htmlspecialchars($data["release_date"]); ?></h2>

        <!-- Siguiente producción del MCU -->
        <p class="next-movie">
            La siguiente es: <?= htmlspecialchars($data["following_production"]["title"] ?? "Desconocida"); ?>
        </p>
    </main>
</body>
</html>
