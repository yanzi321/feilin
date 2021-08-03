<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
//        $this->call(LaratrustSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(ArticleTagTableSeeder::class);
        $this->call(PieceModelTableSeeder::class);
        $this->call(PiecesTableSeeder::class);
        $this->call(ConsultLogsTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductCategoriesTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(PayLogsTableSeeder::class);
        $this->call(ActivitySummerCampsTableSeeder::class);
        $this->call(UserCashRequestsTableSeeder::class);
        $this->call(CommissionRulesTableSeeder::class);
        $this->call(WechatUsersTableSeeder::class);
        $this->call(ExternSalesmanTableSeeder::class);
    }
}
