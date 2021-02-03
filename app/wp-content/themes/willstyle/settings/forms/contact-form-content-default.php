<!-- このファイルは変更しないでください。 内容をcontact-form-content.phpへコピーし、フォームを新規作成することでフォームの内容を自動生成できます。-->
<div class="py-40 py-md-60 px-15 px-md-0">
    <div data-form="contact--form">
        <div class="form-group row">
            <label for="label-for-compname" class="col-md-3 col-form-label">会社名</label>
            <div class="col-md-6">
                [mwform_text name="compname" class="form-control" id="label-for-compname" placeholder="会社名" require="true"]
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-compkana" class="col-md-3 col-form-label">会社名フリガナ</label>
            <div class="col-md-6">
                [mwform_text name="compkana" class="form-control" id="label-for-compkana" placeholder="会社名フリガナ"]
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-name" class="col-md-3 col-form-label c-form__require">お名前</label>
            <div class="col-md-6">
                <div data-required="true">
                    [mwform_text name="name" class="form-control" id="label-for-name" placeholder="お名前"]
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-kana" class="col-md-3 col-form-label c-form__require">フリガナ</label>
            <div class="col-md-6">
                <div data-required="true">
                    [mwform_text name="kana" class="form-control" id="label-for-kana" placeholder="フリガナ"]
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-postcode" class="col-md-3 col-form-label" data-zip="label-for-postcode" data-address="address">郵便番号</label>
            <div class="col-md-6">
                <div data-alpha-numeric>
                    [mwform_text name="postcode" class="form-control" id="label-for-postcode" placeholder="郵便番号"] 
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-address" class="col-md-3 col-form-label c-form__require">住所</label>
            <div class="col-md-9">
                <div data-required="true">
                    [mwform_text name="address" class="form-control" id="label-for-address" placeholder="住所"]
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-tel" class="col-md-3 col-form-label c-form__require">連絡先電話番号</label>
            <div class="col-md-6">
                <div data-required="true" data-alpha-numeric>
                    [mwform_text name="tel" class="form-control" id="label-for-tel" placeholder="連絡先電話番号"]
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-email" class="col-md-3 col-form-label c-form__require">メールアドレス</label>
            <div class="col-md-9">
                <div data-required="true" data-alpha-numeric>
                    [mwform_email name="email" class="form-control" id="label-for-email" placeholder="メールアドレス"]
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="label-for-file-1" class="col-md-3 col-form-label">ファイル選択</label>
            <div class="col-md-8">
                <div class="custom-file mb-10">
                    [mwform_file class="custom-file-input" id="label-for-file-1"]
                    <label class="custom-file-label c-confirm__hidden" for="label-for-file-1" data-file-input data-browse="ファイル選択">ファイルを選択してください</label>
                </div>
                <div class="custom-file">
                    [mwform_file class="custom-file-input" id="label-for-file-2"]
                    <label class="custom-file-label c-confirm__hidden" for="label-for-file-2" data-file-input data-browse="ファイル選択">ファイルを選択してください</label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label for="label-for-date-1" class="col-md-3 col-form-label">日付</label>
            <div class="col-md-6">
                [mwform_text name="date" class="form-control datepicker" id="label-for-date-1" placeholder="日付"]
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-time-1" class="col-md-3 col-form-label">時間</label>
            <div class="col-md-6">
                [mwform_text name="time" class="form-control timepicker" id="label-for-time-1" placeholder="時間"]
            </div>
        </div>

        <div class="form-group row">
            <label for="label-for-select" class="col-md-3 col-form-label c-form__require">選択項目</label>
            <div class="col-md-6">
                <div data-required="true">
                    [mwform_select name="select" children=":選択してください,..." class="custom-select" id="label-for-select" post_raw="true"]
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label c-form__require">チェックボックス</label>
            <div class="col-md-6">
                <div data-required-any="true">
                    [mwform_checkbox name="checkbox" children="チェックボックス1,チェックボックス2" separator="," vertically="true"]
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label c-form__require">ラジオボタン</label>
            <div class="col-md-6">
                <div data-required-any="true">
                    [mwform_radio name="radio" children="ラジオボタン1,ラジオボタン2" separator="," vertically="true"]
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="label-for-body" class="col-md-3 col-form-label c-form__require">お問合わせ内容</label>
            <div class="col-md-9">
                <div data-required-any="true">
                    [mwform_textarea name="body" class="form-control" id="label-for-body" cols="30" rows="8" placeholder="お問合わせ内容を入力してください"]
                </div>
            </div>
        </div>
        <div class="form-group row c-confirm__hidden">
            <label class="col-md-3 col-form-label c-form__require">同意事項</label>
            <div class="col-md-6">
                <div class="c-form__pp">
                    <a data-window-open href="/pp/" target="_blank" rel="noopener noreferrer">プライバシーポリシーはこちら</a>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="agree-check" name="agree" data-agree required>
                    <label class="custom-control-label" for="agree-check">プライバシーポリシーに同意</label>
                </div>
                [mwform_hidden name="agree"]
            </div>
        </div>
        <div class="text-center pb-15">
            [mwform_submitButton name="mwform_submitButton-61" class="btn btn-primary c-form__submit" confirm_value="送信内容のご確認" submit_value="メールを送信する"]
        </div>
        <div class="text-center pb-15">
            [mwform_backButton value="入力画面へ戻る" class="btn btn-secondary c-form__return"]
        </div>
    </div>
</div>