<?php

namespace Pagekit\Component\Database\ORM\Annotation;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
final class OrderBy implements Annotation
{
    /** @var array<string> */
    public $value;
}
