jQuery(document).ready(function($) { 
    tinymce.create('tinymce.plugins.wppg_plugin', {
        init : function(ed, url) {
             ed.addCommand('wppg_insert_shortcode', function() {
                 selected = tinyMCE.activeEditor.selection.getContent();

                 if( selected ){
                     content =  '[wppg-galeria]'+selected+'[/wppg-galeria]';
                 }else{
                     content =  '[wppg-galeria]';
                 }

                 $('.thickbox').trigger( "click" );
                 loadPosts();

                 tinymce.execCommand('mceInsertContent', false, content);
             });

            ed.addButton('wppg_button', {
               title : 'Adicionar Galeria',
               class: 'thickbox',
               cmd : 'wppg_insert_shortcode', 
               image: url + '/gallery.png'
            });
        },   
   });

   tinymce.PluginManager.add('wppg_button', tinymce.plugins.wppg_plugin);

abrirModalListaGalerias();

   function abrirModalListaGalerias() {

      var galerias = ['Galeria 1', 'Galeria 2', 'Galeria 3'];

      var html = '<div id="modal-lista-galerias" style="display:none;">';
          
          html += '<p>Selecione a Galeria</p>';
          html += '<select style="width: 100%">';
            for(var i=0; i<galerias.length; i++) {
                html += '<option>' + galerias[i] + '</option>';
            }  
          html += '</select>';
          html += '<button type="button" class="button button-primary">Adicionar</button>';
          html += '</div>';
          html += '<a href="#TB_inline?&width=600&height=550&inlineId=modal-lista-galerias" class="thickbox"></a>';   
      
      $('body').append(html);
   }


   function loadPosts() {
      const url = window.location.hostname + '/wp/v2/posts';
      console.log(window.location.hostname )

      $.getJSON(url, function(data) {
       
        console.loog("POSTS");
        console.log(data);
       
      }).fail(function() {
         alert("Falha em recuperar galerias");
      });
   }

});