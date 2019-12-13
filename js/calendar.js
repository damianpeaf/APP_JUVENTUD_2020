
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

      dayClick: function (date, jsEvent, view) {
          $('#txtFecha').val(date.format())
          $('#formModal').modal();
      },

      events: './api/eventos.php',

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