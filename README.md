### How to deploy project

You should run the following commands:

```
#clone repo
git clone git@github.com:coding-books/website.git cobooks

#composer
composer update

#run migrations
php yii migrate/up
php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
php yii migrate/up --migrationPath=@yii/rbac/migrations
php yii migrate --migrationPath=@Zelenin/yii/modules/I18n/migrations
```

You can see code coverage output under the `tests/_output` directory.
