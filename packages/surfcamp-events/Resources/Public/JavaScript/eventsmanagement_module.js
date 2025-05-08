import '@typo3-incubator/surfcamp-events/Libs/json-editor.js'
import AjaxRequest from "@typo3/core/ajax/ajax-request.js";
import Notification from "@typo3/backend/notification.js";

class EventsManagementModule {
    init() {
        if (document.getElementById('appointments_generator') !== null) {
            const element = document.getElementById('appointments_generator');
            // if (jseditor instanceof window.JSONEditor) jseditor.destroy();
            const jseditor = new window.JSONEditor(element, {
                theme: 'bootstrap4',
                disable_collapse: true,
                disable_edit_json: true,
                disable_properties: true,
                no_additional_properties: true,
                compact: false,
                disable_array_delete_last_row: true,
                array_controls_top: true,
                disable_array_reorder: false,
                schema: {
                    "title": "Appointment Generation",
                    "description": "TODO: Add an short and self-explaning description here.",
                    "type": "object",
                    "required": [],
                    "properties": {
                        "singleEvents": {
                            "type": "array",
                            "format": "table",
                            "title": "Single Appointments",
                            "description": "TODO: Add an short and self-explaning description here.",
                            "uniqueItems": true,
                            "items": {
                                "type": "object",
                                "title": "Appointment (Single Date)",
                                "properties": {
                                    "date": {
                                        "type": "string",
                                        "format": "date",
                                        "options": {
                                            "flatpickr": {}
                                        }
                                    },
                                }
                            },
                            "default": []
                        },
                        "recurringAppointments": {
                            "type": "array",
                            "format": "table",
                            "title": "Recurring Appointments",
                            "description": "TODO: Add an short and self-explaning description here.",
                            "uniqueItems": true,
                            "items": {
                                "type": "object",
                                "title": "Appointment (Date Range)",
                                "properties": {
                                    "date_from": {
                                        "type": "string",
                                        "format": "date",
                                        "options": {
                                            "flatpickr": {}
                                        }
                                    },
                                    "date_to": {
                                        "type": "string",
                                        "format": "date",
                                        "options": {
                                            "flatpickr": {}
                                        }
                                    },
                                }
                            },
                            "default": []
                        },
                        "appointmentSingleExclusions": {
                            "type": "array",
                            "format": "table",
                            "title": "Appointment Exclusions (Single Date)",
                            "description": "TODO: Add an short and self-explaning description here.",
                            "uniqueItems": true,
                            "items": {
                                "type": "object",
                                "title": "Appointment Exclusion (Single Date)",
                                "properties": {
                                    "date": {
                                        "type": "string",
                                        "format": "date",
                                        "options": {
                                            "flatpickr": {}
                                        }
                                    },
                                },
                            },
                            "default": []
                        },
                        "appointmentRangeExclusions": {
                            "type": "array",
                            "format": "table",
                            "title": "Appointment Exclusions (Date Range)",
                            "description": "TODO: Add an short and self-explaning description here.",
                            "uniqueItems": true,
                            "items": {
                                "type": "object",
                                "title": "Appointment Exclusion (Date Range)",
                                "properties": {
                                    "date_from": {
                                        "type": "string",
                                        "format": "date",
                                        "options": {
                                            "flatpickr": {}
                                        }
                                    },
                                    "date_to": {
                                        "type": "string",
                                        "format": "date",
                                        "options": {
                                            "flatpickr": {}
                                        }
                                    },
                                },
                            },
                            "default": []
                        },
                    }
                }
            });
            jseditor.on('ready',() => {
                const eventUid = element.dataset.eventUid ?? null
                const submitButton = document.getElementById('submit-button');
                submitButton?.addEventListener('click', (event) => {
                    event.preventDefault();
                    if (jseditor.validate().length > 0) {
                        Notification.warning('Warning', 'Please fix the validation errors before submitting the Appointment Generation form.');
                    } else {
                        new AjaxRequest(TYPO3.settings.ajaxUrls.surfcamp_events_appointments_generate).post({event: eventUid, data: jseditor.getValue()}, {
                            headers: {
                                'Content-Type': 'application/json; charset=utf-8'
                            }
                        }).then(async function (response) {
                            const responseText = await response.resolve();
                        });
                    }
                });
            });

        }
    }
}

export default EventsManagementModule;
new EventsManagementModule().init();
