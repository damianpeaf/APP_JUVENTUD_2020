<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PeriódicoDB</title>

    <!-- Estilos -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>

    <!-- Full calendar 3.8.2 -->
    <script src="js/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/es.js"></script>

    <!-- Bootsrap modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- basicos -->
    <link rel="stylesheet" href="css/estilosBase.css">

</head>

<body>
    <header class="contenedorHeader">
        <div class="menu-item" id="logo">
            <img src="./img/desktop/logo.png"><span id="logo-nombre">PeriódicoDB</span>
        </div>
        <div class="menu-item" id="redes">
            <nav class="redes-container">

                <a href="https://www.instagram.com/movjuveoficial/?hl=es">
                    <img src="./img/desktop/instagram.png">
                </a>
                <!-- Twitter -->
                <a href="https://twitter.com/vidacolegiodb?lang=es">
                    <img src="./img/desktop/twitter.png">
                </a>
                <!-- Facebook -->
                <a href="https://www.facebook.com/movjuveoficial/">
                    <img src="./img/desktop/facebook.png">
                </a>
            </nav>
        </div>
        <div class="menu-item" id="categorias">
            <div><a href="">Religión</a></div>
            <div><a href="">Deporte</a></div>
            <div><a href="">Ciencia</a></div>
            <div><a href="">Arte</a></div>
        </div>
        <div class="menu-item" id="logoJuventud"><img src="./img/desktop/logo2.png"></div>
    </header>

    <!-- Menu para telefono Escondido -->

    <!-- Parte arriba -->

    <div class="phone-header">
        <div class="menu-item" id="logo">
            <img src="./img/desktop/logo.png">
        </div>
        <div class="menu-item" id="redes">
            <nav class="redes-container">

                <a href="https://www.instagram.com/movjuveoficial/?hl=es">
                    <img src="./img/desktop/instagram.png">
                </a>
                <!-- Twitter -->
                <a href="https://twitter.com/vidacolegiodb?lang=es">
                    <img src="./img/desktop/twitter.png">
                </a>
                <!-- Facebook -->
                <a href="https://www.facebook.com/movjuveoficial/">
                    <img src="./img/desktop/facebook.png">
                </a>
            </nav>
        </div>
        <div class="menu-item" id="logoJuventud"><img src="./img/desktop/logo2.png"></div>
    </div>
    <!-- Parte abajo -->
    <div class="phone-footer">
        <div class="categorias">
            <div><a href="">Religión</a></div>
            <div><a href="">Deporte</a></div>
            <div><a href="">Ciencia</a></div>
            <div><a href="">Arte</a></div>
        </div>
    </div>

    <!-- Fin  -->

    <main class="contenedorCalendario">
        <div class="inclusion-calendario" id="calendario"></div>
    </main>

    <main class="contenedorNoticias">
        <div class="header-noticias"> 
            <h1>Noticias</h1>
        </div>

        <div class="noticia">
            <div class="imagen-noticia"><img src="" ></div>
            <div class="informacion-noticia">
                <div class="titulo-noticia"> lorem </div>
                <div class="contenido-noticia">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, deserunt quidem! Tempora autem sequi asperiores veniam, a explicabo? Ipsam vel fuga ea sunt cupiditate inventore nemo veritatis assumenda est eligendi!</div>
                <p><a href='' > Ver más. </a></p>
            </div>
        </div>

        <div class="noticia">
            <div class="imagen-noticia"><img src="" ></div>
            <div class="informacion-noticia">
                <div class="titulo-noticia"> lorem </div>
                <div class="contenido-noticia">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, deserunt quidem! Tempora autem sequi asperiores veniam, a explicabo? Ipsam vel fuga ea sunt cupiditate inventore nemo veritatis assumenda est eligendi!</div>
                <p><a href='' > Ver más. </a></p>
            </div>
        </div>
        
        <div class="noticia">
            <div class="imagen-noticia"><img src="" ></div>
            <div class="informacion-noticia">
                <div class="titulo-noticia"> lorem </div>
                <div class="contenido-noticia">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, deserunt quidem! Tempora autem sequi asperiores veniam, a explicabo? Ipsam vel fuga ea sunt cupiditate inventore nemo veritatis assumenda est eligendi!</div>
                <p><a href='' > Ver más. </a></p>
            </div>
        </div>

        <div class="noticia">
            <div class="imagen-noticia"><img src="" ></div>
            <div class="informacion-noticia">
                <div class="titulo-noticia"> lorem </div>
                <div class="contenido-noticia">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Necessitatibus, deserunt quidem! Tempora autem sequi asperiores veniam, a explicabo? Ipsam vel fuga ea sunt cupiditate inventore nemo veritatis assumenda est eligendi!</div>
                <p><a href='' > Ver más. </a></p>
            </div>
        </div>

    </main>

    <footer class="contenedorFooter">
        <div class="copyright">
            <h1>COPYRIGHT</h1>
        </div>
    </footer>

    <script>
        $(document).ready(function () {
            $('#calendario').fullCalendar({

                height: 'parent',

                header: {
                    left: 'prev',
                    center: 'title',
                    right: 'month,basicWeek,basicDay, next'
                },
                themeSystem: 'standard',

                dayClick: function (date, jsEvent, view) {
                    $('#txtFecha').val(date.format())
                    $('#formModal').modal();
                },

                events: './eventos.php',

                eventClick: function (calEvent, jsEvent, view) {

                    $('#tituloModal').html(calEvent.title)

                    $('#txtDescripcion').val(calEvent.descripcion)
                    $('#txtId').val(calEvent.id)
                    $('#txtTitulo').val(calEvent.title)
                    $('#txtColor').val(calEvent.color)

                    FechaHora = calEvent.start._i.split(" ")
                    $('#txtFecha').val(FechaHora[0])
                    $('#txtHora').val(FechaHora[1])
                    $('#formModal').modal();
                }

            });
        });
    </script>
    
    <script src="./js/resize_vh.js""></script>

</body>

</html>