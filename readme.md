# 概要

iPhone の操作を自動化する「ショートカット機能」のレシピを投稿・検索できるサイトです（スマホ閲覧推奨）<br>
https://shortcutrecipe.com/<br>
ポートフォリオの解説をQiitaにまとめています<br>
https://qiita.com/kuro221/items/43bca202088de2ea0421<br>

(↓途中からiPhoneのショートカットアプリに飛んでいます）<br>
<a href="https://gyazo.com/399c4ab0c6445b3c9260ddfa1fc592e7"><img src="https://i.gyazo.com/399c4ab0c6445b3c9260ddfa1fc592e7.gif" alt="Image from Gyazo" width="350"/>

# インフラ図
インフラ構成図に、自動デプロイの流れを書き足したものになります。<br>
1から4までを手動で行うことで、5から11が自動デプロイされます。<br>
![image.png](https://qiita-image-store.s3.ap-northeast-1.amazonaws.com/0/545959/ab2c3e60-88d7-d0ca-c197-06fa727378c9.png)

# 機能一覧

- 新規ユーザー登録
- ログイン
- ログアウト
- パスワードリマインダー（Gmail使用）
- プロフィール変更
- 退会
- ショートカット登録
- ショートカット編集・削除
- ショートカット一覧表示・検索・フィルター
- ページネーション

# 使用技術

-   PHP 7.3.24
-   Laravel 5.8.38
-   Vue.js 2.6.12
-   Vuetify 2.2.26
-   MySQL 8.0.23
-   AWS（EC2,ACM,RDS,Route53,VPC,EIP）
-　　　　　　Docker 20.10.7 /Docker Compose 1.29.2
-   CircleCI 2.1
