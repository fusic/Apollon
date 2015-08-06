# Apollon

[![Build Status](https://img.shields.io/travis/fusic/Apollon/master.svg?style=flat-square)](https://travis-ci.org/fusic/Apollon)
[![Code Quality](https://img.shields.io/scrutinizer/g/filp/whoops.svg)](https://scrutinizer-ci.com/g/fusic/Apollon/)

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
