# Apollon

[![Build Status](https://img.shields.io/travis/fusic/Apollon/master.svg?style=flat-square)](https://travis-ci.org/fusic/Apollon)
[![Code Quality](http://img.shields.io/scrutinizer/g/fusic/Apollon.svg?style=flat-square)](https://scrutinizer-ci.com/g/fusic/Apollon/)

##バリデーション一覧
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
- jpFixedPhone
  - 日本国内 固定電話番号チェック
- jpMobilePhone
  - 日本国内 非固定電話番号チェック（携帯電話/PHS/IP電話）

