$(document).ready(function() {
	if ($('#calendar').length) {
        data = $.parseJSON($('#calendar').attr('data-itech-events'));
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

