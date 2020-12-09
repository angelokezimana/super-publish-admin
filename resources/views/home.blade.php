@extends('templates.default')

@section('full-calendar')
<link rel="stylesheet" href="{{ asset('css/full-calendar.min.css') }}">
<script src="{{ asset('js/full-calendar.min.js') }}"></script>
<script src="{{ asset('js/full-calendar-fr.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
          headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
        initialView: 'dayGridMonth',
        locale: 'fr',
        navLinks: true, // can click day/week names to navigate views
      });
      calendar.render();
    });
</script>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Calendrier</h1>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4 border-bottom-primary">
                <div id='calendar'></div>
            </div>
        </div><!-- /# column -->
    </div>
</div>
@endsection
