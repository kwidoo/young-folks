<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Bot
 *
 * @property int $id
 * @property string $token
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Chat> $chats
 * @property-read int|null $chats_count
 * @method static \DefStudio\Telegraph\Database\Factories\TelegraphBotFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Bot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bot query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bot whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bot whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bot whereUpdatedAt($value)
 */
	class Bot extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Chat
 *
 * @property int $id
 * @property string $chat_id
 * @property string|null $name
 * @property int $telegraph_bot_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Bot $bot
 * @method static \DefStudio\Telegraph\Database\Factories\TelegraphChatFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereTelegraphBotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat whereUpdatedAt($value)
 */
	class Chat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MenuItem
 *
 * @property int $parent_id
 * @property int $id
 * @property string $slug
 * @property int $enabled
 * @property int $type_id
 * @property array $name
 * @property array|null $description
 * @property string|null $params
 * @property int $sort_order
 * @property int $_lft
 * @property int $_rgt
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection<int, MenuItem> $children
 * @property-read int|null $children_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read MenuItem|null $parent
 * @property-read \App\Models\Type $type
 * @method static \Kalnoy\Nestedset\Collection<int, static> all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem bySlug(string $slug)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Database\Factories\MenuItemFactory factory($count = null, $state = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection<int, static> get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem ordered(string $direction = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereDeletedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereDescription($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereEnabled($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereParams($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereSlug($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereSortOrder($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereTypeId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Kalnoy\Nestedset\QueryBuilder|MenuItem withoutRoot()
 */
	class MenuItem extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \Spatie\EloquentSortable\Sortable {}
}

namespace App\Models{
/**
 * App\Models\Type
 *
 * @property int $id
 * @property array $name
 * @property string $slug
 * @property int $enabled
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection<int, \App\Models\MenuItem> $menuItems
 * @property-read int|null $menu_items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Type findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Type withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 */
	class Type extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $locale
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

