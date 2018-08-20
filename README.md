# Apollon

[![Build Status](https://img.shields.io/travis/fusic/Apollon/master.svg?style=flat-square)](https://travis-ci.org/fusic/Apollon)
[![Code Quality](http://img.shields.io/scrutinizer/g/fusic/Apollon.svg?style=flat-square)](https://scrutinizer-ci.com/g/fusic/Apollon/)

### セットアップ

```
composer require fusic/apollon
```

In Model File

```
 private function setValidationProvider(Validator $validator)
    {
       $validator->provider('apollon', 'Apollon\Validation\ApollonValidation');
       return $validator;
    }
```


### 使用例

```
public function validationDefault(Validator $validator)
    {
        $this->setValidationProvider($validator);
        $validator
            ->scalar('password')
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'パスワードを入力してください')
            ->add('password', 'password',[
                'rule' => 'alphaNumericSymbols',
                'provider' => 'apollon',
                'message' => 'パスワードは半角英数記号で入力してください'
            ]);
    }
```


### バリデーション一覧
- zip
  - 郵便番号チェック 1カラム
- zip1
  - 郵便番号チェック 上3桁
- zip2
  - 郵便番号チェック 下4桁
- alpha
  - 半角英字チェック
- numeric
  - 数値チェック(integerなどの上限チェックを同時に行う)
- naturalNumber
  - 数値チェック(integerなどの上限チェックを同時に行う)
- hiraganaOnly
  - 全角ひらがなチェック
- hiraganaSpaceOnly
  - 全角ひらがな+全角スペースチェック
- katakanaOnly
  - 全角カタカナチェック
- katakanaSpaceOnly
  - 全角カタカナ+全角スペースチェック
- zenkakuOnly
  - 全角のみチェック
- spaceOnly
  - スペースのみはエラーチェック
- hankakukatakanaOnly
  - 半角カタカナチェック
- hankakukatakanaSpaceOnly
  - 半角カタカナ+半角スペースチェック
- phone
  - 電話番号チェック（ハイフン有無しOK）
- phone1
  - 電話番号チェック 上2～5桁
- phone2
  - 電話番号チェック 中2～4桁
- phone3
  - 電話番号チェック 下4桁
- emailNonRfc
  - メールアドレスチェック（RFC非準拠）
- datetimeComparison
  - 日時比較チェック
