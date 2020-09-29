<?php

namespace App\Parsing\Parsers;

use App\Models\Ad;

class ApartmentsParser extends Parser
{
    /**
     * {@inheritDoc}
     */
    protected $category = Ad::CATEGORY_APARTMENTS;
}
