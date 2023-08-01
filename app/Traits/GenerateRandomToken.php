<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait GenerateRandomToken
{
    /**
     * Boot the trait.
     *
     * @return void
     */
    public static function bootGenerateRandomToken()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }

            $model->generateRandomToken();
        });
    }

    /**
     * Generate a random token for the model.
     *
     * @return void
     */
    public function generateRandomToken()
    {
        $this->forceFill([
            'token' => Str::random(64),
        ]);
    }
}
