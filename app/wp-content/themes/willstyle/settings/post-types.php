<?php 

// カスタム投稿タイプ作成
function create_post_type_blog() {
    $blog = [
      'title',
      'editor',
      'thumbnail',
      'revisions'
    ];
  
    // add post type
    register_post_type( 'blog',
      array(
        'label' => 'ブログ',
        'public' => true,
        'has_archive' => true,
        'menu_position' => 6,
        'supports' => $blog
      )
    );
  
    // add taxonomy
    register_taxonomy(
      'blog-cat',
      'blog',
      array(
        'label' => 'カテゴリー',
        'labels' => array(
          'all_items' => 'カテゴリー一覧',
          'add_new_item' => '新規カテゴリーを追加'
        ),
        'hierarchical' => true
      )
    );
  }
  
add_action( 'init', 'create_post_type_blog' );


