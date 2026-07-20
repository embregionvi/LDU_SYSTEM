<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css">

<style>
    .external-event {
        cursor: move;
        color: #fff;
        padding: 10px 12px;
        margin-bottom: 10px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
    }

    #calendar {
        background: #fff;
        padding: 10px;
        border-radius: 10px;
        min-height: 700px;
    }

    .calendar-left-card {
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,.08);
        margin-bottom: 15px;
    }

    .fc .fc-toolbar-title {
        font-size: 1.2rem;
        font-weight: 700;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">

            <div class="calendar-left-card">
                <h5 class="mb-3">Draggable Events</h5>

                <div id="external-events">
                    <div class="external-event bg-success">Meeting</div>
                    <div class="external-event bg-primary">Seminar</div>
                    <div class="external-event bg-warning text-dark">Training</div>
                    <div class="external-event bg-danger">Workshop</div>
                    <div class="external-event bg-info text-dark">Conference</div>
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="drop-remove">
                    <label class="form-check-label" for="drop-remove">
                        Remove after drop
                    </label>
                </div>
            </div>

            <div class="calendar-left-card">
                <h5 class="mb-3">Create Event</h5>

                <div class="btn-group mb-3" role="group">
                    <button type="button" class="btn btn-primary color-picker" data-color="#0d6efd">Blue</button>
                    <button type="button" class="btn btn-success color-picker" data-color="#198754">Green</button>
                    <button type="button" class="btn btn-warning color-picker" data-color="#ffc107">Yellow</button>
                    <button type="button" class="btn btn-danger color-picker" data-color="#dc3545">Red</button>
                    <button type="button" class="btn btn-secondary color-picker" data-color="#6c757d">Gray</button>
                </div>

                <div class="input-group">
                    <input id="new-event" type="text" class="form-control" placeholder="Event title">
                    <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let currColor = '#0d6efd';

    const calendarEl = document.getElementById('calendar');
    const containerEl = document.getElementById('external-events');
    const checkbox = document.getElementById('drop-remove');
    const newEventInput = document.getElementById('new-event');
    const addNewEventBtn = document.getElementById('add-new-event');

    document.querySelectorAll('.color-picker').forEach(btn => {
        btn.addEventListener('click', function () {
            currColor = this.dataset.color;
            addNewEventBtn.style.backgroundColor = currColor;
            addNewEventBtn.style.borderColor = currColor;
        });
    });

    function bindExternalEvent(el) {
        el.setAttribute('data-event', JSON.stringify({
            title: el.innerText.trim(),
            backgroundColor: window.getComputedStyle(el).backgroundColor,
            borderColor: window.getComputedStyle(el).backgroundColor,
            textColor: window.getComputedStyle(el).color || '#fff'
        }));
    }

    containerEl.querySelectorAll('.external-event').forEach(bindExternalEvent);

    new FullCalendar.Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function (eventEl) {
            const data = eventEl.getAttribute('data-event');
            return data ? JSON.parse(data) : {
                title: eventEl.innerText.trim()
            };
        }
    });

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        editable: true,
        droppable: true,
        selectable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        events: <?= json_encode($calendarEvents ?? []) ?>,

        drop: function(info) {
            if (checkbox.checked) {
                info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
        },

        eventReceive: function(info) {
            saveEvent({
                title: info.event.title,
                start: info.event.startStr,
                end: info.event.endStr ?? '',
                color: info.event.backgroundColor,
                allDay: info.event.allDay ? 1 : 0
            }, function(response) {
                if (response.id) {
                    info.event.setProp('id', response.id);
                }
            });
        },

        eventDrop: function(info) {
            updateEvent(info.event);
        },

        eventResize: function(info) {
            updateEvent(info.event);
        },

        select: function(info) {
            const title = prompt('Event Title:');
            if (!title) {
                calendar.unselect();
                return;
            }

            const event = calendar.addEvent({
                title: title,
                start: info.startStr,
                end: info.endStr,
                allDay: info.allDay,
                backgroundColor: '#0d6efd',
                borderColor: '#0d6efd',
                textColor: '#fff'
            });

            saveEvent({
                title: event.title,
                start: event.startStr,
                end: event.endStr ?? '',
                color: event.backgroundColor,
                allDay: event.allDay ? 1 : 0
            }, function(response) {
                if (response.id) {
                    event.setProp('id', response.id);
                }
            });

            calendar.unselect();
        },

        eventClick: function(info) {
            if (confirm('Delete this event?')) {
                deleteEvent(info.event);
            }
        }
    });

    calendar.render();

    addNewEventBtn.addEventListener('click', function () {
        const val = newEventInput.value.trim();
        if (!val) return;

        const event = document.createElement('div');
        event.className = 'external-event';
        event.textContent = val;
        event.style.backgroundColor = currColor;
        event.style.borderColor = currColor;
        event.style.color = '#fff';
        event.style.padding = '10px 12px';
        event.style.borderRadius = '6px';
        event.style.marginBottom = '10px';
        event.style.cursor = 'move';
        event.style.fontWeight = '600';

        bindExternalEvent(event);
        containerEl.prepend(event);

        newEventInput.value = '';
    });

    function saveEvent(data, callback = null) {
        fetch('<?= site_url('calendar/store') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(res => {
            if (callback) callback(res);
        })
        .catch(err => console.error(err));
    }

    function updateEvent(event) {
        fetch('<?= site_url('calendar/update') ?>/' + event.id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                title: event.title,
                start: event.startStr,
                end: event.endStr ?? '',
                color: event.backgroundColor,
                allDay: event.allDay ? 1 : 0
            })
        }).catch(err => console.error(err));
    }

    function deleteEvent(event) {
        fetch('<?= site_url('calendar/delete') ?>/' + event.id, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(() => event.remove())
        .catch(err => console.error(err));
    }
});
</script>

<?= $this->endSection() ?>