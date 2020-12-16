<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Section as SectionResource;
use App\Section as SectionModel;
use App\Http\Requests\SectionRequest;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;


class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SectionResource::collection(SectionModel::paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        try {
            $section = new SectionModel;
            $section->fill($request->validated())->save();

            return new SectionResource($section);
        } catch(\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage}");
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
        $section = SectionModel::findOrfail($id);
        return new SectionResource($section);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SectionRequest $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        try {
           $section = SectionModel::find($id);
           $section->fill($request->validated())->save();

           return new SectionResource($section);
        } catch(\Exception $exception) {
           throw new HttpException(400, "Invalid data - {$exception->getMessage}");
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
        $section = SectionModel::findOrfail($id);
        $section->delete();

        return response()->json(null, 204);
    }
}
