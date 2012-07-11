
// equilivant to the main function
$(document).ready(function() {

    
    setTimeout(function() {
        $("#loader").fadeOut();
    }, 1000);


    $("#uploadForm").ajaxForm({
        
        dataType: "json",
        /*
        beforeSubmit: function(a,f,o) {
                          o.dataType = $('#uploadResponseType')[0].value;
                          $('#uploadOutput').html('Submitting...');
                      },
        */
        success: function(data) {
                    conole.log(data);
                 }
    }); 


});

