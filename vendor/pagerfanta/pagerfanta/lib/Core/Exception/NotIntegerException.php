<?php

namespace Pagerfanta\Exception;

trigger_deprecation('pagerfanta/pagerfanta', '2.3', 'The "%s" exception is deprecated and will be removed in 3.0.', NotIntegerException::class);

/**
 * @deprecated to be removed in 3.0
 */
class NotIntegerException extends InvalidArgumentException
{
}
