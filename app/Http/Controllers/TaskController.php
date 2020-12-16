<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Task as TaskResource;
use App\Task as TaskModel;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(TaskModel::with('sections')->filter(['state'])->get());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        try {
            $section = new TaskModel;
            $section->fill($request->validated())->save();

            return new TaskResource($section);
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = TaskModel::findOrfail($id);
        return new TaskResource($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
           $section = TaskModel::find($id);
           $section->fill($request->validated())->save();

           return new TaskResource($section);
        } catch(\Exception $exception) {
           throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = TaskModel::findOrfail($id);
        $section->delete();

        return response()->json(null, 204);
    }
}
