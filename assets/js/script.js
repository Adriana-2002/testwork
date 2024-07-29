$(document).ready(function() {
    $('#calculationForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'calculate.php',
            data: $(this).serialize(),
            success: function(response) {
                $('#result').html(response);
            },
            error: function() {
                $('#result').html('Error when executing the request.');
            }
        });
    });
});
