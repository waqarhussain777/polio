$(document).ready(function() {
     // loading households on change of Union Council
    $('#unioncouncil').change(function() {
        var selectedOption = $(this).find('option:selected');
        var isAssigned = selectedOption.data('assigned');
        if (isAssigned==0) {
            alert('This Union Council is not assigned to you.');
            $(this).val('').change(); // Reset the dropdown
            return;
        }
        var unionCouncilId = $(this).val();
        if(unionCouncilId) {
            $.ajax({
                url: baseUrl + 'AjaxController/getHouseholds',
                type: 'GET',
                data: { union_council_id: unionCouncilId },
                dataType: 'json',
                success: function(data) {
                    $('#household').empty().append('<option value="">Select Household</option>');
                    $.each(data.households, function(key, household) {
                        // $('#household').append('<option value="' + value.individualhouseholdID + '">' + value.individualhouseholdName + '</option>');
                        var option = $('<option>', {
                            value: household.individualhouseholdID,
                            text: household.individualhouseholdName,
                            'data-already-serviced': household.alreadyServed
                        });
                        $('#household').append(option);
                    });
                    $('#household').prop('disabled', false);
                }
            });
        } else {
            $('#household').empty().change().prop('disabled', true);
        }
    });

    // loading households members on change of Household
    $('#household').change(function() {
        var selectedOption = $(this).find('option:selected');
        var alreadyServiced = selectedOption.data('already-serviced');
        if (alreadyServiced) {
            alert('This household has already been served by another worker.');
            // Reset the dropdown to the default option
            $(this).val('').change();
            return;
        }
        var householdId = selectedOption.val();
        if(householdId) {
            $.ajax({
                url: baseUrl + 'AjaxController/getHouseholdMembers',
                type: 'GET',
                data: { household_id: householdId },
                dataType: 'json',
                success: function(data) {
                    $('#householdmember').empty().append('<option value="">Select Household Member</option>');
                    $.each(data.householdMembers, function(key, value) {
                        $('#householdmember').append('<option value="' + value.householdmemberID + '">' + value.householdmemberName + '</option>');
                    });
                    $('#householdmember').prop('disabled', false);
                }
            });
        } else {
            $('#householdmember').empty().change().prop('disabled', true);
        }
    });
});
