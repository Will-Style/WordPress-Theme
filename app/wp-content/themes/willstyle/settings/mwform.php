<?php 
include('forms/contact-form-settings.php');

/**
 * @param string $content
 * @return string
 */
function my_mwform_default_content( $content ) {
    // テーマファイルに置いたフォーム内容用のテンプレートを使用する例
    ob_start();
    echo file_get_contents( get_template_directory()."/settings/forms/contact-form-content.php");
    return ob_get_clean();
}
add_filter( 'mwform_default_content', 'my_mwform_default_content' );

/**
 * デフォルトの設定ができます。値を変更してフォームを新規作成するとデータが反映されます。
 * ※バリデーションはfunctions.phpから設定するようにしてください。
 * 
 * @param empty $value
 * @param string $key
 * @return mixed
 */
function my_mwform_default_settings( $value, $key ) {

    
    $site_name = "有限会社三宅商店";
    $admin_mail = "okuda@willstyle.co.jp";
    $form_data = "-------------------------

お名前 : {name}
フリガナ : {kana}
郵便番号 : {postcode}
住所 : {address}
連絡先電話番号 : {tel}
メールアドレス : {email}
お問合わせ内容 : 
{body}

-------------------------";

    $signature = "

有限会社三宅商店

住所：〒670-0043　兵庫県姫路市小姓町76
TEL：079-298-9310
URL：https://miyake-sss.co.jp/
    ";

    // 入力画面URL
    if ( $key == "input_url" ){
        return '/contact/';
    }
    // 確認画面URL
    if ( $key == "confirmation_url" ){
        return '/contact/confirm/';
    }
    // 完了画面URL
    if ( $key == "complete_url" ){
        return '/contact/complete/';
    }

    // 自動返信メール件名
    if( $key == 'mail_subject' ){
        return "【".$site_name."】サイトへお問い合わせを受付致しました。";
    }
    // 自動返信メール送信者
    if( $key == "mail_sender" ){
        return $site_name;
    }
    // 自動返信メールReply-to（メールアドレス）
    if( $key  == "mail_reply_to" ){
        return $admin_mail;
    }
    // 自動返信メール本文
    if( $key == "mail_content" ){
        return "※このメールはシステムからの自動返信メールです。

この度は、有限会社三宅商店にお問い合わせいただき誠にありがとうございます。
以下の内容にて、お問い合わせを受け付け致しました。

お送りいただきました内容を確認させて頂き、
ご連絡を致しますので、もうしばらくお待ち下さいませ。

お問い合わせありがとうございました。

".$form_data.$signature;
    }
    // 自動返信メール（自動返信メールに使用する項目のキー）
    if( $key == "automatic_reply_email" ){
        return "email";
    }
    // 自動返信メール送信元（E-mailアドレス）
    if( $key == "mail_from" ){
        return $admin_mail;
    }
    // 管理者宛メールアドレス
    if( $key == "mail_to" ){
        return $admin_mail;
    }
    // 管理者宛 CCメールアドレス
    if( $key == "mail_cc" ){
        return "";
    }
    // 管理者宛 BCCメールアドレス
    if( $key == "mail_bcc" ){
        return "";
    }
    // 管理者宛 BCCメールアドレス
    if( $key == "mail_bcc" ){
        return "";
    }
    // 管理者宛メール件名
    if( $key == "admin_mail_subject" ){
        return "【".$site_name."】サイトへお問い合わせがありました。";
    }
    // 管理者宛メール送信者
    if( $key == "admin_mail_sender" ){
        return $site_name;
    }
    // 管理者宛メールReply-to（メールアドレス）
    if( $key == "admin_mail_reply_to" ){
        return $admin_mail;
    }
    // 管理者宛メール本文
    if( $key == "admin_mail_content" ){
        return"サイトへお問い合わせがありました。

【お問い合わせ内容】
".$form_data;
    }
    // 管理者宛メールReturn-Path ( メールアドレス )
    if( $key == "mail_return_path" ){
        return "";
    }
    // 管理者宛メール送信元
    if( $key == "admin_mail_from" ){
        return "";
    }
    
    
    
    // バリデーション
    // if ( $key == 'validation' ) {
    //     return array(
    //         array(
    //             'target'  => 'name',
    //             'noempty' => true,
    //         ),
    //     );
    // }
    
    // 問い合わせデータをデータベースに保存
    if( $key == 'usedb' ){
        return true;
    }
    // URL引数を有効にする
    // if( $key == 'querystring' ){
    //     return true;
    // }
    // 画面変遷時のスクロールを有効にする
    // if( $key == 'scroll' ){
    //     return true;
    // }

}
add_filter( 'mwform_default_settings', 'my_mwform_default_settings', 10, 2 );


