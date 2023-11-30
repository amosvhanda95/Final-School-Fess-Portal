function updateFormVisibility(selectedCountryId) {
    if (selectedCountryId === "1") {
        // Show fields for Country A
        $("#rec_first_name_field, #rec_middle_name_field, #rec_surname_field, #rec_email_field").show();
    } else if (selectedCountryId === "2") {
        // Show fields for Country B
        $("#rec_first_name_field, #rec_middle_name_field, #rec_surname_field").show();
        // Hide the email field
        $("#rec_email_field").hide();
    } else {
        // Hide all fields
        $(".form-group[id$=_field]").hide();
    }
}

// Initially, hide all input fields
$(".form-group[id$=_field]").hide();

$(document).ready(function () {
    $("#selectedCountryId").change(function () {
        const selectedCountryId = $(this).val();
        updateFormVisibility(selectedCountryId);
    });
});
