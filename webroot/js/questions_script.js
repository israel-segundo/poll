
$(document).ready(function(){

    $("#PollAdminAddForm").validate();

    // Add answer textbox
    $('#add_answer').click(function(event){

        // We are not interested in a certain index, just one random index for cake processing
        // This sucks as hell!
        var rand = 1 + Math.floor(Math.random() * 30);

        var li            = $('<li></li>').addClass('answer-element');
        var delete_button = $('<a></a>')
                .addClass('delete_button')
                .text('Eliminar')
                .attr('href', '/suicidas')
                .click(function(event){
                    $(this).parent().remove();
                    event.preventDefault();
                });

        var input = $('<input>')
                         .attr('type', 'text')
                         .attr('size', 40)
                         .attr('name', 'data[PollNewAnswers]['+ rand +'][answer]')
                         .addClass('required');


        li.append(input)
          .append('&nbsp;')
          .append(delete_button);
          
        $('#answers-list').append(li);

        event.preventDefault();
    });

    // Delete answer
    $('.delete_button').click(function(event){

//        if( $('#answers-list').children('li').length > 2 ){
//            $(this).parent().remove();
//        }else{
//            alert('The poll must have at least two answers');
//        }
        
        $(this).parent().remove();
        event.preventDefault();
    });

});


