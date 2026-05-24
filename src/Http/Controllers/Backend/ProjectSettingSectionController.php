<?php

namespace Otas\ProjectSetting\Http\Controllers\Backend;

use Otas\ProjectSetting\Filters\Backend\ProjectSettingSectionFilter;
use Otas\ProjectSetting\Http\Requests\Backend\ProjectSettingSectionStoreRequest;
use Otas\ProjectSetting\Http\Requests\Backend\ProjectSettingSectionUpdateRequest;
use Otas\ProjectSetting\Http\Resources\Backend\ProjectSettingSectionResource;
use Otas\ProjectSetting\Models\ProjectSettingGroup;
use Otas\ProjectSetting\Http\Controllers\Controller;
use Otas\ProjectSetting\Models\ProjectSettingSection;

class ProjectSettingSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProjectSettingGroup $project_setting_group
     * @param ProjectSettingSectionFilter $filters
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectSettingGroup $project_setting_group, ProjectSettingSectionFilter $filters)
    {
        $paginationLength = pagination_length(ProjectSettingSection::class);
        $projectSettingSections = $project_setting_group->projectSettingSections()->filter($filters)->with(['projectSettingGroup', 'projectSettings'])->paginate($paginationLength);

        return ProjectSettingSectionResource::collection($projectSettingSections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectSettingSectionStoreRequest $request
     * @param ProjectSettingGroup $project_setting_group
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectSettingSectionStoreRequest $request, ProjectSettingGroup $project_setting_group)
    {
        $projectSettingSection = $request->storeProjectSettingSection();

        return response([
            'message' => __('otas/project_settings/project_setting_sections.store'),
            'project_setting_section' => new ProjectSettingSectionResource($projectSettingSection),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param ProjectSettingGroup $project_setting_group
     * @param ProjectSettingSection $project_setting_section
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectSettingGroup $project_setting_group, ProjectSettingSection $project_setting_section)
    {
        return response([
            'project_setting_section' => new ProjectSettingSectionResource($project_setting_section),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectSettingSectionUpdateRequest $request
     * @param ProjectSettingGroup $project_setting_group
     * @param ProjectSettingSection $project_setting_section
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectSettingSectionUpdateRequest $request, ProjectSettingGroup $project_setting_group, ProjectSettingSection $project_setting_section)
    {
        $projectSettingSection = $request->updateProjectSettingSection();

        return response([
            'message' => __('otas/project_settings/project_setting_sections.update'),
            'project_setting_section' => new ProjectSettingSectionResource($projectSettingSection),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ProjectSettingGroup $project_setting_group
     * @param ProjectSettingSection $project_setting_section
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectSettingGroup $project_setting_group, ProjectSettingSection $project_setting_section)
    {
        if (!$project_setting_section->remove()) {
            return response([
                'message' => __('otas/project_settings/project_setting_sections.cant_destroy'),
            ], 409);
        }

        return response([
            'message' => __('otas/project_settings/project_setting_sections.destroy'),
        ]);
    }
}
