<div id="p-blog">
    <div class="c-lower__heading class="c-lower">
    <div class="c-lower__main main-blog">
        <h1 class="c-lower__title">Blog</h1>
    </div>
    <div class="c-lower__contents-inner c-column-archive">
        <div class="container">
            <div class="row">
                    
                <?php if( have_posts() ) : ?>
                    <?php while( have_posts() ) : the_post();?>
                    
                        <div class="col-lg-4 col-md-6">
                            <?php include('blog-list.php');?>
                        </div>

                    <?php endwhile;?>
                <?php endif;?>
                    
            </div>

            <div class="js-scroll-fade" data-trigger>
                <?php if(function_exists('wp_pagenavi')) wp_pagenavi(); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="js-scroll-fade" data-trigger>
            <?php breadcrumb(true);?>
        </div>
    </div>
</div><!-- / #p-information -->