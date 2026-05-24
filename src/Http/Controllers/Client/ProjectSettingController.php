<?php

namespace Otas\ProjectSetting\Http\Controllers\Client;

use Otas\ProjectSetting\Models\ProjectSetting;
use Otas\ProjectSetting\Http\Controllers\Controller;
use Otas\ProjectSetting\Filters\Client\ProjectSettingFilter;
use Otas\ProjectSetting\Http\Resources\Client\ProjectSettingResource;

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
        $projectSettings = ProjectSetting::returnToClient()->visible()->filter($filters)->with(['projectSettingType', 'phone', 'media', 'translations'])->paginate($paginationLength);

        return ProjectSettingResource::collection($projectSettings);
    }

    /**
     * Display the specified resource.
     *
     * @param ProjectSetting $project_setting
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectSetting $project_setting)
    {
        return response([
            'project_setting' => new ProjectSettingResource($project_setting),
        ]);
    }
}
