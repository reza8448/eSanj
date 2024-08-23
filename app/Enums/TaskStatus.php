<?php

namespace App\Enums;
enum TaskStatus: string
{

    case COMPLETE ='complete';
    case RUNNING= 'running';

    case POSTPONED = 'postponed';
    public function isComplete(): bool
    {
        return $this === self::COMPLETE;
    }
    public function isRunning(): bool
    {
        return $this === self::RUNNING;
    }

    public function isPostponed(): bool
    {
        return $this === self::POSTPONED;
    }

    public function getLabelText(): string
    {
        return match($this){

            self::COMPLETE => 'کامل شده',
            self::POSTPONED => 'به تعویق افتاده',
            self::RUNNING => 'درحال انجام',
        };
    }

}
