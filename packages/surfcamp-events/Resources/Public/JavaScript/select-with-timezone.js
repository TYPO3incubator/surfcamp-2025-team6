import Notification from "@typo3/backend/notification.js";

document.querySelectorAll('select').forEach((select) => {
    if (select.dataset?.selectTimezoneValidation) {
        select.addEventListener('change', () => {
            Notification.warning('Warning', 'Make sure the selected timezone is correct.');
        });
    }
});
