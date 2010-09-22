$('#poll_vote_button').click(function(event){

    var value = $('input:radio[name=data[vote]]:checked').val();

    if( value !== undefined ){
        $.post( "poll/polls/vote", { answer_id: value },
            function(data){
                $("#poll-structure").html(data);
            }
        );

    }

    event.preventDefault();
});