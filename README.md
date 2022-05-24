# 飲食店予約サービス

## 目次

---



番号 | 項目
-|-
1 | [URL](#1url)
2 | [概要](#2概要)
3 | [制作背景](#3制作背景)
4 | [目的](#4目的)
5 | [使用画面のイメージ](#５使用画面のイメージ)
6 | [使用技術、バージョン](#6使用技術バージョン)
7 | [機能一覧](#7機能一覧)
8 | [DB設計](#8db設計)

## 1.URL

---

## 2.概要

---

ある企業のグループ会社の飲食店予約サービス


## 3.制作背景

---

外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい


## 4.目的

---

模擬案件を通して実践に近い開発経験をつむ


## ５.使用画面のイメージ

---

![](/public/imges/readme/register.png)

![](/public/imges/readme/login.png)

![](/public/imges/readme/thanks.png)

![](/public/imges/readme/shop_all.png)

![](/public/imges/readme/my_page.png)

![](/public/imges/readme/shop_detail.png)

![](/public/imges/readme/done.png)

![](/public/imges/readme/menu1.png)

![](/public/imges/readme/menu2.png)


## 6.使用技術、バージョン

---

- フロントエンド
  - HTML/CSS/JavaScript
- バックエンド
  - PHP
  - Laravel
- インフラ、その他
  - MySQL
  - Docker
  - AWS
  - Visual Stadio Code
  - draw.io

## 7.機能一覧

---

- 会員登録
- ログイン
- ログアウト
- ユーザー情報取得
- ユーザー飲食店お気に入り一覧取得
- ユーザー飲食店予約情報取得
- 飲食店一覧取得
- 飲食店詳細取得
- 飲食店お気に入り追加
- 飲食店お気に入り削除
- 飲食店予約情報追加
- 飲食店予約情報削除
- エリアで検索する
- ジャンルで検索する
- 店名で検索する

## 8.DB設計

---

### ER図

![](/public/imges/readme/rese.drawio.png)

### テーブル設計

#### usersテーブル

ユーザーを管理する

カラム名 | 属性 | 役割
-|-|-
id | 整数　| ユーザーを識別するID
name | 文字列 | ユーザー名
email | 文字列 | メールアドレス
email_verified_at | 日付と時刻 | -
password | 文字列 | パスワード
rememberToken | 文字列 | -
created_at | 日付と時刻 | 作成日時
updated_at | 日付と時刻 | 更新日時

#### shopsテーブル

店舗情報を管理する

カラム名 | 属性 | 役割
-|-|-
id | 整数　| 店舗を識別するID
name | 文字列 | 店舗名
area_id | 整数 | エリアを識別するID
genre_id | 整数 | ジャンルを識別するID
content | テキスト | 店舗の説明
img | 文字列 |　店舗画像へのURL
created_at | 日付と時刻 | 作成日時
updated_at | 日付と時刻 | 更新日時

#### reservesテーブル

予約に関するデータを管理する

カラム名 | 属性 | 役割
-|-|-
id | 整数　| 予約データを識別するID
user_id | 整数 | ユーザを識別するID
shop_id | 整数 | 店舗を識別するID
number | 数値| 予約人数
date | 日付 | 予約日
time | 時刻 | 予約時間
created_at | 日付と時刻 | 作成日時
updated_at | 日付と時刻 | 更新日時

#### favoritesテーブル

お気に入り登録された店舗のデータを管理する

カラム名 | 属性 | 役割
-|-|-
id | 整数　| お気に入り登録したデータを識別するID
user_id | 整数 | ユーザを識別するID
shop_id | 整数 | 店舗を識別するID
created_at | 日付と時刻 | 作成日時
updated_at | 日付と時刻 | 更新日時

#### areasテーブル

店舗のエリアを管理する

カラム名 | 属性 | 役割
-|-|-
id | 整数　| エリアを識別するID
area | 文字列 | エリア名
created_at | 日付と時刻 | 作成日時
updated_at | 日付と時刻 | 更新日時

#### genresテーブル

店舗のジャンルを管理する

カラム名 | 属性 | 役割
-|-|-
id | 整数　| ジャンルを識別するID
genre | 文字列 | ジャンル名
created_at | 日付と時刻 | 作成日時
updated_at | 日付と時刻 | 更新日時

[トップへ戻る](#目次)