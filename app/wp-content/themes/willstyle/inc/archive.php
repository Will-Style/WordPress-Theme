<div id="p-information">
    <div class="c-lower__heading class="c-lower">
    <div class="c-lower__main main-information">
        <h1 class="c-lower__title">Information</h1>
    </div>
    <div class="c-lower__contents-inner c-column-archive">
        <div class="container">
            <div class="row justify-content-between js-sticky__wrapper">
                <div class="col-lg-7">
                    <div class="c-information__list--wrapper pb-20">
                        <?php if( have_posts() ) : ?>
                            <?php while( have_posts() ) : the_post();?>
                        
                            <?php include('information-list.php');?>
                            
                            <?php endwhile;?>
                            <?php endif;?>
                        </div>
                            
                        <div class="js-scroll-fade" data-trigger>
                            <?php if(function_exists('wp_pagenavi')) wp_pagenavi(); ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <?php include( 'sidebar.php' ); ?>
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
</div><!-- / #p-information -->