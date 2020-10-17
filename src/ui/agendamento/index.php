<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="icon" type="image/ico" href="./../../assets/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./../../plugins/bootstrap/bootstrap.min.css" />
</head>
<style>
    html,
body {
    height: 100%;
}

.container {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
<body>
    <div class="container">
            <div class="card box-shadow">
                <div class="card-body d-flex flex-wrap justify-content-center">
                    <div class="rounded-lg m-2">
                        <div class="card-body">
                            <button class="btn btn-lg btn-success mt-1 rounded-pill" onclick="location.href = 'agendar/view.php'" type="button">Agendar</button>
                        </div>
                    </div>
                    <div class="rounded-lg m-2">
                        <div class="card-body">
                            <button class="btn btn-lg btn-success mt-1 rounded-pill" onclick="location.href = 'visualizar/view.php'" type="button">Visualizar Agendamentos</button>
                        </div>

                    </div>
                </div>
            </div>
    </div>
    </div>
    <script type='text/javascript' src="./../../plugins/jquery/jquery-3.5.1.min.js"></script>
    <script type='text/javascript' src="./../../plugins/bootstrap/bootstrap.min.js"></script>
</body>

</html>