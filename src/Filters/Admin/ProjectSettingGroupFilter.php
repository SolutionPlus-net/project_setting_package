<?php

namespace Otas\ProjectSetting\Filters\Admin;

use Otas\Filterable\Helpers\QueryFilter;

class ProjectSettingGroupFilter extends QueryFilter
{
    public function search($search = '')
    {
        return $search ? $this->builder->search($search) : $this->builder;
    }
}
