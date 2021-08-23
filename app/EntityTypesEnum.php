<?php

namespace App;

class EntityTypesEnum
{
    public const TYPE_COVER = 'cover';
    public const TYPE_SHORT_SUMMARY = 'short_summary';
    public const TYPE_SUMMARY = 'summary';
    public const TYPE_CHARACTERS = 'characters';

    public const map = [
        self::TYPE_COVER => 1,
        self::TYPE_SHORT_SUMMARY => 2,
        self::TYPE_SUMMARY => 3,
        self::TYPE_CHARACTERS => 4,
    ];
}
