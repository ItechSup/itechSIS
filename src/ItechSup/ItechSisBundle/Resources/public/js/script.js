$(document).ready(function() {
    var data = $('#calendar').attr('data-itech-events');
    if (data) {
        data = $.parseJSON(data);
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            lang: "fr",
            weekends: false,
            businessHours: {
                'start': '8:30',
                'end': '18:00',
                dow: [1, 2, 3, 4, 5]
            },
            eventSources: [
                data,
                '/api/calendar'
            ]
        });
    }
});