window.onload = function() {
    const ids = getEventIds();
    const timezone = getClientTimezone();
    fetchEventDates(ids, timezone);
};

function getEventIds() {
    const events = document.querySelectorAll('.event');
    let eventIds = [];
    events.forEach(function (event) {
        if (event.dataset.id) {
            eventIds.push(event.dataset.id);
        }
    })
    return eventIds;
}

function getClientTimezone() {
    return Intl.DateTimeFormat().resolvedOptions().timeZone;
}

async function fetchEventDates(ids, timezone) {
    const url = '/api/surfcamp-events/get-time-for-events?ids=' + ids.join() + '&timezone=' + timezone;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        updateEventsDateTime(json);
    } catch (error) {
        console.error(error.message);
    }
}

function updateEventsDateTime(data) {
    const events = document.querySelectorAll('.event');
    events.forEach(function (eventElement) {
        if (!eventElement.dataset.id) {
            return;
        }

        if (!data[eventElement.dataset.id]) {
            return;
        }

        const eventData = data[eventElement.dataset.id];

        if(eventData.startDate) {
            let dateTime = new Date(eventData.startDate);
            const startDateElement = eventElement.querySelector('.event-start-date');
            startDateElement.innerHTML = formatDate(dateTime);
        }

        if(eventData.endDate) {
            let dateTime = new Date(eventData.endDate);
            const endDateElement = eventElement.querySelector('.event-end-date');
            endDateElement.innerHTML = formatDate(dateTime);
        }
    });
}

function formatDate(datetime) {
    const day = datetime.getDate();
    const month = datetime.getMonth() + 1; // Months are 0-based
    const year = datetime.getFullYear();

    const hours = datetime.getHours();
    const minutes = datetime.getMinutes();

    return `${day}.${month}.${year} ${hours}:${minutes}`;
}
