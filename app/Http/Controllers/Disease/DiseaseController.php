<?php
namespace App\Http\Controllers\Disease;

use Illuminate\Http\Request;
use App\Http\Models\Disease;
use App\Http\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use Validator;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // echo '<pre>'; print('hello'); exit('controller');
        try {
            $disease =  Disease::get();
            return response()->json([
                'result' => 'success',
                'data' => $disease,
            ], 200);
        } catch (Exception $ex) {
            $status = 0;
            $message = $ex->getMessage();
            return response()->json([
                'result' => 'error',
                'message' => 'SERVER_ERROR'
            ],400);
        }
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
        $messages = [
            'title.required' => 'TITLE_REQUIRED',
            'title.unique' => 'TITLE_ALREADY_EXIST',
            'price.required' => 'PRICE_REQUIRED',
            'price.numeric' => 'PRICE_INVALID_INPUT',
            'discount_price.required' => 'DISCOUNT_PRICE_REQUIRED',
            'discount_price.numeric' => 'DISCOUNT_PRICE_INVALID_INPUT',
            // 'image.required' => 'IMAGE_REQUIRED',
            'description.required' => 'DESCRIPTION_REQUIRED',
        ];
        $valid = Validator::make($request->all(), [
            'title' => 'required|unique:diseases,title',
            'price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            // 'image' => 'required',
            'description' => 'required',
        ], $messages); 
        if ($valid->fails()) 
        {
            return response()->json(
            [
                'error' => $valid->errors(),
            ], 400);
        }
        
        $disease = new Disease;
        
        $token = $request->header()['token'];
        $admin = Admin::where('admin_token', $token)->firstorfail();
        $admin_id = $admin->id;

        $disease->admin_id = $admin_id;
        $disease->title = $request->title;
        $disease->price = $request->price;
        $disease->discount_price = $request->discount_price;
        $disease->description = $request->description;
        if($request->hasFile('image'))
        {
            $file_data = $request->file('image');
            $file_name = $disease->title . '_' . time() . '.png'; //creating new name to save
            Storage::disk('s3')->put('disease/' . $file_name, file_get_contents($file_data), 'public');
            $url = Storage::disk('s3')->url('disease/' . $file_name, $file_name);

            $disease->image_name = $file_name;
            $disease->image_url = $url;
        }
        else
        {
            return response()->json([
                'error' => 'NO_FILE_SELECTED',
            ]);
        }

        $disease->save();

        return response()->json(
        [
            'result' => 'success',
            'data' => $disease,
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
        $disease = Disease::findorfail($id);
        
        return response()->json(
        [
            'result' => 'success',
            'data' => $disease,
        ], 200);
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
            'price.numeric' => 'PRICE_INVALID_INPUT',
            'discount_price.numeric' => 'DISCOUNT_PRICE_INVALID_INPUT',
        ];
        $valid = Validator::make($request->all(), [
            'title' => [
                Rule::unique('diseases')->ignore($id),
            ],
            'price' => 'numeric',
            'discount_price' => 'numeric',
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
        if ($request->hasFile('image'))
        {
            $disease = Disease::where('id', $id)->firstorfail();
            $title = $disease->title;

            $file_data = $request->file('image');
            $file_name = $title . '_' . time() . '.png'; //creating new name to save
            Storage::disk('s3')->put('disease/' . $file_name, file_get_contents($file_data), 'public');
            $url = Storage::disk('s3')->url('disease/' . $file_name, $file_name);

            $input['image_name'] = $file_name;
            $input['image_url'] = $url;

        }
        if ($request->has('price')) 
        {
            $price = $request->price;
            $input['price'] = $price;
        }
        if ($request->has('discount_price')) 
        {
            $discount_price = $request->discount_price;
            $input['discount_price'] = $discount_price;
        }

        $disease = Disease::where('id', $id)->update($input);
        if ($disease == false)
        {
            return response()->json(
            [
                'result' => 'error',
                    'error' => 
                    [
                        'code' => 'DISEASE_NOT_FOUND',
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
