<article class="c-blog__card js-scroll-fade" data-trigger>
    <div class="c-blog__card--link">
        <div class="c-blog__card--content">
            <h3 class="c-blog__card--title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
            <div class="c-blog__card--detail">
                <time class="c-blog__card--time" datetime="<?php the_time("c");?>"><?php the_time("Y/m/d");?></time>
            </div>
        </div>
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
        <a href="<?php the_permalink();?>" class="c-blog__card--img-wrap">
            <div class="c-blog__card--img lazyload" data-bg="<?php echo $img;?>"></div>
        </a>
    </div>
</article>