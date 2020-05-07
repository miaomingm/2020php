<?php

namespace App\Http\Controllers\xin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\xin;
use Validator;
use Illuminate\Validation\Rule;
class XinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $xin_care=request()->xin_care;
        $xin_name=request()->xin_name;
        $where=[];
        if($xin_care){
            $where[]=["xin_care",'like',"%$xin_care%"];
        }
        if($xin_name){
            $where[]=["xin_name",'like',"%$xin_name%"];
        }
        $xin=Xin::where($where)->paginate(1);
        if(request()->ajax()){
            return view('xin.ajaxpage',['xin'=>$xin]);
        }
        return view('xin.index',['xin'=>$xin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('xin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=$request->except('_token');
        //dump($post);
        $request->validate([
            'xin_name'=>'required|unique:xin|regex:/^[\x{4e00-\x{9fa5}\w}]{2,15}$/u',
            //'xin_care'=>'required|numeric|regex:/^[0-9]+.?[0-9]*{18}$/|unique:xin',
            'xin_care'=>'required|numeric|unique:xin',
            'xin_age'=>'required|numeric',
            'xin_is'=>'required',
        ],[
            'xin_name.required'=>'名字必填',
            'xin_name.unique'=>'该名称已存在',
            'xin_name.regex'=>'名字格式为中文，并且长度2-15位',

            'xin_care.required'=>'证件号码必填',
            'xin_care.numeric'=>'证件号码为数字 并且长度为18位',
           // 'xin_care.regex'=>'证件号码为数字 并且长度为18位',
            'xin_care.unique'=>'该证件号码已存在',

            'xin_age.required'=>'年龄必填',
            'xin_age.numeric'=>'年龄为数字',

            'xin_is.required'=>'必填',
        ]);
        if($request->hasFile('xin_img')){
            $post['xin_img']=$this->upload('xin_img');
        }
        $post['xin_time']=time();
        $res=Xin::insert($post);
        //dump($res);
        if($res){
            return redirect('/xin/index');
        }
    }
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            //接受文件
            $file=request()->$filename;
            //上传
            $path=$file->store('uploads');
            return $path;
        }
    }
    public function ajax(Request $request)
    {
       $xin_name=$request->xin_name;
        $res=Xin::where('xin_name',$xin_name)->first();
        //dump($res);
        if($res){
            echo "no";
        }else{
            echo "ok";
        }
    }
    public function ajaxs(Request $request){
        $xin_care=$request->xin_care;
        $res=Xin::where('xin_care',$xin_care)->first();
        //dump($res);
        if($res){
            echo "no";
        }else{
            echo "ok";
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
        $res=Xin::find($id);
        //dump($res);
        return view('xin.update',['res'=>$res]);
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
        $post=$request->except('_token');
        $Validator=Validator::make($post,[
            'xin_name'=>[
                'required',
                Rule::unique('xin')->ignore($id,'xin_id'),
                'regex:/^[\x{4e00-\x{9fa5}\w}]{2,15}$/u',
                
            ],
            'xin_care'=>[
                'required',
                Rule::unique('xin')->ignore($id,'xin_id'),
                
                
            ],
            
            'xin_age'=>'required|numeric',
            'xin_is'=>'required'
        ],[
            'xin_name.required'=>'名字必填',
            'xin_name.unique'=>'该名称已存在',
            'xin_name.regex'=>'名字格式为中文，并且长度2-15位',

            'xin_care.required'=>'证件号码必填',
            'xin_care.numeric'=>'证件号码为数字 并且长度为18位',
           // 'xin_care.regex'=>'证件号码为数字 并且长度为18位',
            'xin_care.unique'=>'该证件号码已存在',

            'xin_age.required'=>'年龄必填',
            'xin_age.numeric'=>'年龄为数字',

            'xin_is.required'=>'必填',
        ]);
        if($Validator->fails()){
            return redirect('/xin/edit/'.$id)->withErrors($Validator)->withInput();
        }
        $post['xin_time']=time();
        $res=Xin::where('xin_id',$id)->update($post);
        if($res!==false){
            return redirect('/xin/index');
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
        $res=Xin::destroy($id);
        return redirect('/xin/index');
    }
}
