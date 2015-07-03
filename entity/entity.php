<?php

require_once  'fieldoptions.php';

class EntityField extends SelectField 
{
    public function options() 
    {
        return EntityFieldOptions::build($this);
    }
}
