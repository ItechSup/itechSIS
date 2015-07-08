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
            defaultDate: '2015-02-12',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: data
        });
    }
});