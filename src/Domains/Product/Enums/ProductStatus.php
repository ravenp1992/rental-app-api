<?php

namespace Domains\Product\Enums;

enum ProductStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case INACTIVE = 'inactive';
}
