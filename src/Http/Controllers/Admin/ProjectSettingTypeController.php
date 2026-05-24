<?php

namespace Otas\ProjectSetting\Http\Controllers\Admin;

use Otas\ProjectSetting\Models\ProjectSettingType;
use Otas\ProjectSetting\Http\Controllers\Controller;
use Otas\ProjectSetting\Filters\Admin\ProjectSettingTypeFilter;
use Otas\ProjectSetting\Http\Resources\Admin\ProjectSettingTypeResource;

class ProjectSettingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProjectSettingTypeFilter $filters
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectSettingTypeFilter $filters)
    {
        $paginationLength = pagination_length(ProjectSettingType::class);
        $ProjectSettingTypes = ProjectSettingType::filter($filters)->paginate($paginationLength);

        return ProjectSettingTypeResource::collection($ProjectSettingTypes);
    }

    /**
     * Display the specified resource.
     *
     * @param ProjectSettingType $ProjectSettingType
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectSettingType $ProjectSettingType)
    {
        return response([
            'project_setting_type' => new ProjectSettingTypeResource($ProjectSettingType),
        ]);
    }
}
