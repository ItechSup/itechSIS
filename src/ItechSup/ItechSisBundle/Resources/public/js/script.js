$(document).ready(function() {    
    var data = $('#calendar').attr('data-itech-events');
    console.log(data);
    if (data) {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            lang: "fr",
            weekends: false,
            businessHours: {
                'start': '8:30',
                'end': '18:00',
                dow: [1, 2, 3, 4, 5]
            },
            defaultView: 'agendaWeek',
            minTime: '08:00:00',
            maxTime: '18:30:00',
            eventSources: [
                data
            ]
        });
    }
});