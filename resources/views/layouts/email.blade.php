<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Aeurus</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.12.0/css/all.css" crossorigin="anonymous"/>

        <style type="text/css">
            body{
                background-color: #f1f1f1;
                font: 16px 'Roboto', Arial, Helvetica, sans-serif;
            }
            .contenedor{
                width: 800px;
                margin: 30px auto;
                background: #fff;
                padding: 50px;
            }
           
            .content{
             
                color: #5a646a;
            }
            .footer{
                padding: 30px;
                padding-bottom: 20px;
            }
            .footer .logo{
                display: block;
                margin-bottom: 20px;
            }

            ul {
                list-style: none;
            }
            .img-circle {
                border-radius: 50%;
            }
           
            

            /*Barra*/
            .banner { margin-bottom: 44px; position:relative;}
            .banner img { vertical-align: top; width: 100%; height: auto;}
            .banner .resp { display: none;}
            .banner .caption {
                width: 100%;
                padding-top: 50px;
                position: absolute;
                top:0;
                left:0;
            }
            .banner .caption figure.text-center {
                width: 110px;
                margin: 0 auto 40px;
            }
            .banner .caption h1 {
                color: #FFF;
                font-size: 2em;
                font-size: 2rem;
                text-transform: none;
            }
            .banner .caption form {
                max-width: 530px;
                margin: 0 auto;
                position: relative;
            }
            .banner .caption form input[type="text"] {
                background: #FFF url(/public/img/lupa.png) 20px center no-repeat;
                padding-left: 50px;
                
                -webkit-border-radius: 27px;
                -moz-border-radius: 27px;
                -ms-border-radius: 27px;
                -khtml-border-radius: 27px;
                border-radius: 27px;
            }
            .banner .caption form {
                width: 150px;
                position: absolute;
                top: 5px;
                right: 5px;

                -webkit-border-radius: 36px;
                -moz-border-radius: 36px;
                -ms-border-radius: 36px;
                -khtml-border-radius: 36px;
                border-radius: 36px;
            }
            .banner .caption .ir-web {
                font-weight: bold;
                line-height: 26px;
                position: absolute;
                top: 18px;
                left:0;
            }
            .banner .caption .ir-web a, .banner .caption .ir-web a:visited {
                color: #FFF;
            }
            .banner .caption .ir-web i { font-size: 34px; line-height: 24px; vertical-align: top; margin-right: 10px;}


            .estado-pedido {
                max-width: 600px;
                padding: 40px 0;
                margin: 0 auto;
            }
            .estado-pedido .inline-block {
                display: table;
                width: 100%;
            }
            .estado-pedido .inline-block li{
                vertical-align: top;
                text-align: center;
                display: table-cell;
                width: 33.33%;
                position: relative;
            }
            .estado-pedido .inline-block li br { display: none;}
            .estado-pedido .inline-block li span { display: block;}
            .estado-pedido .inline-block li span.img-circle {
                color: #000;
                line-height: 56px;
                text-align: center;
                width: 56px;
                height: 56px;
                padding-top: 2px;
                margin: 0 auto 12px;
                border: 1px solid #292929;
            }

            .estado-pedido .inline-block li:nth-child(1) i { font-size:25px;}
            .estado-pedido .inline-block li:nth-child(2) i { font-size: 24px;}
            .estado-pedido .inline-block li:nth-child(3) i { font-size: 23px;}
            .estado-pedido .inline-block li span.txt-label small {
                color: #707070;
                font-size: 13px;
                line-height: 18px;
                display: block;
            }
            .estado-pedido .inline-block li span.txt-label {
                color: #1F1E1E;
                font-size: 16px;
                font-weight: 500;
                line-height: 21px;
            }
            .estado-pedido .inline-block li.active span.img-circle {
                color: #FFF;
                background-color: #B11010;
                border-color: #B11010;
            }
            .estado-pedido .inline-block li .linea {
                width: 72%;
                position: absolute;
                top: 28px;
                left: 64%;
                border-top: 1px solid #020202;
            }
            .estado-pedido .listado { padding: 0 10%; min-height: 160px;}
            .estado-pedido .listado .fa-gift{
                color: #000000;
                font-size: 110px;
                float: left;
                margin-left: 30px;
            }
            .estado-pedido .listado .resumen h2 { margin-bottom: 18px;}
            .estado-pedido .listado .resumen {
                margin-left: 180px;
            }
            .estado-pedido .listado .resumen p{
                color: #313131;
                line-height: 24px;
            }
           
          
            /*FIN BARRA*/


        </style>
    </head>
    <body>
   
        <div class="contenedor">
            <div class="header">
                <img src="https://static.wixstatic.com/media/1b5038_a7d8350ca46b4a5aaf4ebfbb48088a0b~mv2.png/v1/fill/w_560,h_112,al_c,lg_1,q_95/aeurus.webp"  style="display: block; margin: 0 auto 30px;width:140px; " alt="Aeurus logo">
{{--                 <img src="http://aeurus.aeurus.cl/imagenes/template/logo.svg" alt="Aeurus logo" style="display: block; margin: 0 auto 30px;width:140px; "> 
 --}}            </div>
            <div class="content">
               {{$contacto['con_mensaje']}}
            </div>
            <div class="footer">
              
            </div>
        </div>
        

    </body>
    
</html>