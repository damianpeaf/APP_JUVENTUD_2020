
$(document).ready(function () {
  $('#calendario').fullCalendar({

      height: 'parent',

      header: {
          left: 'prev',
          center: 'title',
          right: 'month,basicWeek,basicDay, next'
      },

      footer: {
          left: '',
          center: '',
          right: ''
      },

      themeSystem: 'standard',

    //   dayClick: function (date, jsEvent, view) {
    //       $('#txtFecha').val(date.format())
    //       $('#formModal').modal();
    //   },

      events: './api/eventos.php',

      eventClick: function (calEvent, jsEvent, view) {

        $('.modal-title').html(calEvent.title)

        $('#des').html(calEvent.descripcion)

        // $('#txtId').val(calEvent.id)
        // $('#modal-title').val(calEvent.title)

        FechaHoraI = calEvent.start._i.split(" ")


        $('#diaI').html(FechaHoraI[0].split("-").reverse().join("-"))
        $('#horaI').html(FechaHoraI[1])

        FechaHoraD = calEvent.end._i.split(" ")
        $('#diaF').html(FechaHoraD[0].split("-").reverse().join("-"))
        $('#horaF').html(FechaHoraD[1])

        var color = calEvent.backgroundColor;

        $('.modal-header').css('background', color);


        // $.post('adjuntos.php', calEvent.adjuntos, function (response) {
            
        // });

        console.log(calEvent.adjuntos);

        $(".descargas").hide();


        if (calEvent.adjuntos != null) {
            var adjuntos = JSON.parse(calEvent.adjuntos)
            let template  = "";

            for(var k in adjuntos) {
                
                var nombre = adjuntos[k];
                
                template += `<a href="./docs/${nombre}" download="${nombre}"><img class="iconoDescargar"src="./img/desktop/iconoDescargar.png" >${nombre}</a><br>`

                $(".adjuntos").html(template);
                $(".descargas").show();
             }
                       
        }

        $('#infoModal').modal();
    }

  });

  // CREAR BOTON EN FOOTER

  $('.fc-footer-toolbar > .fc-center').append("<span class='ir-abajo icon-arrow-down2'></span>");

  // BOTON IR ARRIBA

  $('.ir-arriba').click(function () {
      $('body, html').animate({
          scrollTop: '0px'
      }, 750);
  });

  $(window).scroll(function () {
      if ($(this).scrollTop() > 0) {
          $('.ir-arriba').slideDown(500);
      } else {
          $('.ir-arriba').slideUp(500);
      }
  });

  // BOTON IR ABAJO

  $('.ir-abajo').click(function () {
      $('body, html').animate({
          scrollTop: $(document).height()
      }, 750);
  });

  $(window).scroll(function () {
      if ($(this).scrollTop() > 0) {
          $('.ir-abajo').slideUp(500);
      } else {
          $('.ir-abajo').slideDown(500);
      }
  });

});