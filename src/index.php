<?php
$arquivoInicial = true;
include_once __DIR__ . '/sessao.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feegow Challenge</title>
    <link rel="icon" type="image/ico" href="./assets/favicon.png" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap/bootstrap.min.css" />
</head>

<body>

    <div class="container mt-5">
        <h1>Feegow Challenge</h1>
        <p>A tarefa foi construida em duas soluções, um sendo apenas JQuery e outra em Vue.JS</p>

        <button type="button" onclick="location.href = 'ui/agendamento/'" class="btn btn-primary btn-lg m-2">Solução em JQuery</button>
        <button type="button" onclick="location.href = 'ui/agendamento-vue/'" class="btn btn-secondary btn-lg m-2">Solução em Vue.JS</button>
    </div>


    <script type='text/javascript' src="plugins/jquery/jquery-3.5.1.min.js"></script>
    <script type='text/javascript' src="plugins/bootstrap/bootstrap.min.js"></script>
</body>

</html>