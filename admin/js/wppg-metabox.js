var wppgArrayImagens  = [];
var wppgContentImages = document.getElementById('wppg-content-metabox');
var wppgBtnMidia      = document.getElementById('wppg-button-add-midia');
var wppgBtnSalvar     = document.getElementById('wppg-button-salvar');
var wppgImagens       = document.getElementById('wppg-input-images');

if(wppgImagens && wppgImagens.value){
    wppgContentImages.style.visibility = 'visible';
    if(wppgImagens.value.indexOf(',') >= 0){
        wppgArrayImagens = wppgImagens.value.split(',');
    } else {
        wppgArrayImagens = wppgImagens.value;
    }
} 

wppgBtnMidia.addEventListener('click', function(event) {
   if ( typeof wp !== 'undefined' && wp.media ) {
        var args = {
            title: "Selecione as Imagens para galeria",
            button:{ text: "Adicionar na Galeria" },
            multiple: true,
            type : 'image'
        };

        var frame = wp.media({
            title: "Selecione as wppgImagens para galeria",
            multiple: true,
            button:{ text: "Adicionar a Galeria" },
            library: {
                type: [ 'image' ]
            },
        });

        frame.on('select', function (){
            var state = frame.state();
            var selection = state.get('selection');

            if (!selection) {
                return;
            }

            selection.each(function(attachment) {
                //console.log(attachment.attributes);
                if(attachment.attributes.id) {
                    wppgArrayImagens.push(attachment.attributes.id);
                    renderImageElement(attachment.attributes.id, attachment.attributes.url);
                }
            });

            updateImagensValues();
        });

        frame.on('close', function (){});
        frame.open();
    }
});


function renderImageElement(id, url) {
    var div = document.createElement("div");
        div.setAttribute('id', id);
        div.setAttribute('class', 'col');

    var img = document.createElement("img");
        img.setAttribute('src', url);

    var btn = document.createElement("button");
        btn.setAttribute('type', 'button')
        btn.setAttribute('title', 'Remover')
        btn.setAttribute('onClick', 'removeImageElement('+ id +')')
        btn.innerHTML = '&#10006;';

    div.appendChild(img);
    div.appendChild(btn);
    wppgContentImages.appendChild(div);
}     

function updateImagensValues(){
    wppgImagens.value = wppgArrayImagens.toString();
    
    if(wppgImagens.value !== ''){
        wppgContentImages.style.visibility = 'visible';
    } else {
        wppgContentImages.style.visibility = 'hidden';
    }
}

function removeImageElement(id) {
    console.log(wppgArrayImagens)
    if(document.getElementById(id) !== null) {
        document.getElementById(id).style.opacity = 0;
        document.getElementById(id).style.background = 'red';
        document.getElementById(id).style.transition = '0.5s';

        setTimeout(function() {
            document.getElementById(id).remove();
            wppgArrayImagens.splice(wppgArrayImagens.indexOf(id.toString()), 1);
            updateImagensValues();            
        }, 500);
    }
}
