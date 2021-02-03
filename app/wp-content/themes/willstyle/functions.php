<?php
global  $settings;
		$settings = array(
                  'POP3(受信)サーバ' => '',
     			  'SMTP(送信)サーバ' => '',
     			  'メールアカウント' => 'info@ google@ support＠',
     			  'パスワード'=>'',
     			  'Googleアナリティクス' => 'https://www.google.com/analytics/web/',
     			  'アナリティクスアカウント' => 'google@',
     			  'アナリティクスパスワード'=>''
);


define('ROOT','/');

include('settings/mwform.php');
include('settings/post-types.php');

class WillStyleCore{
	
	const ANALYTICS = '';

	/**
	 * [site_title description]
	 * @return [type] [description]
	 */
	public function site_title(){
	?>
<title><?php echo str_replace("&#8211;", "-", wp_get_document_title());?></title>
<?php
	}
	/**
	 * [get_description description]
	 * @return [type] [description]
	 */
	public function description(){
		global $post;
		if ( is_single() ) :
	 		if ($post->post_excerpt) : ?>
<meta name="description" content="<? echo $post->post_excerpt; ?>" />
<?php else :$summary = strip_tags($post->post_content);

$summary = trim($summary);
$summary = preg_replace('/[\n\r\t]/', '', $summary);
$summary = preg_replace('/\s(?=\s)/', '', $summary);
$summary = mb_substr($summary, 0, 120). "..."; ?>
<meta name="description" content="<?php echo $summary; ?>" />
<?php endif; ?>
<?php else :?>
<meta name="description" content="<?php echo str_replace("&#8211;", "-", wp_get_document_title()) . " | "; ?><?php bloginfo('description'); ?>" />
<?php endif; 

    }	
    
	public function ga(){
        if(self::ANALYTICS != ""):?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo self::ANALYTICS;?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            window.GA_MEASUREMENT_ID = "<?php echo self::ANALYTICS;?>"
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo self::ANALYTICS;?>');
        </script><?php
        endif;
	}
}

function strim($str,$size=200,$end="...") {
	$str = preg_replace('/[\n\r\t]/', '', $str);
	$str = preg_replace('/\s(?=\s)/', '', $str);
	$str = mb_strimwidth(esc_html(strip_tags($str)),0,$size,$end,'utf-8');
	return $str;
}
/**
 * 削除項目
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'feed_links_extra', 3);

remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');

function disable_emoji() {
     remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
     remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
     remove_action( 'wp_print_styles', 'print_emoji_styles' );
     remove_action( 'admin_print_styles', 'print_emoji_styles' );    
     remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
     remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );    
     remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emoji' );

add_action( 'init', 'auto_update_willstyle' );

function auto_update_willstyle(){

	add_filter( 'allow_minor_auto_core_updates', '__return_true' );	
	// メジャーアップグレードの自動更新を有効化
	add_filter( 'allow_major_auto_core_updates', '__return_true' );
	 
	// プラグインの自動更新を有効化
	add_filter( 'auto_update_plugin', '__return_true' );
}

function always_return_false_for_vcs( $checkout, $context ) {
    return false;
}
add_filter( 'automatic_updates_is_vcs_checkout', 'always_return_false_for_vcs', 10, 2 );

function register_jquery() {
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-migrate');
   
}
add_action('wp_enqueue_scripts', 'register_jquery'); 

add_editor_style('editor-style.css');
function custom_editor_settings( $initArray ){
	$initArray['body_class'] = 'editor-area'; 
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );
/**
 * func
 */
/**
 * 画像のURLからattachemnt_idを取得する
 *
 * @param string $url 画像のURL
 * @return int attachment_id
 */
function get_attachment_id($url)
{
  	global $wpdb;
	$sql = "SELECT ID FROM {$wpdb->posts} WHERE guid = %s";
	$post_name = $url;
	$id = (int)$wpdb->get_var($wpdb->prepare($sql, $post_name));

	if($id == 0)
	{
		$sql = "SELECT ID FROM {$wpdb->posts} WHERE post_name = %s";
		preg_match('/([^\/]+?)(-e\d+)?(-\d+x\d+)?(\.\w+)?$/', $url, $matches);
		$post_name = $matches[1];
		$id = (int)$wpdb->get_var($wpdb->prepare($sql, $post_name));
	}
  	return $id;
}
/**
 * 画像のURLのサイズ違いのURLを取得する
 * 
 * @param string $url 画像のURL
 * @param string $size 画像のサイズ (thumbnail, medium, large or full)
 */ 
function get_attachment_image_src($url, $size) 
{
	// $image = array();
	$image = wp_get_attachment_image_src(get_attachment_id($url), $size);
	if(is_array($image))
	{
			return $image[0];
	}else{
			return $url;
	}
}
 

function catch_that_image($meta = null, $size = "large") 
{
    global $post, $posts;
    $first_img = '';

    if(!empty($meta)&&is_string($meta)){
    	$image = get_post_meta($post->ID,$meta,true);
    	if(!empty($image)){
    		$metas = get_post_meta($post->ID,$meta,false);
    		foreach($metas as $val){
    			$first_img =  wp_get_attachment_image_src($val,$size)[0];
    			// if(!empty($first_img)){
    			// 	$first_img = get_attachment_image_src($first_img, $size);
    			// }
    			break;
    		}
    	}
	}
	if(!empty($meta)&&is_array($meta)){
		foreach($meta as $value){
			$image = get_post_meta($post->ID,$value,true);
	    	if(!empty($image)){
	    		$metas = get_post_meta($post->ID,$value,false);
	    		foreach($metas as $val){
	    			$first_img = wp_get_attachment_image_src($val, $size);
	    			$first_img = $first_img[0];
	    			if(!empty($first_img)){
	    				$first_img = get_attachment_image_src($first_img, $size);
	    			}
	    			break;
	    		}
	    	}
		}
	}

    if(empty($first_img))
	{
		$thumbnail_id = get_post_thumbnail_id();
		$first_img = wp_get_attachment_image_src( $thumbnail_id );
		$first_img = $first_img[0];
		if(!empty($first_img)){
			$first_img = get_attachment_image_src($first_img, $size);
		}
	}

	if(empty($first_img))
	{ 	
	    ob_start();
	    ob_end_clean();
	    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	    $cnt = 0;
		foreach( $matches[1] as $key => $value)
		{
			if(!preg_match('/plugins/',$value) )
			{
				if($cnt < 1)
				{
					$first_img = $value; $cnt++;
					$first_img = preg_replace('/(-\d+x\d+)/','',$first_img);
					$thumb_img = get_attachment_image_src($first_img, $size);	
					if(!empty($thumb_img))  $first_img = $thumb_img;
				}
			}	
					
		}
	}
	if(empty($first_img))
	{ 
		//Defines a default image
    	$first_img = esc_url(home_url('/assets/img/')) . 'dummy.jpg';
   	}

	return $first_img;
}


function disable_visual_editor_in_page(){
	global $typenow;
	if( $typenow == 'page' ){
		add_filter('user_can_richedit', 'disable_visual_editor_filter');
	}
	if( $typenow == 'mw-wp-form' ){
		add_filter('user_can_richedit', 'disable_visual_editor_filter');
	}
}
function disable_visual_editor_filter(){
	return false;
}
add_action( 'load-post.php', 'disable_visual_editor_in_page' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );

function disable_autosave() {
	wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'disable_autosave' );

function remove_admin_menus() {
    
    // level10以外のユーザーの場合
    if (!current_user_can('level_10')) {
 
        global $menu;
        global $submenu;
        unset($menu[20]);       // 固定ページ
        unset($menu[25]);       // コメント
        unset($menu[60]);       // 外観
        unset($menu[65]);       // プラグイン
        unset($menu[70]);       // ユーザー
        unset($menu[75]);       // ツール
        unset($menu[80]);       // 設定
        // unset($menu["80.026"]);
        // remove_submenu_page('edit.php','edit-tags.php?taxonomy=category');
        // remove_submenu_page('edit.php','edit-tags.php?taxonomy=post_tag');
        // remove_submenu_page('edit.php?post_type=blog','edit-tags.php?taxonomy=blog-cat&amp;post_type=blog');
    }
}
add_action('admin_menu', 'remove_admin_menus');

function remove_dashboard_widget() {
    remove_action( 'welcome_panel','wp_welcome_panel' ); // ようこそ
    
    remove_meta_box( 'dashboard_site_health' , 'dashboard', 'normal'); // サイトヘルス
 	// remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
 	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ
    remove_meta_box( 'semperplugins-rss-feed' , 'dashboard', 'normal'); // SEO 最新情報
 	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
 	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress イベントとニュース
} 
add_action('wp_dashboard_setup', 'remove_dashboard_widget' );

function delete_column($columns) {
    unset($columns['author']);
    unset($columns['tags']);
    unset($columns['comments']);
    return $columns;
}
add_filter( 'manage_posts_columns', 'delete_column');



/***********************************************************
* 投稿画面の項目を非表示
***********************************************************/
function remove_default_post_screen_metaboxes() {
    remove_meta_box( 'postcustom','post','normal' ); // カスタムフィールド
    remove_meta_box( 'postexcerpt','post','normal' ); // 抜粋
    remove_meta_box( 'commentstatusdiv','post','normal' ); // ディスカッション
    remove_meta_box( 'commentsdiv','post','normal' ); // コメント
    remove_meta_box( 'trackbacksdiv','post','normal' ); // トラックバック
    remove_meta_box( 'authordiv','post','normal' ); // 作成者
    remove_meta_box( 'slugdiv','post','normal' ); // スラッグ
    remove_meta_box( 'revisionsdiv','post','normal' ); // リビジョン
    remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'side' ); // 投稿のタグ
}
add_action('admin_menu','remove_default_post_screen_metaboxes');

class willstyleManuals{

	public function __construct(){
		add_action('admin_menu', array($this,'create_menu_page'));
	}
	/**
	 * [create_options_page description]
	 * @return [type] [description]
	 */
    public function create_menu_page() {
       add_menu_page('マニュアル', '操作マニュアル', 1, __FILE__, array($this,'manual_page_fn'));
    }
    /**
     * [manual_page_fn description]
     * @return [type] [description]
     */
    public function manual_page_fn(){
    	global $settings;
    	?>
		 <div class="wrap">
			<h2 style="margin-bottom:20px">操作マニュアル</h2>
			<div style="margin-bottom:30px;">
				<table class="wp-list-table widefat fixed users">
					<tbody>
						<tr>
							<td>
								<p>基本的な操作マニュアルです。</p>
								<p>その他ご不明な点は</p>
								<p>
									<span style="font-size:20px">
										<a href="mailto:info@willstyle.co.jp">info@willstyle.co.jp</a>
									</span>までご連絡ください。</p>
								<p>
									<a href="http://willstyle.co.jp/manuals/" class="button button-primary button-hero" target="_blank">
										操作マニュアル
									</a>
								</p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<h2 style="margin-bottom:20px">各種情報</h2>
			<table class="wp-list-table widefat fixed users">
				<tbody>
					<?php foreach($settings as $key => $value) :?>
					<?php if(preg_match("/^(?:http|https):\/\/[\w,.:;&=+*%$#!?@()~\'\/-]+$/",$value)): ?>
					<tr>
						<th style="border-bottom:1px solid #ddd" width="30%"><?php echo esc_html($key);?></th>
						<td style="border-bottom:1px solid #ddd"><a href="<?php echo esc_html($value);?>" target="_blank"><?php echo esc_html($value);?></a></td>
					</tr>
					<?php else: ?>
					<tr>
						<th style="border-bottom:1px solid #ddd" width="30%"><?php echo esc_html($key);?></th>
						<td style="border-bottom:1px solid #ddd"><?php echo esc_html($value);?></td>
					</tr>
					<?php endif;?>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
    	<?php
    }

}
new willstyleManuals;

function breadcrumb($echo=false,$args = array()){
	global $post;
	$str ='';
	$defaults = array(
		'id' => "breadcrumb",
		'class' => "",
		'home' => "Home",
		'search' => "で検索した結果",
		'tag' => "",
		'author' => "投稿者",
		'notfound' => "404 Not found",
		'separator' => ''
	);
	$args = wp_parse_args( $args, $defaults );
	extract( $args, EXTR_SKIP );

	if(!is_home()&&!is_admin()) { 
	//!is_admin は管理ページ以外という条件分岐
		$str.= '<div id="'. $id .'" class="c-breadcrumb">';
		$str.= '<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';
		$str.= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. home_url() .'/"><span itemprop="name">'. $home .'</span></a></li>';
		$my_taxonomy = get_query_var('taxonomy');  //[taxonomy] の値（タクソノミーのスラッグ）
		$cpt = get_query_var('post_type');   //[post_type] の値（投稿タイプ名）
		if($my_taxonomy &&  is_tax($my_taxonomy)){
			//カスタム分類のページ
			$my_tax = get_queried_object();  //print_r($my_tax);
			$post_types = get_taxonomy( $my_taxonomy )->object_type;
			$cpt = $post_types[0];  //カスタム分類名からカスタム投稿名を取得。
			$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' .get_post_type_archive_link($cpt).'"><span itemprop="name">'. get_post_type_object($cpt)->label.'</span></a></li>';  //カスタム投稿のアーカイブへのリンクを出力
		if($my_tax -> parent != 0) {  
			//親があればそれらを取得して表示
			$ancestors = array_reverse(get_ancestors( $my_tax -> term_id, $my_tax->taxonomy ));
			foreach($ancestors as $ancestor){
				$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_term_link($ancestor, $my_tax->taxonomy) .'"><span itemprop="name">'. get_term($ancestor, $my_tax->taxonomy)->name .'</span></a></li>';
			}
		}
	$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $my_tax -> name . '</span></li>'; 

	}elseif(is_category()) {  
	//カテゴリーのアーカイブページ
		$cat = get_queried_object();
		if($cat -> parent != 0){
			$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
			foreach($ancestors as $ancestor){
				$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_category_link($ancestor) .'"><span itemprop="name">'. get_cat_name($ancestor) .'</span></a></li>'; 
			}
		}
		$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $cat -> name . '</span></li>'; 
	}elseif(is_post_type_archive()) {  //カスタム投稿のアーカイブページ
		$cpt = get_query_var('post_type');
		$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. get_post_type_object($cpt)->label . '</span></li>'; 
	}elseif($cpt && is_singular($cpt)){  //カスタム投稿の個別記事ページ
		$taxes = get_object_taxonomies( $cpt  );
		$mytax = $taxes[0];  
		$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' .get_post_type_archive_link($cpt).'"><span itemprop="name">'. get_post_type_object($cpt)->label.'</span></a></li>';  //カスタム投稿のアーカイブへのリンクを出力
		$taxes = get_the_terms($post->ID, $mytax); 
		if($taxes){
			$tax = $taxes[0];  //print_r($tax);
			if($tax -> parent != 0){
				$ancestors = array_reverse(get_ancestors( $tax -> term_id, $mytax ));
				foreach($ancestors as $ancestor){
					$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_term_link($ancestor, $mytax).'"><span itemprop="name">'. get_term($ancestor, $mytax)->name . '</span></a></li>';            
				}
			}
			$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_term_link($tax, $mytax).'"><span itemprop="name">'. $tax -> name . '</span></a></li>';  	
		}
		$str.= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span></li>';
	}elseif(is_single()){  //個別記事ページ
		$categories = get_the_category($post->ID);
		$cat = get_youngest_cat($categories);
		if($cat -> parent != 0){
			$ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
			foreach($ancestors as $ancestor){
				$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_category_link($ancestor).'"><span itemprop="name">'. get_cat_name($ancestor). '</span></a></li>';
			}
		}
		$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_category_link($cat -> term_id). '"><span itemprop="name">'. $cat-> cat_name . '</span></a></li>';
		$str.= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span></li>';
	} elseif(is_page()){  //固定ページ
		if($post -> post_parent != 0 ){
			$ancestors = array_reverse(get_post_ancestors( $post->ID ));
			foreach($ancestors as $ancestor){
				$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_permalink($ancestor).'"><span itemprop="name">'. get_the_title($ancestor) .'</span></a></li>';
			}
		}
		$str.= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span></li>';
	} elseif(is_date()){  //日付ベースのアーカイブページ
		if(get_query_var('day') != 0){  //年別アーカイブ
			$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_year_link(get_query_var('year')). '"><span itemprop="name">' . get_query_var('year'). '年</span></a></li>';
			$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '"><span itemprop="name">'. get_query_var('monthnum') .'月</span></a></li>';
			$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. get_query_var('day'). '日</span></li>';
		} elseif(get_query_var('monthnum') != 0){  //月別アーカイブ
			$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'. get_year_link(get_query_var('year')) .'"><span itemprop="name">'. get_query_var('year') .'年</span></a></li>';
			$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. get_query_var('monthnum'). '月</span></li>';
		} else {  //年別アーカイブ
			$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. get_query_var('year') .'年</span></li>';
		}
	} elseif(is_search()) {  //検索結果表示ページ
		$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">「'. get_search_query() .'」'. $search .'</span></li>';
	} elseif(is_author()){  //投稿者のアーカイブページ
		$str .='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $author .' : '. get_the_author_meta('display_name', get_query_var('author')).'</span></li>';
	} elseif(is_tag()){  //タグのアーカイブページ
		$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $tag .' : '. single_tag_title( '' , false ). '</span></li>';
	} elseif(is_attachment()){  //添付ファイルページ
		$str.= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. $post -> post_title .'</span></li>';
	} elseif(is_404()){  //404 Not Found ページ
		$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.$notfound.'</span></li>';
	} else{  //その他
		$str.='<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'. wp_title('', true) .'</span></li>';
	}
		$str.='</ol>';
		$str.='</div>';
	}
	if($echo){
		echo $str;
	}else{
		return $str;
	}
}

add_shortcode("breadcrumb","breadcrumb");



function get_youngest_cat($categories){
  global $post;
  if(count($categories) == 1 ){
    $youngest = $categories[0];
  }
  else{
    $count = 0;
     foreach($categories as $category){  //それぞれのカテゴリーについて調査
        $children = get_term_children( $category -> term_id, 'category' );  //子カテゴリーの ID を取得
      if($children){  //子カテゴリー（の ID ）が存在すれば
        if ( $count < count($children) ){  //子カテゴリーの数が多いほど、そのカテゴリーは階層が下なのでそれを元に調査するかを判定
          $count = count($children);  //$count に子カテゴリーの数を代入
          $lot_children = $children;
          foreach($lot_children as $child){  //それぞれの「子カテゴリー」について調査 $childは子カテゴリーのID
            if( in_category( $child, $post -> ID ) ){  //現在の投稿が「子カテゴリー」のカテゴリーに属するか
              $youngest = get_category($child);  //属していればその「子カテゴリー」が一番若い（一番下の階層）
              }
            }
          }
        }
      else{  //子カテゴリーが存在しなければ
        $youngest = $category;  //そのカテゴリーが一番若い（一番下の階層）
      }
    }
  }
  return $youngest;
}

//一番下の階層のタクソノミーを返す関数
function get_youngest_tax($taxes, $mytaxonomy){
	global $post;
	if(count($taxes) == 1 ){
  		$youngest = $taxes[key($taxes)];
	}
  	else{
     $count = 0;
    foreach($taxes as $tax){  //それぞれのタクソノミーについて調査
      $children = get_term_children( $tax -> term_id, $mytaxonomy );  //子タクソノミーの ID を取得
      if($children){  //子カテゴリー（の ID ）が存在すれば
        if ( $count < count($children) ){  //子タクソノミーの数が多いほど、そのタクソノミーは階層が下なのでそれを元に調査するかを判定
          $count = count($children);  //$count に子タクソノミーの数を代入
          $lot_children = $children;
          foreach($lot_children as $child){  //それぞれの「子タクソノミー」について調査 $childは子タクソノミーのID
            if( is_object_in_term( $post -> ID, $mytaxonomy ) ){  //現在の投稿が「子タクソノミー」のタクソノミーに属するか
              $youngest = get_term($child, $mytaxonomy);  //属していればその「子タクソノミー」が一番若い（一番下の階層）
            }
          }
        }
      }
      else{  //子タクソノミーが存在しなければ
        $youngest = $tax;  //そのタクソノミーが一番若い（一番下の階層）
      }
    }
  }
  return $youngest;
}

function get_youtube_url( $url ){
	$return_url = '//www.youtube.com/embed/';
	$id = '';
		if(preg_match('/embed/',$url)):
			$return_url = $url;
		else: 
			$id = preg_replace('/.*v=([\d\w]+).*/', '$1', $url);
		endif;

	return $return_url . $id . '?showinfo=0&rel=0&controls=0&iv_load_policy=3';
}

function get_ogp_img(){
	global $post;
	$img = home_url('/').'dist/ico/ogp.jpg';
	if(!is_home()&&is_single()){
		the_post();
		$img = catch_that_image('slide-image');
	}
	return $img;
}

add_filter( 'document_title_separator', 'my_document_title_separator' );
function my_document_title_separator( $sep ) {
  $sep = '|';
  return $sep;
}

add_filter( 'document_title_parts', 'custom_title', 10, 1 );

function custom_title ( $title ) {
	global $post;
	$title['tagline'] = '';
	if(!is_home()&&!is_admin()) { 
		$my_taxonomy = get_query_var('taxonomy');  //[taxonomy] の値（タクソノミーのスラッグ）
		$cpt = get_query_var('post_type');   //[post_type] の値（投稿タイプ名）
		if($my_taxonomy &&  is_tax($my_taxonomy)){
			//カスタム分類のページ
			$my_tax = get_queried_object();  //print_r($my_tax);
			$post_types = get_taxonomy( $my_taxonomy )->object_type;
			$cpt = $post_types[0];  //カスタム分類名からカスタム投稿名を取得。
			$str.='｜'. get_post_type_object($cpt)->label;  //カスタム投稿のアーカイブへのリンクを出力
			if($my_tax -> parent != 0) {  
				//親があればそれらを取得して表示
				$ancestors = (get_ancestors( $my_tax -> term_id, $my_tax->taxonomy ));
				foreach($ancestors as $ancestor){
				$str.= '｜'. get_term($ancestor, $my_tax->taxonomy)->name;
			}
		}
		$str.= '｜'. $my_tax -> name; 

		}elseif(is_category()) {  
		//カテゴリーのアーカイブページ
			$cat = get_queried_object();
			if($cat -> parent != 0){
				$ancestors = (get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.= '｜'. get_cat_name($ancestor) ; 
				}
			}
			$str.= '｜'. $cat -> name; 
		}elseif(is_post_type_archive()) {  //カスタム投稿のアーカイブページ
			$cpt = get_query_var('post_type');
			$str.= '｜'. get_post_type_object($cpt)->label; 
		}elseif($cpt && is_singular($cpt)){  //カスタム投稿の個別記事ページ
			$taxes = get_object_taxonomies( $cpt  );
			$mytax = $taxes[0];  
			$str.= $post -> post_title;
			$taxes = get_the_terms($post->ID, $mytax); 
			if($taxes){
				$tax = get_youngest_tax($taxes, $mytax );  //print_r($tax);
				if($tax -> parent != 0){
					$ancestors = (get_ancestors( $tax -> term_id, $mytax ));
					foreach($ancestors as $ancestor){
						$str.='｜'. get_term($ancestor, $mytax)->name;            
					}
				}
				$str.='｜'. $tax -> name ; 
			}
			$str.= '｜'. get_post_type_object($cpt)->label;  //カスタム投稿のアーカイブへのリンクを出力
			
		}elseif(is_single()){  //個別記事ページ
			$categories = get_the_category($post->ID);
			$cat = get_youngest_cat($categories);
			
			$str.=  $post -> post_title;
			
			$str.='｜'. $cat-> cat_name;
			if($cat -> parent != 0){
				$ancestors = (get_ancestors( $cat -> cat_ID, 'category' ));
				foreach($ancestors as $ancestor){
					$str.='｜'. get_cat_name($ancestor);
				}
			}
		} elseif(is_page()){  //固定ページ

			$str.= $post -> post_title;
			if($post -> post_parent != 0 ){
				$ancestors = (get_post_ancestors( $post->ID ));
				foreach($ancestors as $ancestor){					
					if(get_page_uri( $ancestor )!="english"){
						$str.= '｜'. get_the_title($ancestor);
					}
				}
			}

		} elseif(is_date()){  //日付ベースのアーカイブページ
			if(get_query_var('day') != 0){  //年別アーカイブ
				$str.= get_query_var('year'). '年';
				$str.= get_query_var('monthnum') .'月';
				$str.= get_query_var('day'). '日';
			} elseif(get_query_var('monthnum') != 0){  //月別アーカイブ
				$str.= get_query_var('year') .'年';
				$str.=  get_query_var('monthnum'). '月';
			} else {  //年別アーカイブ
				$str.=  get_query_var('year') .'年';
			}
		} elseif(is_search()) {  //検索結果表示ページ
			$str.='「'. get_search_query() .'」'. $search;
		} elseif(is_author()){  //投稿者のアーカイブページ
			$str .= '｜'. $author .' : '. get_the_author_meta('display_name', get_query_var('author'));
		} elseif(is_tag()){  //タグのアーカイブページ
			$str.= '｜'. $tag .' : '. single_tag_title( '' , false );
		} elseif(is_attachment()){  //添付ファイルページ
			$str.=  '｜'. $post -> post_title ;
		} elseif(is_404()){  //404 Not Found ページ
			$str.= '｜'.$notfound;
		} else{  //その他
			$str.= '｜'. wp_title('', true) ;
		}
		$title['title'] = ltrim( $str , "｜");
	}
	
	return $title;

}

if ( !is_admin() ) {
	if ( !function_exists( 'mytheme_init' ) ) {
		add_action( 'init', 'mytheme_init' );
		function mytheme_init() {
			define( 'IFRAME_REQUEST', 1 );
		}
	}
}


function the_category_single( $id , $taxonomy = 'category' ,$parent = null){
	$html = "";
	$args = array('orderby' => 'id', 'order' => 'ASC');
	$terms = wp_get_object_terms( $id, $taxonomy, $args);
	if(!empty($terms)){
  		if(!is_wp_error( $terms )){
			foreach($terms as $term){
				if($term->term_id !== $parent):
					$html .= '<span class="badge badge-primary">' . esc_html( $term->name )  . '</span>';
					break;
				endif;
			}
			if($html == ""){
				foreach($terms as $term){
					$html .= '<span class="badge badge-primary">' . esc_html( $term->name )  . '</span>';
					break;
				}
			}
		}
	}
	return $html;
}



function order_the_category( $id , $taxonomy = 'category'){
	$html = "";
	$args = array('orderby' => 'term_order', 'order' => 'ASC');
	$terms = wp_get_object_terms( $id, $taxonomy, $args);
	if(!empty($terms)){
  		if(!is_wp_error( $terms )){
			foreach($terms as $term){
				
				$html .= '<li><a href="' . get_category_link($term->term_id) . '">' . esc_html( $term->name )  . '</a></li>';
				
			}
		}
	}
	return $html;
}

function get_the_category_single( $id , $taxonomy = 'category' , $class = "" ){
	$html = "";
	$args = array('orderby' => 'term_order', 'order' => 'ASC');
	$terms = wp_get_object_terms( $id, $taxonomy, $args);
	if(!empty($terms)){
  		if(!is_wp_error( $terms )){
			foreach($terms as $term){
                $html .= '<a href="' . get_category_link($term->term_id) . '" class="'. $class .'">' . esc_html( $term->name )  . '</a>';
                break;
			}
		}
	}
	return rtrim($html," / ");
}



function order_the_post_tag( $id , $taxonomy = 'post_tag' ,$parent = null){
	$html = "";
	$args = array('orderby' => 'term_order', 'order' => 'ASC','parent'=>$parent);
	$terms = wp_get_object_terms( $id, $taxonomy, $args);
	if(empty($parent)){ $mr = 'mr5 ';}
	if(!empty($terms)){
  		if(!is_wp_error( $terms )){
			foreach($terms as $term){
				if($term->term_id != $parent):
				$html .= '<a href="' . get_term_link($term->term_id,$taxonomy) . '" rel="tag" class="mr5 badge badge-primary">' . esc_html( $term->name )  . '</a> / ';
				endif;
			}
		}
	}
	return rtrim($html ,' / ');
}

add_filter( 'wp_terms_checklist_args', 'ps_wp_terms_checklist_args' , 10, 2 );
function ps_wp_terms_checklist_args( $args, $post_id ){
	
	if ( $args['checked_ontop'] !== false ){
		$args['checked_ontop'] = false;
	}
 
	return $args;
}




function scf_file_admin_style() {
    echo '<style>
    	 .wp-admin .smart-cf-field-type-image td br{
			display: none;
    	 }
    	 .wp-admin .smart-cf-upload-image{
    	 	margin-left: 10px;	
    	 }
         .wp-admin .smart-cf-upload-image img,.wp-admin .smart-cf-upload-file img {
		    width: 80px;
		    margin-top: 0px !important;
			height: 80px !important;
			object-fit: cover;
		}
        </style>'.PHP_EOL;
}
add_action("admin_print_styles", "scf_file_admin_style");


add_theme_support( 'post-thumbnails', [ 'post', 'pickup', 'blog'] );
