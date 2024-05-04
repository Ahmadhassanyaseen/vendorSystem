<?php
$page = 'calender';
require_once('config.php');
require_once('session.php');
require_once('./header.php');
require_once('./header_nav.php');

// print_r($_SESSION['VNDR']['allLeads']);
?>


<style>
    #calendar-container {
        max-width: 1167px;
        margin: auto;
        margin-top: 3rem;
    }


    .fc-dayGrid-view .fc-body .fc-row {
        min-height: 10em;
    }

    .fc .fc-row .fc-content-skeleton td {
        width: 166px;
    }

    .fc-unthemed td.fc-today {
        background-color: lightgray;
    }

    .fc-ltr .fc-dayGrid-view .fc-day-top .fc-day-number {
        float: none;
        font-size: 16px;
        color: #DFCA8B;
    }

    .fc-unthemed td.fc-today a {
        color: #fff !important;
    }

    a.fc-more {
        color: #DFCA8B !important;
    }

    .fc-unthemed th,
    .fc-unthemed td,
    .fc-unthemed thead,
    .fc-unthemed tbody,
    .fc-unthemed .fc-divider,
    .fc-unthemed .fc-row,
    .fc-unthemed .fc-content,
    .fc-unthemed .fc-popover,
    .fc-unthemed .fc-list-view,
    .fc-unthemed .fc-list-heading td {
        border-color: #DFCA8B !important;
    }

    .fc th {
        font-size: 16px;
    }

    .leadView {
        display: flex;
        align-items: center;
        justify-content: end;
        gap: 10px;
        margin-bottom: 2rem;
    }

    #calendar_deadLeads{
        display: none;
    }
</style>


<div id='calendar-container'>
    <div class="leadView">
        <label for="deadLeadView">Hide Dead Leads</label>
        <input type="checkbox" name="deadLeadView" id="deadLeadView">
    </div>
    <div id='calendar'></div>
    <div id='calendar_deadLeads'></div>
</div>
<script>
    let eventList = [];

    let deadLead = document.getElementById('deadLeadView');
    let allCal = document.getElementById('calendar');
    let deadCal = document.getElementById('calendar_deadLeads');

    let toggle = true;
    deadLead.addEventListener('click', () => {
        if (toggle) {
            allCal.style.display = 'none';
            deadCal.style.display = 'block';
            toggle = !toggle;
        } else {
            allCal.style.display = 'block';
            deadCal.style.display = 'none';
            toggle = !toggle;
        }
    })


    for (let key in items) {
        if (items.hasOwnProperty(key)) {
            eventList.push({
                title: items[key].first_name + " " + items[key].last_name,
                start: items[key].eventdate_c,
                status: items[key].status,
                url: 'http://localhost/vendor/editLead_vendor1.php?opertunityid_c=' + items[key].opertunityid_c
            });
        }
    }
    // console.log(eventList);




    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            height: 'parent',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek'
            },
            defaultView: 'dayGridMonth',
            defaultDate: new Date(), // Set defaultDate to the current date
            navLinks: true,
            editable: true,
            eventLimit: true,
            events: eventList // Use eventArray as the events data source
        });

        calendar.render();
    });



    let eventListDead = [];



    for (let key in items) {
        if (items.hasOwnProperty(key)) {

            if (items[key].status == 'Dead') {
                continue;
            } else {
                eventListDead.push({
                    title: items[key].first_name + " " + items[key].last_name,
                    start: items[key].eventdate_c,
                    status: items[key].status,
                    url: 'http://localhost/vendor/editLead_vendor1.php?opertunityid_c=' + items[key].opertunityid_c
                });
            }

        }
    }


    document.addEventListener('DOMContentLoaded', function() {
        var calendarDeadLead = document.getElementById('calendar_deadLeads');

        var calendarDead = new FullCalendar.Calendar(calendarDeadLead, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            height: 'parent',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek'
            },
            defaultView: 'dayGridMonth',
            defaultDate: new Date(), // Set defaultDate to the current date
            navLinks: true,
            editable: true,
            eventLimit: true,
            events: eventListDead // Use eventArray as the events data source
        });

        calendarDead.render();
    });
</script>





<?php
require_once('./footer.php');
?>