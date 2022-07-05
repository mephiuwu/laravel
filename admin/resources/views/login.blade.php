<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aeurus</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<style>
    html {
        background: url('img/fondoLogin.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        overflow: hidden;
    }


    /* Login container */
    #container {
        position: absolute;
        top: 0;
        left: 0;
        right: 600px;
        bottom: 100px;
        margin: auto;
        width: 360px;
        height: 400px;
        border-radius: 5px;
        background: rgba(3, 3, 3, 0.25);
        box-shadow: 1px 1px 50px #000;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 90%;
        width: 90%;
    }

    .imagenAeurus {
        height: 15%;
        width: 70%;
    }
</style>

<body>
    <div class="container" id="container">
        <img src="img/aeurus.png" class="imagenAeurus mt-4" alt="">
        <form method="POST" action="{{route('login')}}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="E-mail">
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="pass" placeholder="Contraseña">
            </div>

            <button type="submit" class="btn btn-secondary">Entrar</button>
            <br>
            <div>
                <a href="" class="float-right" style="color: #ffffff;">¿Olvidaste tu contraseña?</a>
            </div>
        </form>
    </div>
</body>

</html>
<script>

</script>