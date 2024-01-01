$(document).ready(function() {
    $('#province').change(function() {
        var provinceId = $(this).val();
        if(provinceId) {
            $.ajax({
                url: baseUrl+'AjaxController/getDivisions',
                type: 'GET',
                data: { province_id: provinceId },
                dataType: 'json',
                success: function(data) {
                    $('#division').empty().append('<option value="">Select Division</option>');
                    $.each(data.divisions, function(key, value) {
                        $('#division').append('<option value="'+ value.divisionID +'">'+ value.divisionName +'</option>');
                    });
                    $('#division').prop('disabled', false);
                }
            });
        } else {
            $('#division').empty().change().prop('disabled', true);
        }
    });

    // loading Districts on change of Division
    $('#division').change(function() {
        var divisionId = $(this).val();
        if(divisionId) {
            $.ajax({
                url: baseUrl + 'AjaxController/getDistricts',
                type: 'GET',
                data: { division_id: divisionId },
                dataType: 'json',
                success: function(data) {
                    $('#district').empty().append('<option value="">Select District</option>');
                    $.each(data.districts, function(key, value) {
                        $('#district').append('<option value="' + value.districtID + '">' + value.districtName + '</option>');
                    });
                    $('#district').prop('disabled', false);
                }
            });
        } else {
            $('#district').empty().change().prop('disabled', true);
        }
    });

    // loading Tehsils on change of District
    $('#district').change(function() {
        var districtId = $(this).val();
        if(districtId) {
            $.ajax({
                url: baseUrl + 'AjaxController/getTehsils',
                type: 'GET',
                data: { district_id: districtId },
                dataType: 'json',
                success: function(data) {
                    $('#tehsil').empty().append('<option value="">Select Tehsil</option>');
                    $.each(data.tehsils, function(key, value) {
                        $('#tehsil').append('<option value="' + value.tehsilID + '">' + value.tehsilName + '</option>');
                    });
                    $('#tehsil').prop('disabled', false);
                }
            });
        } else {
            $('#tehsil').empty().change().prop('disabled', true);
        }
    });

    // loading Union Councils on change of Tehsil
    $('#tehsil').change(function() {
        var tehsilId = $(this).val();
        if(tehsilId) {
            $.ajax({
                url: baseUrl + 'AjaxController/getUnionCouncils',
                type: 'GET',
                data: { tehsil_id: tehsilId },
                dataType: 'json',
                success: function(data) {
                    $('#unioncouncil').empty().append('<option value="">Select Union Council</option>');
                    $.each(data.unionCouncils, function(key, uc) {
                        let option = $('<option>', {
                            value: uc.unioncouncilID,
                            text: uc.unioncouncilName,
                            'data-assigned': uc.isAssigned
                        });
                        $('#unioncouncil').append(option);
                    });
                    $('#unioncouncil').prop('disabled', false);
                }
            });
        } else {
            $('#unioncouncil').empty().change().prop('disabled', true);
        }
    });

});