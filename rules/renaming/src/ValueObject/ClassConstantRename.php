<?php

declare(strict_types=1);

namespace Rector\Renaming\ValueObject;

final class ClassConstantRename
{
    /**
     * @var string
     */
    private $oldClass;

    /**
     * @var string
     */
    private $oldConstant;

    /**
     * @var string
     */
    private $newConstant;

    public function __construct(string $oldClass, string $oldConstant, string $newConstant)
    {
        $this->oldClass = $oldClass;
        $this->oldConstant = $oldConstant;
        $this->newConstant = $newConstant;
    }

    public function getOldClass(): string
    {
        return $this->oldClass;
    }

    public function getOldConstant(): string
    {
        return $this->oldConstant;
    }

    public function getNewConstant(): string
    {
        return $this->newConstant;
    }
}
