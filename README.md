# Share knowledge
PHP 自作

## 概要
企業向けの周知事項を共有できるPCサイトを作成しました。  
ユーザーは2種類あります。
- 管理者
- 一般ユーザー(従業員)

## 使い方
### 管理者
テストアカウント  
メールアドレス：test1@test.com  
パスワード：11111111
#### 詳細
- 周知
一覧、詳細が閲覧できます。  
投稿、編集、削除、検索、既読ができます。   

- ユーザー
ユーザーの一覧が閲覧できます。  
ユーザー情報の編集、削除ができます。  

- ログアウト  
周知一覧ページの右上からできます。  

### ユーザー(従業員)
テストアカウント  
メールアドレス：test2@test.com  
パスワード：22222222
#### 詳細
- 周知 
一覧が閲覧できます。  
検索、既読ができます。  

- ログアウト  
周知一覧ページの右上からできます。  

## 環境
MAMP version6.8/MySQL version5.7.39/PHP version8.2.0

## データベース
データベース名：share_knowledge
テーブル：お使いのphpMyAdminに上のデータベースを作り、入っているshare_knowledge.sqlをインポートしていただければお使いいただけると思います。