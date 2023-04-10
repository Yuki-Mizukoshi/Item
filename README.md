# 商品管理システム

## 概要
* このシステムでは、店舗で扱う商品の在庫管理を行うことができます。
* 店舗の責任者等をこのシステムの管理者として登録することで、商品の新規登録から編集、削除を行うことができ、各商品の在庫を調整することができます。
* 責任者以外の従業員を一般ユーザーとして登録することで、商品の登録や編集、削除は行えないが、商品の在庫状況を確認することができます

## 主な機能
* ログインログアウト機能
* 商品一覧画面
* 商品新規登録、編集、削除機能
* ユーザー登録、編集、削除機能（管理者のみ）
* 商品検索機能
* 商品並び替え機能


## 開発環境
```
PHP 8.0
MySQL
Laravel 8.83.3
```

## 設計書
[設計書ページへ](#)

## システム閲覧
[アプリケーションページへ](https://techis-mizukoshi.herokuapp.com/login)

## テストアカウント情報
```
*管理者
メールアドレス：admin@techis
パスワード：admin1234

*一般ユーザー
メールアドレス：general@techis
パスワード：general1234
```

### 環境構築手順

* Gitクローン
* .env.example をコピーして .env を作成
* MySQLかPostgreSQLのデータベース作成（名前：item_management）  
  ローカルでMAMPを使用しているのであれば、MySQL推奨
* .env にデータベース接続情報追加
```
例）
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=item_management
DB_USERNAME=root
DB_PASSWORD=root
```
* APP_KEY生成
```
$ php artisan key:generate
```
* Composerインストール
```
$ composer install
```
* フロント環境構築
```
$ npm install
$ npm run dev
```
* マイグレーション
```
$ php artisan migrate
```
