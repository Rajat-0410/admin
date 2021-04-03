<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\DiseaseCategorie;
use Illuminate\Validation\Rule;
use App\Admin;

class DiseaseCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $diseasecategorie = DiseaseCategorie::where('disease_id', $id)->get();
        return response()->json(
        [
            'result' => 'success',
            'data' => $diseasecategorie,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $messages = [
            'title.required' => 'TITLE_REQUIRED',
            'title.unique' => 'TITLE_ALREADY_EXIST',
        ];
        $valid = Validator::make($request->all(), [
            'title' => 'required|unique:disease_categories,title',
        ], $messages);

        if ($valid->fails()) 
        {
            return response()->json(
            [
                'error' => $valid->errors(),
            ], 400);
        }
        
        $diseasecategorie = new DiseaseCategorie;

        $token = $request->header()['token'];
        $admin = Admin::where('admin_token', $token)->firstorfail();
        $admin_id = $admin->id;

        $diseasecategorie->admin_id = $admin_id;
        $diseasecategorie->disease_id = $id;
        $diseasecategorie->title = $request->title;
        if ($request->has('description')) 
        {
            $diseasecategorie->description = $request->description;
        }

        $diseasecategorie->save();

        return response()->json(
        [
            'result' => 'success',
            'data' => $diseasecategorie,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'title.unique' => 'TITLE_ALREADY_EXIST',
        ];
        $valid = Validator::make($request->all(), [
            'title' => [
                Rule::unique('disease_categories')->ignore($id),
            ],
        ], $messages); 
        if ($valid->fails()) 
        {
            return response()->json(
            [
                'error' => $valid->errors(),
            ], 400);
        }

        $input = [];
        if ($request->has('title'))
        {
            $title = $request->title;
            $input['title'] = $title;
        }
        if ($request->has('description'))
        {
            $description = $request->description;
            $input['description'] = $description;
        }

        $diseasecategorie = DiseaseCategorie::where('id', $id)->update($input);
        if ($diseasecategorie == false)
        {
            return response()->json(
            [
                'result' => 'error',
                    'error' => 
                    [
                        'code' => 'DISEASE_CATEGORY_NOT_FOUND',
                    ],
            ], 404);
        }
        return response()->json(
        [
            'result' => 'success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
