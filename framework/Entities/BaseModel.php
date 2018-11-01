<?php

namespace Framework\Entities;

use Framework\Database\ActiveRecord;
use Framework\Database\TraitActiveRecord;
use Framework\Database\IActiveRecord;

class BaseModel extends ActiveRecord implements IActiveRecord
{
    use TraitActiveRecord;
}
