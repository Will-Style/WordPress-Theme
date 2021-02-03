
<aside id="l-side">
    <div class="js-sticky__side">
    <h4 class="l-side__title l-side__category--title">Category</h4>
        <div class="l-side__category--list">
            <ul>
                <?php wp_list_categories( 
                    [
                        'orderby'            => 'term_order',
                        'order'              => 'ASC',
                        'style'              => 'list',
                        'hide_empty'         => 1,
                        'title_li'           => __( '' ),
                        'show_option_none'   => __( '' ),
                        'number'             => null,
                    ]
                 ); ?>
            </ul>
            <ul>
                 <li>
                    <a href="/blog/">ブログ</a>
                    <ul>
                        <?php  $blog_cat = get_terms(['taxonomy' => 'blog-cat','orderby' => 'term_order','oeder' => 'ASC']);?>                            
                        <?php foreach ($blog_cat as $key => $term) :?>
                            <li class="l-side__nav--item"><a href="/blog-cat/<?php echo $term->slug;?>/" class="l-side__nav--link"><?php echo $term->name;?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
            </ul>
            <ul>
                 <li>
                    <a href="/pickup/">おすすめアイテム</a>
                    <ul>
                        <?php  $pickup_cat = get_terms(['taxonomy' => 'pickup-cat','orderby' => 'term_order','oeder' => 'ASC']);?>                            
                        <?php foreach ($pickup_cat as $key => $term) :?>
                            <li class="l-side__nav--item"><a href="/pickup-cat/<?php echo $term->slug;?>/" class="l-side__nav--link"><?php echo $term->name;?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="l-side__archive">
            <h4 class="l-side__title l-side__archive--title">Archive</h4>
            <div class="l-side__archive--select mb-40">
                <select onchange="window.location.href=this.value" class="custom-select">
                    <option value="">アーカイブを選択</option>
                    <?php wp_get_archives( 'type=monthly&format=option&post_type=' . get_post_type() ); ?>
                </select>
            </div>
        </div>
    
    </div>
</aside>