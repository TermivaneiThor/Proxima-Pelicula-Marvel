<?php 
    const API_URL = 'https://whenisthenextmcufilm.com/api';

    $ch = curl_init(API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($result, true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data["title"]); ?> - Próximo estreno del MCU</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css">
    <style>
        :root {
            color-scheme: light dark;
        }

        body {
            display: grid;
            place-content: center;
            min-height: 100vh;
            background-color: #0d1117;
            color: #fff;
            text-align: center;
            padding: 2rem;
        }

        img {
            border-radius: 20px;
            max-width: 300px;
            margin-bottom: 2rem;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        h2 {
            font-size: 1.2rem;
            font-weight: normal;
            color: #aaa;
            margin-top: 0;
        }

        .days-left {
            font-size: 1.5rem;
            margin-top: 0.5rem;
            font-weight: bold;
        }

        .next-movie {
            margin-top: 1.5rem;
            font-size: 1rem;
            color: #ccc;
        }
    </style>
</head>
<body>
    <main>
        <img src="<?= htmlspecialchars($data["poster_url"]); ?>" 
             alt="Póster de <?= htmlspecialchars($data["title"]); ?>">
        
        <h1><?= htmlspecialchars($data["title"]); ?> se estrena en</h1>
        <p class="days-left"><?= htmlspecialchars($data["days_until"]); ?> días</p>
        <h2>Fecha de estreno: <?= htmlspecialchars($data["release_date"]); ?></h2>

        <p class="next-movie">
            La siguiente es: <?= htmlspecialchars($data["following_production"]["title"] ?? "Desconocida"); ?>
        </p>
    </main>
</body>
</html>
