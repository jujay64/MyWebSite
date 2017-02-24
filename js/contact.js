$(function() {
    //langue courante définie
    $lang = $("#hdn_locale").val();
    // load the modal window
    $('a.contactForm').click(function(){
        // scroll to top
        $('html, body').animate({scrollTop:0}, 'fast');
        //show the mask and contact divs
        $('#mask').show().fadeTo('', 0.7);
        $('div#main-container').fadeIn();
        // stop the modal link from doing its default action
        return false;
    });
    // close the modal window is close div or mask div are clicked.
    $('div#close, div#mask , a.closeForm').click(function() {
        $('div#main-container, div#mask, .formError').stop().fadeOut('slow');
        return false;
    });

    //ajout des styles pour le formulaire de contact
    $('#contact-form').jqTransform();

    $("button").click(function(){

        $(".formError").hide();

    });

    var use_ajax=true;
    $.validationEngine.settings={};
    if($lang == 'FR'){
        $.validationEngineLanguage.newLang();
    }

    $("#contact-form").validationEngine({
        inlineValidation: false,
        promptPosition: "centerRight",
        success :  function(){use_ajax=true},
        failure : function(){use_ajax=false;}
    })

    $("#contact-form").submit(function(e){

        if(!$('#subject').val().length)
        {
            if($lang == 'FR'){
                $.validationEngine.buildPrompt(".jqTransformSelectWrapper","* Ce champ est requis","error");
            } else
            {
                $.validationEngine.buildPrompt(".jqTransformSelectWrapper","* This field is required","error");
            }
            return false;
        }

        if(use_ajax)
        {
            $('#loading').css('visibility','visible');
            $.post('scripts/submit.php',$(this).serialize()+'&ajax=1',
                   function(data){
                if(parseInt(data)==-1)
                    if($lang == 'FR'){
                        $.validationEngine.buildPrompt("#captcha","* Le calcul est incorrect!","error");
                    } else
                    {
                        $.validationEngine.buildPrompt("#captcha","* Wrong verification number!","error");
                    }
                else{
                    if($lang == 'FR'){
                        $("#contact-form").hide('slow').after('<h1>Merci!</h1>');
                    } else
                    {
                        $("#contact-form").hide('slow').after('<h1>Thank you!</h1>');
                    }
                }

                $('#loading').css('visibility','hidden');

            }


                  );
        }
        e.preventDefault();
    })

});
