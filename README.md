お問い合わせフォーム

環境構築

Dockerビルド
 1.git@github.com:ShKRSM/contact-form_laravel.git
 2.docker-compose up -d -build

※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

Laravel環境構築

 1.docker-compose exec php bash
 2.composer install
 3..env.examplwファイルから.envを作成し、環境変数を変更
 4.php artisan key:ganerate
 5.php artisan migrate
 6.php artisan db:seed

使用技術

 ・PHP 8.0
 ・Laravel 10.0
 ・MySQL 8.0

ER図
![image](https://github.com/user-attachments/assets/6593b035-d950-4649-8333-f2a4b43d42f0)


URL

 ・開発環境:http://localhost/
 ・phpMyAdmin:http://localhost:8080/
