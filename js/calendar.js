document.addEventListener('DOMContentLoaded', () => {
    const calendarDays = document.getElementById('calendarDays');
    const monthYear = document.getElementById('monthYear');
    const prevMonth = document.getElementById('prevMonth');
    const nextMonth = document.getElementById('nextMonth');
    const addEventButton = document.getElementById('addEvent');
    const eventModal = document.getElementById('eventModal');
    const tagName = document.getElementById('tagg');
    const closeModal = document.getElementById('closeModal');
    const saveEvent = document.getElementById('saveEvent');
    const eventDate = document.getElementById('eventDate');
    const eventDate2 = document.getElementById('eventDate2');
    const eventTime = document.getElementById('eventTime');
    const eventTimeTo = document.getElementById('eventTimeTo'); // new
    const eventText = document.getElementById('eventText');
    const displayModal = document.getElementById('displayModal');
    const closeDisplayModal = document.getElementById('closeDisplayModal');
    const eventDetails = document.getElementById('eventDetails');
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const saveEdit = document.getElementById('saveEdit');
    const editEventDate = document.getElementById('editEventDate');
    const editEventDateTo = document.getElementById('editEventDateTo'); // new
    const editEventTime = document.getElementById('editEventTime');
    const editEventTimeTo = document.getElementById('editEventTimeTo'); // new
    const editEventText = document.getElementById('editEventText');
    const editEventTags = document.getElementById('editEventTags');

    const creatorId = document.getElementById('userId').value; // Get the current user ID from a hidden input

    let currentDate = new Date();
    let events = {};
    let currentEditEvent = null;

    function fetchEvents() {
        fetch('fetch_events.php')
            .then(response => response.json())
            .then(data => {
                events = data.reduce((acc, event) => {
                    const id = event.id;
                    const date = event.date;
                    const time = event.time;
                    const timeTo = event.timeTo;
                    const text = event.text;
                    const receiver = event.receiver;
                    const sender = event.sender;
                    const email = event.email; // Include the email field
                    const receiverStats = event.receiverStats;
                    if (!acc[date]) {
                        acc[date] = [];
                    }
                    acc[date].push({ id, time, timeTo, text, receiver, sender, email, receiverStats });
                    acc[date].sort((a, b) => a.time.localeCompare(b.time)); // Sort by time
                    return acc;
                }, {});
                renderCalendar();
            })
            .catch(error => console.error('Error fetching events:', error));
    }

    function formatTimeTo12Hour(time24) {
        const [hour, minute] = time24.split(':');
        let hour12 = parseInt(hour, 10);
        const ampm = hour12 >= 12 ? 'PM' : 'AM';
        hour12 = hour12 % 12 || 12; // Convert to 12-hour format, and handle midnight (0 hour)
        return `${String(hour12).padStart(2, '0')}:${minute} ${ampm}`;
    }

    function renderCalendar() {
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();
    
        monthYear.innerText = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;
    
        calendarDays.innerHTML = '';
    
        for (let i = 0; i < firstDay; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.classList.add('empty-day');
            calendarDays.appendChild(emptyDiv);
        }
    
        for (let i = 1; i <= lastDate; i++) {
            const dayDiv = document.createElement('div');
            const date = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            dayDiv.innerText = i;
            dayDiv.addEventListener('click', () => {
                if (events[date]) {
                    // Update database with AJAX request
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', 'calendarNotifUpdater.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log('Calendar Stats Updated = 0 Notification -1!');
                        }
                    };
                    xhr.send(JSON.stringify({ date, events: events[date] }));
                }
                displayEvent(date);
            });
    
            if (events[date]) {
                events[date].forEach(event => {
                    const eventDiv = document.createElement('div');
                    eventDiv.classList.add('event');
    
                    const timeDiv = document.createElement('div');
                    timeDiv.classList.add('time');
                    timeDiv.innerText = event.timeTo
                                        ? `${formatTimeTo12Hour(event.time)} - ${formatTimeTo12Hour(event.timeTo)}`
                                        : formatTimeTo12Hour(event.time);
                    // timeDiv.innerText = ' - 2:00 PM';
    
                    const textDiv = document.createElement('div');
                    textDiv.classList.add('text');
                    textDiv.innerText = event.text;
    
                    if (event.sender == creatorId) {
                        textDiv.style.cursor = 'pointer';
                        textDiv.addEventListener('click', (e) => {
                            e.stopPropagation();
                            openEditModal(date, event);
                        });
                    } else {
                        textDiv.style.cursor = 'not-allowed';
                        textDiv.addEventListener('click', (e) => {
                            e.stopPropagation();
                            alert('You do not have permission to edit this event.');
                        });
                    }
    
                    eventDiv.appendChild(timeDiv);
                    eventDiv.appendChild(textDiv);
    
                    if (event.receiverStats == 1) {
                        // const redDot = document.createElement('div');
                        // redDot.classList.add('red-dot');
                        // eventDiv.appendChild(redDot);
                    }
    
                    dayDiv.appendChild(eventDiv);
                });
            }
            calendarDays.appendChild(dayDiv);
        }
    }
    
    function displayEvent(date) {
        if (events[date]) {
            eventDetails.innerHTML = '';

            events[date].forEach(event => {
                const row = document.createElement('div');
                row.classList.add('row', 'align-items-center', 'mb-2');

                // Time column
                const timeCol = document.createElement('div');
                timeCol.classList.add('col-sm-4', 'text-muted', 'displayTime');

                const startTime = formatTimeTo12Hour(event.time);
                const endTime = event.timeTo ? formatTimeTo12Hour(event.timeTo) : null;

                timeCol.innerText = endTime
                    ? `${startTime} - ${endTime}`
                    : startTime;

                // Divider column
                const dividerCol = document.createElement('div');
                dividerCol.classList.add('col-sm-1', 'text-center');
                dividerCol.classList.add('text-muted');
                dividerCol.innerText = '|';

                // Text column
                const textCol = document.createElement('div');
                textCol.classList.add('col-sm-7');
                textCol.classList.add('text-muted');
                textCol.innerText = event.text;

                row.appendChild(timeCol);
                row.appendChild(dividerCol);
                row.appendChild(textCol);

                eventDetails.appendChild(row);
            });

            displayModal.style.display = 'block';
        } else {
            alert('No events for this date.');
        }
    }
    

    function openModal(date) {
        eventModal.style.display = 'block';
        eventDate.value = date;
        eventDate2.value = date2;
        eventTime.value = '';
        eventTimeTo.value = '';
        eventText.value = '';
        tagName.value = '';
    }

    function openEditModal(date, event) {
        editModal.style.display = 'block';
        editEventDate.value = date;
        editEventTime.value = event.time;
        editEventTimeTo.value = event.timeTo;
        editEventText.value = event.text;
    
        // Split the email string into an array, format each email, and join them back
        const formattedEmails = event.email.split(',').map(email => `@${email.trim()}`).join(', ');
    
        editEventTags.value = formattedEmails; // Place formatted emails in the tags input field
    
        currentEditEvent = { date, time: event.time, timeTo: event.timeTo, text: event.text, email: event.email };
    }
    

    addEventButton.addEventListener('click', () => {
        openModal(new Date().toISOString().split('T')[0]);
    });

    closeModal.addEventListener('click', () => {
        eventModal.style.display = 'none';
    });

    closeDisplayModal.addEventListener('click', () => {
        displayModal.style.display = 'none';
    });

    closeEditModal.addEventListener('click', () => {
        editModal.style.display = 'none';
    });

    saveEvent.addEventListener('click', () => {
        const date = eventDate.value;
        const date2 = eventDate2.value;
        const time = eventTime.value;
        const timeTo = eventTimeTo.value;
        const tags = tagName.value.split(',').map(tag => tag.trim().replace(/^@|@$/g, ""));
        const text = eventText.value;

        if (text.trim() && tags.length > 0) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'calendarSubmit.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        if (!events[date]) {
                            events[date] = [];
                        }
                        events[date].push({ time, timeTo, text, sender: creatorId });
                        events[date].sort((a, b) => a.time.localeCompare(b.time)); // Sort by time
                        renderCalendar();
                        alert('Schedule Successfully Created!');
                    } else {
                        alert('Error saving event.');
                    }
                }
            };
            xhr.send(JSON.stringify({ date, date2, time, timeTo, trimmedTags: tags, text }));

            eventModal.style.display = 'none';
        }
    });
    
    // for Saving edit
    saveEdit.addEventListener('click', () => {
        const date = editEventDate.value;
        const time = editEventTime.value;
        const timeTo = editEventTimeTo.value;
        const text = editEventText.value;
        const tags = editEventTags.value.split(',').map(tag => tag.trim().replace(/^@|@$/g, ""));
        
        if (text.trim() && tags.length > 0) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'calendar_editEvents.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            // Update events in the client side
                            // Remove the old event
                            events[currentEditEvent.date] = events[currentEditEvent.date].filter(event => 
                                !(event.time === currentEditEvent.time && event.timeTo === currentEditEvent.timeTo && event.text === currentEditEvent.text && event.email === currentEditEvent.email)
                            );
    
                            // Add the edited event
                            if (!events[date]) {
                                events[date] = [];
                            }
                            events[date].push({ time, timeTo, text, email: currentEditEvent.email });
                            events[date].sort((a, b) => a.time.localeCompare(b.time)); // Sort by time
    
                            renderCalendar();
                            alert('Re-schedule Successfully Updated!');
                        } else {
                            alert(response.message);
                        }
                    } else {
                        alert('Error saving event.');
                    }
                }
            };
            xhr.send(JSON.stringify({ 
                date, 
                time, 
                timeTo,
                text, 
                trimmedTags: tags,
                originalDate: currentEditEvent.date,
                originalTime: currentEditEvent.time,
                originalTimeTo: currentEditEvent.timeTo,
                originalText: currentEditEvent.text,
                originalEmail: currentEditEvent.email // Send original emails
            }));
    
            editModal.style.display = 'none';
        }
    });
    
    // for deleting of edit
    deleteEdit.addEventListener('click', () => {
        if (!confirm('Are you sure you want to delete this event?')) return;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'calendar_deleteEvents.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.status === 'success') {

                        // 🔥 Remove the event from client-side
                        events[currentEditEvent.date] = events[currentEditEvent.date].filter(event => 
                            !(
                                event.time === currentEditEvent.time &&
                                event.timeTo === currentEditEvent.timeTo &&
                                event.text === currentEditEvent.text &&
                                event.email === currentEditEvent.email
                            )
                        );

                        // Optional: clean empty date
                        if (events[currentEditEvent.date].length === 0) {
                            delete events[currentEditEvent.date];
                        }

                        renderCalendar();
                        alert('Event deleted successfully!');
                        editModal.style.display = 'none';

                    } else {
                        alert(response.message);
                    }
                } else {
                    alert('Error deleting event.');
                }
            }
        };

        xhr.send(JSON.stringify({
            date: currentEditEvent.date,
            time: currentEditEvent.time,
            timeTo: currentEditEvent.timeTo,
            text: currentEditEvent.text,
            email: currentEditEvent.email
        }));
    });


    prevMonth.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonth.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    fetchEvents();
});
