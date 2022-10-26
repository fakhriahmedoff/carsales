<?php
declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CarFuelEnum extends Enum
{
    const PETROL         = 'petrol';
    const DIESEL         = 'diesel';
    const GAS            = 'gas';
    const ELECTRIC       = 'electric';
    const HYBRID         = 'hybrid';
    const PLUG_IN_HYBRID = 'plugInHybrid';
}
