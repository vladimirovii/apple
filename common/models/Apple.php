<?php

namespace common\models;

use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property int $status
 * @property float $eat_percent
 * @property int $created_at
 * @property int|null $fall_at
 */
class Apple extends \yii\db\ActiveRecord
{
    private const SPOILED_EXPIRE_TIME = 3600 * 5;

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => null,
                'value' => rand(0, time())
            ],
            'color' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'color'
                ],
                'value' => sprintf('#%06X', mt_rand(0, 0xFFFFFF))
            ],
        ];
    }

    public static function tableName(): string
    {
        return 'apple';
    }

    public function rules(): array
    {
        return [
            [['eat_percent'], 'default', 'value' => 0],
            [['fall_at'], 'default', 'value' => null],
            [['eat_percent'], 'number'],
            [['created_at', 'fall_at'], 'integer'],
            [['color'], 'string', 'max' => 255],
        ];
    }

    public function isHang(): bool
    {
        return null === $this->fall_at;
    }

    public function isFall(): bool
    {
        return null !== $this->fall_at;
    }

    public function isFullEat(): bool
    {
        return $this->eat_percent >= 100;
    }

    public function isSpoiled(): bool
    {
        return ($this->fall_at + self::SPOILED_EXPIRE_TIME) < time();
    }

    public function getSize(): float
    {
        return $this->eat_percent > 0 ? 100 - $this->eat_percent : 0;
    }

    public function fall(): void
    {
        $this->fall_at = time();
    }

    public function eat(float $percent): void
    {
        $this->eat_percent += abs($percent);
    }
}
