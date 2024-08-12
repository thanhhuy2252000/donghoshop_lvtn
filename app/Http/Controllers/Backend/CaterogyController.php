<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Danhmuc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Redirect;

class CaterogyController extends Controller
{
    public function index(Request $request){
        $query = Danhmuc::query();

        if ($request->filled('filter_id')) {
            $query->where('id', $request->filter_id);
        }
        if ($request->filled('filter_name')) {
            $query->where('tenDM', 'like', '%' . $request->filter_name . '%');
        }

        $caterogys = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->except('page'));
        $userlog =Auth::user();
        return view("backend.caterogy",compact("caterogys","userlog"));
    }
    public function createCaterogyIndex(Request $request){
        $userlog =Auth::user();
        return view("backend.createCaterogy",compact("userlog"));
    }
    public function createCaterogy(Request $request){
        $caterogys= new Danhmuc();
        $existingDM = Danhmuc::where('tenDM', $request->input('tenDM'))->first();
        if ($existingDM) {
            return redirect()->back()->with("error", 'Danh mục đã tồn tại. Vui lòng nhập danh mục khác.');
        }
        $caterogys->tenDM=$request->input('tenDM');
        
        $caterogys->save();
        return redirect()->route('caterogy.index')->with("success","Thêm Danh mục thành công !");
    }
    public function editCaterogyIndex($id){
        $caterogys=Danhmuc::find($id);
        $userlog =Auth::user();
        return view("backend.editCaterogy",compact('caterogys','userlog'));
    }
    public function editCaterogy(Request $request, $id){
        $caterogys= Danhmuc::findOrFail($id);
        $existingDM = Danhmuc::where('tenDM', $request->input('tenDM'))
        ->where('id', '!=', $id)
        ->first();
        if ($existingDM) {
        return redirect()->back()->with("error", 'Danh mục đã tồn tại. Vui lòng nhập danh mục khác.');
        }
        $caterogys->tenDM=$request->input('tenDM');
        
        $caterogys->save();
        return redirect()->route('caterogy.index')->with("success","Sửa thông tin danh mục thành công !");
    }
    public function deleteCaterogy(Request $request, $id){
        $caterogys = Danhmuc::find($id);
        if(!$caterogys) {
            return redirect()->back()->with('error', 'Danh mục không tồn tại.');
        }
        if ($caterogys->dm_sanpham()->exists()) {
            return redirect()->back()->with('error', 'Không thể xóa danh mục này vì có ràng buộc với sản phẩm.');
        }
        $caterogys->delete();
        return redirect()->route('caterogy.index')->with('success','Xóa danh mục thành công');
    }
}
