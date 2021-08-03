<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $consult_at 咨询时间
 * @property string|null $avatar 头像
 * @property int|null $sex 性别：1 男 2 女 3 其他
 * @property int|null $age 年龄
 * @property int|null $grade 所在年级
 * @property string|null $school 所在学校
 * @property string|null $wants_country 意向国家，使用国家简写保存
 * @property string|null $language_level 语言成绩
 * @property string|null $parent_name 父母姓名
 * @property string|null $parent_tel 父母电话
 * @property string|null $wechat 微信
 * @property int|null $from 用户来源 默认为自有来源
 * @property int|null $from_id 用户来源id
 * @property int $status 账号状态，默认为开启
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ConsultLog[] $consultLogs
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereConsultAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLanguageLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereParentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereParentTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWantsCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWechat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 * @property int $is_partner 是否是合作伙伴
 * @property string|null $real_name 真实姓名
 * @property string|null $tel 手机号
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsPartner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTel($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\Admin
 *
 * @property int $id
 * @property string $name
 * @property string|null $tel
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property int $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Admin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin wherePermissionIs($permission = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereRoleIs($role = '')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Admin withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Admin withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property string|null $job_number 工号
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Admin whereJobNumber($value)
 */
	class Admin extends \Eloquent {}
}

namespace App{
/**
 * App\Piece
 *
 * @property int $id
 * @property int $piece_model_id
 * @property string $name 碎片名称
 * @property string $text text 类型的值
 * @property string $url url 类型的值
 * @property string $image image 类型的值
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\PieceModel $pieceModel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece wherePieceModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereUrl($value)
 * @mixin \Eloquent
 * @property string $values 碎片具体的内容
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Piece onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereValues($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Piece withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Piece withoutTrashed()
 */
	class Piece extends \Eloquent {}
}

namespace App{
/**
 * App\Article
 *
 * @property int $id
 * @property int $category_id 所属分类
 * @property string $author 作者
 * @property string $title 文章标题
 * @property string $description 文章简介
 * @property string $cover 文章封面
 * @property string $content 文章内容
 * @property int $status 文章状态
 * @property int $sort 排序，值越小排序越靠前
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $published_at 发布时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article wherePublishedAt($value)
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Article onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Article withoutTrashed()
 */
	class Article extends \Eloquent {}
}

namespace App{
/**
 * App\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $tag 权限tag，用于标注分类
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Permission extends \Eloquent {}
}

namespace App{
/**
 * App\Tag
 *
 * @property int $id
 * @property string $name 标签名称
 * @property int $status 启用状态
 * @property int $sort 排序，越小排序越靠前
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Tag onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Tag whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Tag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Tag withoutTrashed()
 */
	class Tag extends \Eloquent {}
}

namespace App{
/**
 * App\ProductCategory
 *
 * @property int $id
 * @property string $name 分类名称
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCategory withoutTrashed()
 * @mixin \Eloquent
 */
	class ProductCategory extends \Eloquent {}
}

namespace App{
/**
 * App\PieceModel
 *
 * @property int $id
 * @property string $name 模型名称
 * @property string $description 模型描述
 * @property string $fields 模型的字段定义
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Piece[] $pieces
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\PieceModel onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PieceModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\PieceModel withoutTrashed()
 */
	class PieceModel extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property int $id
 * @property string $name 分类名称
 * @property string $description 分类描述
 * @property int $status 状态
 * @property int $sort 排序，数值越小排序越靠前
 * @property int $articles_count 分类下的文章个数
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereArticlesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Category onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\ArticleTag
 *
 * @property int $id
 * @property int $article_id article 主键
 * @property int $tag_id tag 主键
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleTag onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleTag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleTag withoutTrashed()
 */
	class ArticleTag extends \Eloquent {}
}

namespace App{
/**
 * App\ActivitySummerCamp
 *
 * @property int $id
 * @property string $name 姓名
 * @property string $tel 电话
 * @property string $wants_country 意向国家
 * @property string|null $ip IP地址
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ActivitySummerCamp onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereWantsCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivitySummerCamp withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ActivitySummerCamp withoutTrashed()
 */
	class ActivitySummerCamp extends \Eloquent {}
}

namespace App{
/**
 * App\ConsultLog
 *
 * @property int $id
 * @property int $user_id 关联的注册用户
 * @property string|null $name 咨询者姓名
 * @property string|null $tel 咨询者电话
 * @property string $content 咨询内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ConsultLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsultLog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ConsultLog withoutTrashed()
 * @mixin \Eloquent
 */
	class ConsultLog extends \Eloquent {}
}

namespace App{
/**
 * App\Organization
 *
 * @property int $id
 * @property string $name 结构名称
 * @property string|null $logo logo
 * @property string|null $images 图片，多个图片
 * @property string|null $description 机构简介
 * @property string $content 结构详情
 * @property string|null $url 官网URL链接
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Organization onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organization withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Organization withoutTrashed()
 * @mixin \Eloquent
 */
	class Organization extends \Eloquent {}
}

namespace App{
/**
 * App\PayLog
 *
 * @property int $id
 * @property int $admin_id 操作人员
 * @property int $order_id 对应订单
 * @property float $paid_fee 缴费金额
 * @property string $paid_at 缴费时间
 * @property string|null $remark 缴费备注
 * @property int $status 预留字段
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\PayLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog wherePaidFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PayLog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\PayLog withoutTrashed()
 * @mixin \Eloquent
 */
	class PayLog extends \Eloquent {}
}

namespace App{
/**
 * App\Order
 *
 * @property int $id
 * @property string $order_sn 订单编号
 * @property int $user_id 订单用户
 * @property int $product_id 订单产品
 * @property string $product_snapshot 产品快照
 * @property string $wants_country 意向国家
 * @property float $total_fee 总费用
 * @property float $left_fee 剩余金额
 * @property string|null $remark 订单备注
 * @property int $status 预留字段
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereLeftFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOrderSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereProductSnapshot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereWantsCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Order withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PayLog[] $payLogs
 * @property-read \App\Product $product
 */
	class Order extends \Eloquent {}
}

namespace App{
/**
 * App\Product
 *
 * @property int $id
 * @property int $product_category_id
 * @property string $name 产品名称
 * @property string $commission 佣金比例，如 12.34%，储存为 1234
 * @property string $price 价格，单位：分
 * @property string|null $description 产品描述
 * @property string|null $content 详细内容
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\ProductCategory $category
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereProductCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withoutTrashed()
 * @mixin \Eloquent
 */
	class Product extends \Eloquent {}
}

