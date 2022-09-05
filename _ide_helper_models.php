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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

