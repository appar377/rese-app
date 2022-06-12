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

### 新規登録ページ

![](/public/img/readme/register.png)

### ログインページ

![](/public/img/readme/login.png)

### 新規登録完了ページ

![](/public/img/readme/thanks.png)

### ホームページ

![](/public/img/readme/shop_all.png)

### マイページ

![](/public/img/readme/my_page.png)

### 店舗詳細ページ

![](/public/img/readme/shop_detail.png)

### 予約完了ページ

![](/public/img/readme/done.png)

### ログイン中メニュー

![](/public/img/readme/menu1.png)

### ログアウト中メニュー

![](/public/img/readme/menu2.png)


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
id | unsigned bigint　| ユーザーを識別するID
name | varchar(255) | ユーザー名
email | varchar(255) | メールアドレス
email_verified_at | timestamp | -
password | varchar(255) | パスワード
rememberToken | varchar(100) | -
created_at | timestamp | 作成日時
updated_at | timestamp | 更新日時

#### shopsテーブル

店舗情報を管理する

カラム名 | 属性 | 役割
-|-|-
id | unsigned bigint　| 店舗を識別するID
name | varchar(255) | 店舗名
area_id | unsigned bigint | エリアを識別するID
genre_id | unsigned bigint | ジャンルを識別するID
content | text | 店舗の説明
img | varchar(255) |　店舗画像へのURL
created_at | timestamp | 作成日時
updated_at | timestamp | 更新日時

#### reservesテーブル

予約に関するデータを管理する

カラム名 | 属性 | 役割
-|-|-
id | unsigned bigint　| 予約データを識別するID
user_id | unsigned bigint | ユーザを識別するID
shop_id | unsigned bigint | 店舗を識別するID
number | int | 予約人数
date | date | 予約日
time | time | 予約時間
created_at | timestamp | 作成日時
updated_at | timestamp | 更新日時

#### favoritesテーブル

お気に入り登録された店舗のデータを管理する

カラム名 | 属性 | 役割
-|-|-
id | unsigned bigint　| お気に入り登録したデータを識別するID
user_id | unsigned bigint | ユーザを識別するID
shop_id | unsigned bigint | 店舗を識別するID
created_at | timestamp | 作成日時
updated_at | timestamp | 更新日時

#### areasテーブル

店舗のエリアを管理する

カラム名 | 属性 | 役割
-|-|-
id | unsigned bigint　| エリアを識別するID
area | varchar(255) | エリア名
created_at | timestamp | 作成日時
updated_at | timestamp | 更新日時

#### genresテーブル

店舗のジャンルを管理する

カラム名 | 属性 | 役割
-|-|-
id | unsigned bigint　| ジャンルを識別するID
genre | varchar(255)| ジャンル名
created_at | timestamp | 作成日時
updated_at | timestamp | 更新日時

#### revewsテーブル

店舗のジャンルを管理する

カラム名 | 属性 | 役割
-|-|-
id | unsigned bigint　| ジャンルを識別するID
reserve_id | unsigned bigint | 予約データを識別するID
comment | text | コメント
star | int | 星の数
created_at | timestamp | 作成日時
updated_at | timestamp | 更新日時

[トップへ戻る](#目次)