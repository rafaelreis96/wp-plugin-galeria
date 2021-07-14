<?php

wp_enqueue_media();

$images = get_post_meta($post->ID, '_wppg_images', true);
$content = get_post_meta($post->ID, '_wppg_content', true);

$arrayIds = !empty($images) ? explode(',', $images) : [];
$argsEditor = array(
        'media_buttons' => false, 
        'textarea_rows' => 5,
        'quicktags'=>false
    );
?>

<div class="wppg-container-metabox">
    <p> <b>Sobre</b> </p>
    <div style="margin-bottom: 16px">
        <?php wp_editor($content, 'wppg_content', $argsEditor); ?>
    </div>
    
    <p>
        <b>Adicione Imagens na Galeria</b>
    </p>
    <button type="button" id="wppg-button-add-midia" class="button">
        Selecionar Imagens
    </button>
    
    <input type="hidden" id="wppg-input-images" name="wppg_images" value="<?= $images ?>"/>

    <div id="wppg-content-metabox" class="wppg-grid-img">
        <?php 
            if(count($arrayIds) > 0) : 
                foreach ($arrayIds as $id) :
        ?>
                <div id="<?=$id?>" class="col">
                    <?= wp_get_attachment_image($id, array(250, 180)); ?>
                    <a role="button" class="wppg-button-remove" title="Remover" onclick="removeImageElement(<?=$id?>)">✖</a>
                </div>
        <?php 
                endforeach;
            endif; 
        ?>
    </div>
</div>