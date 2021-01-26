<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteBlog;

class SystemController extends Controller
{

    public $successStatus = 200;

    /**
    * Create website blogs.
    *
    * @param  Request  $request
    * @return Response
    */
    public function createWebsiteBlog(Request $request){

        $blog = new WebsiteBlog;
        $blog->subject = $request->subject;
        $blog->description = $request->description;
        $blog->image_url = $request->image_url;
        $blog->save();

        if($blog->save()){
            return response()->json([
                'internalMessage' => 'Blog created successfully!'
            ], 200);
        }else{
            return response()->json([
                'internalMessage' => 'Something went wrong!'
            ], 200);
        }

    }

    /**
    * Retrieve website blog list.
    *
    * @param  Request  $request
    * @return Response
    */
    public function websiteBlogList(Request $request){
        
        
        $columns = array(
            0 => 'id',
        );

        $totalData =  WebsiteBlog::get()->count();

        $totalFiltered = $totalData;

        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->orderColumn];
        $dir = $request->orderDirectory;

        if(empty($request->search)){

        $blogs =  WebsiteBlog::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();

        }else{

        $search = $request->search; 

        $blogs =   WebsiteBlog::where('id','LIKE',"%{$search}%")
                    ->orWhere('subject', 'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->get();

        $totalFiltered = WebsiteBlog::where('id','LIKE',"%{$search}%")
                    ->orWhere('subject', 'LIKE',"%{$search}%")
                    ->get()
                    ->count();
        }

        $data = array();

        if(!empty($blogs)){

            foreach ($blogs as $blogs){

                $nestedData['id'] = $blogs->id;
                $nestedData['subject'] = $blogs->subject;
                $nestedData['description'] = $blogs->description;
                $data[] = $nestedData;  

            }
        
        }

        $json_data = array(
            "draw"            => intval($request->draw),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
            );

        return response()->json($json_data); 

}


}
