<?php

namespace App\Http\Controllers\Disease;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Models\DiseaseCategorie;
use Validator, Session;

class DiseaseCategorieController extends Controller
{
    public function __construct() {
        parent::__construct();
        $this->viewData['page_title'] = 'Disease Category';
    }

    /*
     * @Date    : Mar 13, 2021
     * @Use     : Show Disease Categorie listing
     * @Params  : -
     * @Cretaed By : Rajat
     */
    public function indexAdminList(Request $request) {
        // Set Page Title
        $this->viewData['page_sub_title'] = 'All Diseases';
        $input = $request->all();
        $keyword = '';
        // $role_id = config('constant.PATIENT');
        if(isset($input['keyword']) && !empty($input['keyword'])){
           $keyword = $input['keyword'];
        }
        // echo '<pre>'; print_r($patient_id);  exit;
       
        $paginate = config('constant.PAGINATE');
        $diseaseCategorieObj = new DiseaseCategorie();
        $arrResp = $diseaseCategorieObj->getDataWithPaginate($paginate,$keyword);
        $allRecords = $arrResp['data'];
        // echo '<pre>'; print_r($allRecords);  exit('controller');

        $this->viewData['all_records'] = $allRecords;
        $this->viewData['keyword'] = $keyword;
        $this->viewData['no_records_found'] = config('constant.NO_RECORDS_FOUND');
        return view('disease-categorie.index',$this->viewData);
    }
    
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
    public function store(Request $request)
    {
        $input = $request->all();
        // echo '<pre>'; print_r($input);  exit;
		$id = !empty($input['id']) ? $input['id'] : 0;
        // Validation => START
        $validator = Validator::make($request->all(), [
            'title'         => 'required|unique:diseases_categories,title,'.$id,
            'description'   => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Validation => END
        // Initialize Variables
        $arrResp = [];
        $action = 'added';
        // Action
        $isUpdate = (isset($input['id']) && !empty($input['id'])) ? true:false;
        // New Menu Object
        $diseaseCategorieObj = new DiseaseCategorie();
        // Pass Data To Model
        if($isUpdate){
            // If Update True Pass Data To Model
            $diseaseCategorieObj->field['id'] = $input['id'];
            $action = 'updated';
        }
        
        $diseaseCategorieObj->field['title'] = $input['title'];
        $diseaseCategorieObj->field['description'] = $input['description'];
        
        if($isUpdate){
            // If Update
            // $arrResp = $diseaseCategorieObj->updateDiseaseCategorie();
            DiseaseCategorie::where("id", $id)->update(['title' => $input['title'], 'description' => $input['description']]);
            $arrResp['status'] = 1;
        } else {
            // If Add
            $arrResp = $diseaseCategorieObj->addUser();
        }
        
        if($arrResp['status']==1){
            // True
            Session::flash('message', "Disease Category has been $action sucessfully."); 
            Session::flash('alert-class', 'alert-success'); 
            Session::flash('icon-class', 'icon fa fa-check');
            return redirect('admin/disease-category');
        } else {
            // False
            Session::flash('message', 'Unable to save Disease Category, please try again later!'); 
            Session::flash('alert-class', 'alert-danger'); 
            Session::flash('icon-class', 'icon fa fa-ban');
            return redirect('admin/disease-category');
        }
        // $messages = [
        //     'title.required' => 'TITLE_REQUIRED',
        //     'title.unique' => 'TITLE_ALREADY_EXIST',
        // ];
        // $valid = Validator::make($request->all(), [
        //     'title' => 'required|unique:disease_categories,title',
        // ], $messages);

        // if ($valid->fails()) 
        // {
        //     return response()->json(
        //     [
        //         'error' => $valid->errors(),
        //     ], 400);
        // }
        
        // $diseasecategorie = new DiseaseCategorie;

        // $token = $request->header()['token'];
        // $admin = Admin::where('admin_token', $token)->firstorfail();
        // $admin_id = $admin->id;

        // $diseasecategorie->admin_id = $admin_id;
        // $diseasecategorie->disease_id = $id;
        // $diseasecategorie->title = $request->title;
        // if ($request->has('description')) 
        // {
        //     $diseasecategorie->description = $request->description;
        // }

        // $diseasecategorie->save();

        // return response()->json(
        // [
        //     'result' => 'success',
        //     'data' => $diseasecategorie,
        // ], 200);
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
        $this->viewData['page_sub_title'] = 'Edit Disease Category';

        $diseaseCategorie = DiseaseCategorie::find(base64_decode($id));
        // echo '<pre>'; print_r($diseaseCategorie); exit;
        $this->viewData['id'] = $diseaseCategorie->id;
        $this->viewData['title'] = $diseaseCategorie->title;
        $this->viewData['description'] = $diseaseCategorie->description;
        $this->viewData['image_name'] = $diseaseCategorie->image_name;
        $this->viewData['image_url'] = $diseaseCategorie->image_url;
        $this->viewData['price'] = $diseaseCategorie->price;
        $this->viewData['discount_price'] = $diseaseCategorie->discount_price;
        $this->viewData['status'] = $diseaseCategorie->status;
        $this->viewData['created_at'] = $diseaseCategorie->created_at;
        // echo '<pre>'; print_r($this->viewData); exit;
        $this->viewData['arr_status'] = config('constant.STATUS');
        $this->viewData['allowfiletypetext'] = config('constant.ALLOW_FILE_TYPE_TEXT');
        $this->viewData['filetype'] = config('constant.File_TYPE');
        
        return view('disease-categorie.edit',$this->viewData);
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
