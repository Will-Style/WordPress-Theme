<div id="p-blog" class="c-blog__single c-lower">
    <div class="c-lower__main main-blog">
        <h1 class="c-lower__title">Blog</h1>
    </div>
    <div class="c-lower__contents-inner">
        <div class="container">
            <div class="row js-sticky__wrapper">
                <div class="col-lg-8">
                    <div class="c-blog__single--wrapper">
                        <?php 
                            /** $attach_id = get_post_thumbnail_id(get_the_ID());
                            if($attach_id):
                                $image = wp_get_attachment_image_src($attach_id,"large");
                                echo '<div class="c-blog__single--eye-catch"><img src="' . $image[0] . '" /></div>';

                            endif;
                            **/
                        ?>
                        <div class="c-blog__single---heading">
                            <div class="c-blog__single--time">
                                <time aria-label="投稿日:" datetime="<?php the_time('c');?>"><?php the_time('Y.m.d');?></time>
                            </div>		
                            <ul class="c-blog__single--cat" aria-label="カテゴリー:">
                                <li><a href="/blog/">ブログ</a></li>
                                <?php echo order_the_category( $post->ID ,'blog-cat'); ?>
                            </ul>
                                
                        </div>
                    
                        <h2 class="c-blog__single--title">
                        <?php the_title();?>
                        </h2>
                        
                        <div class="c-blog__single--body blog-body">
                            <?php the_content();?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <?php include( 'sidebar.php' ); ?>
                </div>
            </div>
            <div class="js-scroll-fade" data-trigger>
                
                <div class="c-blog__single--bottom">
                    <div class="c-blog__single--pagenavi">
                        <div class="single-pagenavi">
                            <span class="arrow-left"><?php previous_post_link('%link','%title',false); ?></span>                                    
                            <span class="arrow-right"><?php next_post_link('%link','%title',false); ?></span>
                        <!--/ .wp-pagenavi --></div>
                    </div>
                    <div class="c-blog__single--share">
                        <h4 class="c-blog__single--share-title">Share</h4>
                        <div class="share-buttons">
                            <a href="http://twitter.com/share?url=<?php the_permalink();?>&amp;text=<?php the_title();?>" class="btn btn-primary btn-share" data-share-tw>
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" class="btn btn-primary btn-share" data-share-fb>
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="js-scroll-fade" data-trigger>
            <?php breadcrumb(true);?>
        </div>
    </div>
    
</div><!-- / #p-blog -->