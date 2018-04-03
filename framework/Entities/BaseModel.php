<?php

namespace Framework\Entities;

use Framework\Database\TraitActiveRecord;
use Framework\Database\IActiveRecord;
use StdClass;

class BaseModel extends StdClass implements IActiveRecord
{
    use TraitActiveRecord;
}
