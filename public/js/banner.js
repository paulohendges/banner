var Banner = function(params){
    
    this.numeroSlides = params.numeroSlides;
    
    this.getNumeroSlides = function() {
        return this.numeroSlides;
    }
    this.getHtmlSlide = function(){
        return this.htmlSlide;
    }
    var self = this;
    
    this.renderSlides = function(){
        var htmlSlide =  ""; 
        for(var i = 1; i <= self.getNumeroSlides(); i++){
            htmlSlide += '<fieldset style="margin-top:15px !important">\
                        <legend>Slide '+i+'</legend>\
                            <div class="row">\
                                <div class="input-field col s6">\
                                    <input placeholder="Titulo do Banner" id="titulo'+i+'" name="titulo'+i+'" type="text" class="validate">\
                                    <label for="titulo'+i+'" class="active">Titulo</label>\
                                </div>\
                                <div class="input-field col s6">\
                                    <input placeholder="Subtitulo do Banner" id="subtitulo'+i+'" type="text" name="subtitulo'+i+'" class="validate">\
                                    <label for="subtitulo'+i+'" class="active">Subtitulo</label>\
                                </div>\
                            </div>\
                            <div class="row">\
                                <div class="file-field input-field col s12">\
                                    <div class="btn blue-grey">\
                                        <span>IMAGEM</span>\
                                        <input type="file" name="img'+i+'">\
                                    </div>\
                                    <div class="file-path-wrapper">\
                                        <input class="file-path validate" type="text" name="imgslide'+i+'" placeholder="1280x400">\
                                    </div>\
                                </div>\
                            </div>\
                        </fieldset>';
        }
        return htmlSlide;
    }
}

