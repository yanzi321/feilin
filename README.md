# avenue

## run 

```bash
cp .env.example .env
composer install -vvv
php artisan key:generate
php artisan migrate
```

rbac seeder

```bash
php artisan db:seed --class=RbacSeeder
```

## fresh table and seed

```bash
php artisan migrate:fresh --seed
```

## 权限控制

1、需要在 permission 中增加对应的 name，比如 用户列表权限 user.index

2、前端在路由定义时，有一个 name 属性，记得是  user.index

> 前端有 $hasActionPermission 方法来判断

3、后端 admin.php 中，需要给对应的路由别名 user.index

> 后端有 rbac 中间件判断

4、另：部分没有涉及到权限的，放在 admin.php 的最下方，没有使用 rbac middleware

> 后面需要拓展权限时，记得按照 123 步骤进行即可
