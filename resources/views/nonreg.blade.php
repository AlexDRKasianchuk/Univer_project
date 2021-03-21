@auth
<?php
    header('Location: /home');
    exit;
    
?>
@endauth
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Main page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        body {
            background: rgb(0, 0, 0);
            background: linear-gradient(90deg, rgba(0, 0, 0, 1) 0%, rgba(139, 43, 48, 1) 100%);
        }

        #mainrow {
            height: 100vh;
        }

        h1 {
            
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        .reg {
            background-color: #262626;
            color: white;
            padding: 2%;
            text-align: center;
            
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            border-radius: 40px;
            -webkit-box-shadow: 0px 0px 30px -5px rgba(255, 255, 255, 1);
            -moz-box-shadow: 0px 0px 30px -5px rgba(255, 255, 255, 1);
            box-shadow: 0px 0px 30px -5px rgba(255, 255, 255, 1);
        }

        .col {
            height: auto;
            margin: 1%;
        }

        .btn {
            font-size: 150%;
            margin: 10px;
            border-radius:12px;
        }

        .pln {
            padding: 1%;
        }

        img {
            display: block;
            max-width: 20%;
            height: auto;
            margin-left: 40%;

        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row align-items-center" id="mainrow">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="col align-self-center">
                            <p class="display-4 text-light text-uppercase text-start align-middle">Генератор
                                рівнозначних варіантів задач для статистичного аналізу даних</p>
                        </div>
                        <div class="col reg">
                            <div class="pln">
                                <h5 class="fs-2 text-wrap">Для користування сервісом необхідно авторизуватися</h5>
                                <div class="btn">
                                    <a href="/login"><button type="button"
                                            class="btn btn-secondary">Увійти</button></a>
                                    <a href="/register"><button type="button"
                                            class="btn btn-secondary">Реєстрація</button></a>
                                </div>
                            </div>
                            <div>
                                <img src="img/gerb.png" alt="gerb VNU">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
