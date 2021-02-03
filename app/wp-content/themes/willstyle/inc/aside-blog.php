<?php $args = ["post_type" => "blog", "posts_per_page" => 4];?>
<?php $q = new WP_Query( $args );?>
<?php if( $q->have_posts() ):?>
    <aside id="l-aside__blog">
        <div class="l-aside__blog--wrapper bg-gray">
            <div class="container">
                <h3 class="l-aside__blog--title c-section__title text-center">Blog</h3>
                <div class="row">
                    <?php while( $q->have_posts() ): $q->the_post();?>
                        <div class="col-lg-3 col-md-6">
                            <?php include('blog-list.php'); ?>
                        </div>
                    <?php endwhile;?>
                </div>

                <div class="l-aside__blog--btn js-scroll-fade" data-trigger>
                    <a href="/blog/" class="btn btn-outline btn-arrow"><span>View more</span></a>
                </div>
            </div>
        </div>
    </aside>
<?php endif;?>
<?php wp_reset_postdata();?>       