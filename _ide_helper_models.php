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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chat[] $chats
 * @property-read int|null $chats_count
 * @method static \DefStudio\Telegraph\Database\Factories\TelegraphBotFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Bot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bot query()
 */
	class Bot extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Chat
 *
 * @property-read \App\Models\Bot|null $bot
 * @method static \DefStudio\Telegraph\Database\Factories\TelegraphChatFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chat query()
 */
	class Chat extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TelegramUpdate
 *
 * @property int $id
 * @property string $update_id
 * @property array $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int $chat_id
 * @property-read string $command
 * @property-read bool $is_command
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate isCommand()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate isStart()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate query()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate whereUpdateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramUpdate whereUpdatedAt($value)
 */
	class TelegramUpdate extends \Eloquent {}
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
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\YFEvent
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\YFEventSchedule[] $event_schedule
 * @property-read int|null $event_schedule_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\YFEventType[] $event_type
 * @property-read int|null $event_type_count
 * @method static \Illuminate\Database\Eloquent\Builder|YFEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YFEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YFEvent query()
 */
	class YFEvent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\YFEventSchedule
 *
 * @method static \Illuminate\Database\Eloquent\Builder|YFEventSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YFEventSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YFEventSchedule query()
 */
	class YFEventSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\YFEventType
 *
 * @method static \Illuminate\Database\Eloquent\Builder|YFEventType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YFEventType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YFEventType query()
 */
	class YFEventType extends \Eloquent {}
}

