/*
    I have build the JS for the front end with jQuery, as I feel it is a simple enough example. Perhaps using something
    like Angular or React would be beneficial if this becomes a larger SPA with further features and interactions
*/

function play(game) {
    jQuery.ajax({
        url: '/api/play-' + game,
        dataType: 'json',
        success: function(data) {
            //Get the winning numbers into simple array
            var numbers = data.numbers.map(function(num) {
                return num.number;
            });

            /*
             Output the numbers into the list

             There will be an issue if you have set the winning ball count high enough that the list runs out
             of space. We would need to consider how best to design the UI to handle min/max/mean results if we
             planned on have games with arbitrary large sets
             */

            var row = '' +
                '<li class="list-group-item">' +
                '<span class="badge">' + data.created_at + '</span>' + //obviously will be UTC as thats what the server is set to. If we want to show date in the user's local, we can fiddle with the JS Date() object
                numbers.join('&nbsp;&nbsp;&nbsp;&nbsp;') +
                '</li>';

            jQuery('#' + game + '-list').prepend(row);

            //only show 10 results, so remove superfluous items (:gt is zero indexed)
            jQuery('#' + game + '-list li:gt(9)').remove();
        },
        error: function() {
            jQuery('#' + game + '-error')
                .text('There was a problem getting the numbers')
                .fadeIn()
                .removeClass('hidden');

            setTimeout(function() {
                jQuery('#' + game + '-error').fadeOut();
            }, 5000);
        }
    });

}



jQuery(document).ready(function() {

    jQuery('#play-button').click(function(e) {
        e.preventDefault();

        play('main');
    });

});