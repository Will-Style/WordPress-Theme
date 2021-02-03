<article class="c-information__list js-scroll-fade" data-trigger>
    <a href="<?php the_permalink();?>" class="c-information__list--link">
        <?php 
            $attach_id = get_post_thumbnail_id(get_the_ID());
            $img = "/dist/img/dummy.jpg";
            if($attach_id):
                $image = wp_get_attachment_image_src($attach_id,"large");
                if(!empty($image[0])):
                    $img = $image[0];
                endif;
            endif;
        ?>
        <div class="c-information__list--img-wrap"><div class="c-information__list--img lazyload" data-bg="<?php echo $img;?>"></div></div>
        <div class="c-information__list--content">
            <h3 class="c-information__list--title"><?php the_title();?></h3>
            <time class="c-information__list--time" datetime="<?php the_time('c');?>"><?php the_time('Y.m.d');?></time>
        </div>
    </a>
</article>