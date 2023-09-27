<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
{

    public function categoryIndex(Request $request)
    {
        $categories = Category::latest();

        if (!empty($request->get('keyword'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $categories = $categories->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.category.create');
    }

    public function storeCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',

        ]);
        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();


            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id . '.' . $ext;
                $srcPath = public_path() . '/temp/' . $tempImage->name;
                $destPath = public_path() . '/uploads/category/' . $tempImage->name;
                File::copy($srcPath, $destPath);

                // Generate  Image Thumbnail
                $destPath = public_path() . '/uploads/category/thumb/' . $tempImage->name;

                $img = Image::make($srcPath);
                $img->resize(450, 600);
                $img->save($destPath);


                $category->image = $newImageName;
                $category->save();
            }

            $request->session()->flash('success', 'Category added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Category Added'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function editCategory()
    {
    }
    public function updateCategory()
    {
    }
    public function deleteCategory()
    {
    }
}
