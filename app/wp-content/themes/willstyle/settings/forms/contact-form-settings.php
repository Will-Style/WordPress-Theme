<?php 


/**
 * contact_validation_rule
 * @param object $Validation
 * @param array $data
 * @param MW_WP_Form_Data $Data
 * $Validation::set_ruleの引数は name属性値, バリデーション名, オプション
 */
function contact_validation_rule( $Validation, $data, $Data ) {
    $Validation->set_rule( 'name', 'noEmpty',array( 'message' => 'お名前を入力してください' ));
    $Validation->set_rule( 'kana', 'noEmpty',array( 'message' => 'フリガナを入力してください' ));
    $Validation->set_rule( 'address', 'noEmpty',array( 'message' => '住所を入力してください' ));
    // $Validation->set_rule( 'tel', 'noEmpty',array( 'message' => '連絡先電話番号を入力してください' ));
    
    $Validation->set_rule( 'email', 'noEmpty',array( 'message' => 'メールアドレスを入力してください' ));
    $Validation->set_rule( 'email', 'mail', array(
        'message' => 'メールアドレスの形式ではありません。'
    ));

    $Validation->set_rule( 'body', 'noEmpty',array( 'message' => 'お問い合わせ内容を入力してください' ));
    
   
    return $Validation;
}
add_filter( 'mwform_validation_mw-wp-form-26' , 'contact_validation_rule', 10, 3 );

