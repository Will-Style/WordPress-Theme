<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', '' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', '' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', '' );

/** MySQL のホスト名 */
define( 'DB_HOST', '' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'rb^NbI32cSG+]e}FsD$)bUi+L0WDh2o+C|9]<Pb@QNJw2 OMkuS*jF+lCo_:^6<x');
define('SECURE_AUTH_KEY',  'AL#2--=UcdOA;]/}.;7Wz_9Ht>RO1:2oB1;[E86R)Dv/yx(J$c_Upu)#+SC /* n');
define('LOGGED_IN_KEY',    'ME-IK+&V|#+OD:Gf?XJih=6?!IN)c8sXXdk^]1Xz0G#T,}%V>wPJELq|}qG:~rO&');
define('NONCE_KEY',        'pC$mOGZK^O?^<Z=W/Ic%{|&t7u8b=-E|%HyAF?Ma|$&+cp$*M~CvbF-!8dp%# X1');
define('AUTH_SALT',        '|+gVU41a-b|r]}2O,uMI8J$;<FKi5FUwEGHS]f|KB3{QhID&a#JZZN+S^ z%tPvP');
define('SECURE_AUTH_SALT', 'qT^:Z|Oa ;K~/-U`n(qq%1NQIR~BfZ-eSIV=j:`[]1+~<`84jD5i%}A+k-@vkEpA');
define('LOGGED_IN_SALT',   'a+t|[;,tSE6LOsLwOh~aG|.5!{zIa?Ks2BW]-hp6ZYdaHA`*vB{Yztp+db%nwEXt');
define('NONCE_SALT',       '-ch%(j4C] ~z@0vH|-;~3!*KLb2hzfer$0Wg{<s(pQ hNGbJww^LdZ3uo{FZ=K{O');

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

define('WP_HOME','https://example.com');
define('WP_SITEURL','https://example.com/app');
/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('WP_POST_REVISIONS', 5);


/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
