
$(function(){
    // Or with jQuery
    $('.carousel.carousel-slider').carousel({
      fullWidth: true,
      indicators: true
    });
    
    // criação do banner
    $("#definir-banner").click(function(){
        $("#div-slides").html("");
        $("#div-banner").hide();
        var numSlides = $("#numero-slides");
        if(jQuery.inArray(numSlides.val().toString(), ["1", "2", "3"]) < 0){
            alert("Valor inválido para definição");
            numSlides.focus();
            numSlides.val("");
            numSlides = numSlides.val();
        }
        var banner = new Banner({
            numeroSlides : numSlides.val()
        });
        var htmlSlide = banner.renderSlides();
        $("#div-banner").show();
        $("#div-slides").html(htmlSlide);
        $("#div-numero-slides").hide();
   });
   
   // submit do banner
    $("#formBanner").validate({
        rules: {
            titulo1: {
                required: true,
            },
            titulo2: {
                required: true,
            },
            titulo3: {
                required: true,
            },
            imgslide1: {
                required: true,
            },
            imgslide2: {
                required: true,
            },
            imgslide3: {
                required: true,
            }
        },
        messages: {
            titulo1: "Título do Slide obrigatório",
            titulo2: "Título do Slide obrigatório",
            titulo3: "Título do Slide obrigatório",
            imgslide1: "Imagem do Slide obrigatória",
            imgslide2: "Imagem do Slide obrigatória",
            imgslide3: "Imagem do Slide obrigatória"
        },
        unhighlight: function(element) {
            $(element).closest('div').find("p.alerta-erro").remove();
            $(element).closest('fieldset').removeClass('error-field');
            $(element).closest('fieldset').find('legend').removeClass('red-text');
        },
        errorPlacement: function(error, element) {
            if($(element).closest('div').find('p.alerta-erro').length == 0) {
                var erro = '<p class="red-text alerta-erro">' + error.text() + '</p>';
                $(element).closest('div').append(erro);
            }
            
            $(element).closest('fieldset').addClass('error-field');
            $(element).closest('fieldset').find('legend').addClass('red-text');
        },
        submitHandler: function (form) {
            $(form).find('button[type="submit"]').html("verificando...").attr("disabled", "disabled");
            form.submit();

        }
    });
});
