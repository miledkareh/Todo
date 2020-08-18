<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoriesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api');
    }



    public function getAllCategories(){
        try 
        {
        
        return response()->json(Category::all());
        }catch (\Exception $e) 
        {
            return response()->json( [
                       'entity' => 'tasks', 
                       'action' => 'get', 
                       'result' => 'failed'
            ], 409);
        }
     }


     public function addCategory(Request $request)
     {
         $this->validate($request, [
             'Name' => 'required|string'
         ]);
 
         $category= new Category;
         $category->Name= $request->input('Name');
         $category->save();
         return response()->json($category);
     }

     public function updateCategory(Request $request, $id)
     {
         $this->validate($request, [
             'Name' => 'required|string'
         ]);
 
         $category= Category::find($id);
         $category->Name= $request->input('Name');
        
         $category->save();
         return response()->json($category);
     }

     public function deleteCategory($id){
        Category::findOrFail($id)->delete();
        return 'Deleted Successfully';
     }
}
