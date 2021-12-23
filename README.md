<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravelのプロジェクト作成
### 参考Githubリンク
https://github.com/uchidayuma/udemy-laravel8-mysql-simple-memo

### プロジェクト作成

```
mkdir source
composer create-project 'laravel/laravel=8.5.19' --prefer-dist laravel-simple-memo
```
### envファイルの修正

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=laravel-memo
DB_USERNAME=root
DB_PASSWORD=root
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock
```

### テーブルの作成
laravel-memo

### MAMPの設定
ドキュメントルートの設定
Users ▹ fuji ▹ source ▹ laravel-simple-memo ▹ public

### ファイル権限の付与
sudo chmod -R 0777 storage
sudo chmod -R 0777 bootstrap/


### マイグレーションとは
- 何かを他の環境に移行すること
- ここではDBの話
- 自分が定義したDBを他人がすぐ使える
- PHPファイルでDBを管理
- インターネット公開サーバを構築するなら必須
- マイグレーションファイルを使うとあらゆるDB操作ができる

DBマイグレーションがあれば、
機能の追加とともにDBの整合性もとれる

### モデルとは
- 1テーブル：1モデル
- 名前はテーブルの単数形
- モデル名の複数形テーブルに自動に紐づく
- ファットコントローラを防ぐ
  - データの整形
  - 複雑なSQL
  - 配列の組み替え
  - 複雑な条件分岐
  - とかとか

### モデルとマイグレーションファイルの作成
```
# Memoを単数形に（テーブルはMemos）
$ php artisan make:model Memo -m
Model created successfully.
Created Migration: 2021_11_25_140117_create_memos_table
```
マイグレートファイルはdatabase/migrate/以下に
モデルはapp/Models/以下に
```
$ php artisan make:model Tag -m
$ php artisan make:model MemoTag -m
```

### マイグレーションファイルにテーブル定義を追加
upとdown
upはマイグレーションを実行したときに実行される
downはロールバックしたときに実行される

マイグレーションファイルを修正して、以下コマンドを実行
```
$ php artisan migrate
```

### ログイン機能の実装

```
$ composer require laravel/ui
$ php artisan ui bootstrap --auth
$ npm install && npm run dev
```

### LaravelのViewであるbladeテンプレートの実装
- HTMLの中にPHPを埋め込めるテンプレートエンジン
- /resources/viewsの配下に置く

- レイアウト化につかう命令
  - @extends('レイアウトファイル名')
  - @yield('埋め込む名前')
  - @section('埋め込みたい場所の名前')

### app.blade.phpをコピー
- ログイン用にauth.blade.phpを作成
- app.blade.phpをbootstrapを使って3カラムに
- auth>login.blade.phpとregister.blade.phpの読み込みファイルをauth.blade.phpにする
- ログイン画面だけ1からむ、それ以降は3カラムの状態になる

### カラムの見た目変更
- https://getbootstrap.jp/docs/4.2/utilities/spacing/をコピペ

### タイトルの変更
- <title>{{ config('app.name', 'Laravel') }}</title>
- 上記の書き方はconfig/app.phpのappnameに何も入ってなかったらLarabelを返すという書き方

### メモ作成機能の開発(view側)

### メモ一覧の取得(DB側)
routes/web.php
readmeは全て終わってから、もういっかい見直しつつできたコードをコピペしながら書いたほうが効率いいな。そうしよう
Route::post('/store', [HomeController::class, 'store'])->name('store');
を追加

## 参考
[GitHubリポジトリはこちら](https://github.com/uchidayuma/udemy-laravel8-mysql-simple-memo)

[データベース構造（ER図）](https://dbdiagram.io/d/60bdb1efb29a09603d183ab7)

## コマンド一覧
```
composer create-project 'laravel/laravel=8.5.19' --prefer-dist laravel-simple-memo
composer require laravel/ui
php artisan ui bootstrap --auth
npm install && npm run dev
↑でうまくいかないときは
npm audit fix
npm audit fix --force
npm install
npm run dev
.envいじる
php artisan migrate
```


## ソースコード対応表

| レクチャー名                                 | ブランチ名     |
| -------------------------------------------- | -------------- |
| マイグレーションファイルにテーブル定義を実装 | migration-file |
| ログイン機能の実装                       |  login  |
| 認証用レイアウトファイルの作成             | layout|
| レイアウトの大枠を開発                    | card-layout        |
| メモ作成機能の開発（View側）              |  memo-create-1   |
| メモ作成機能の開発（DB側）                |    memo-create-2 |
| メモ一覧取得（DB側）                     |      memo-get-1  |
| メモ一覧をレンダリング                    |       memo-get-2  |
| メモ更新機能（View側）                   |      memo-update-1  |
| メモ更新機能（DB側）                     |      memo-update-2  |
| メモ削除機能の開発                       |     delete-1        |
| メモにタグを付けられるように改良            |      add-tag       |
| メモに既存タグを付けられるように改良        |      add-tag-2     |
| メモ更新にもタグ機能を付与（View側）        |  edit-tag-1  |
| メモ更新にもタグ機能を付与（DB側）         |  edit-tag-2  |
| ViewComposerで共通処理をまとめる         |  view-composer  |
| タグからの絞り込み検索（View側）          |  filter-1  |
| タグからの絞り込み検索（絞り込みロジック）  | filter-2 |
| タグ検索ロジックのリファクタリング         | filter-refactaling |
| メモ作成機能にバリデーションを追加しよう    | validation-1 |
| メモ削除機能に確認をはさもう              | delete-confirm |
| fontawesomeの導入                     | fontawesome |
| 追加CSSで全体を整える                   | css-fix |
| bootstrapとCSSを使ってレスポンシブ対応をしよう |  responsive  |
| 完成物                               | main |


## 各種リンク

[Progate PHP基礎](https://prog-8.com/courses/php)

[Progate HTML・CSS・基礎](https://prog-8.com/courses/html)

[Bootstrapのグリッド・システム](https://getbootstrap.jp/docs/4.2/layout/grid/)

[Bootstrapリファレンス（card)](https://getbootstrap.jp/docs/4.2/components/card/)

[Bootstrapリファレンス（spacing)](https://getbootstrap.jp/docs/4.2/utilities/spacing/)

[Laravel8のバリデーション](https://readouble.com/laravel/8.x/ja/validation.html)

[fontawesome](https://fontawesome.com/v5.15/icons?d=gallery)

[fontawesomeCDN](https://fontawesome.com/v5.15/how-to-use/customizing-wordpress/snippets/setup-cdn-webfont)

[FlexBoxの解説](https://www.webcreatorbox.com/tech/css-flexbox-cheat-sheet#flexbox5)

[BootstrapのFlexBoxプロパティ](https://getbootstrap.jp/docs/5.0/utilities/flex/#justify-content)

