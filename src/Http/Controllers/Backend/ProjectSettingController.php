<?php

namespace Otas\ProjectSetting\Http\Controllers\Backend;

use Otas\ProjectSetting\Http\Requests\Backend\ProjectSettingStoreRequest;
use Otas\ProjectSetting\Models\ProjectSetting;
use Otas\ProjectSetting\Http\Controllers\Controller;
use Otas\ProjectSetting\Filters\Backend\ProjectSettingFilter;
use Otas\ProjectSetting\Http\Resources\Backend\ProjectSettingResource;
use Otas\ProjectSetting\Http\Requests\Backend\ProjectSettingUpdateRequest;

class ProjectSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProjectSettingFilter $filters
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectSettingFilter $filters)
    {
        $paginationLength = pagination_length(ProjectSetting::class);
        $projectSettings = ProjectSetting::filter($filters)->with(['projectSettingType', 'projectSettingSection', 'phone', 'media'])->paginate($paginationLength);

        return ProjectSettingResource::collection($projectSettings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectSettingStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectSettingStoreRequest $request)
    {
        $projectSetting = $request->storeProjectSetting();

        return response([
            'message' => __('otas/project_settings/project_settings.store'),
            'project_setting' => new ProjectSettingResource($projectSetting),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ProjectSettingUpdateRequest $request
     * @param ProjectSetting $project_setting
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectSettingUpdateRequest $request, ProjectSetting $project_setting)
    {
        $projectSetting = $request->updateProjectSetting();

        return response([
            'message' => __('otas/project_settings/project_settings.update'),
            'project_setting' => new ProjectSettingResource($projectSetting),
        ]);
    }
}
