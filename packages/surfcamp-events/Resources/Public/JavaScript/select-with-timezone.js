document.querySelectorAll('select').forEach((select) => {
    if (select.dataset?.selectTimezoneValidation) {
        select.addEventListener('change', () => {
            console.log('Custom selectSingleWithJs change event:', select.value);
        });
    }
});
