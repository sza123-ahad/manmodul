<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Notifications\OffersNotification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\Facades\Image;
use Spatie\Backup\BackupDestination\Backup;
use Whoops\Run;
use App\Notifications\Pesan;
use Symfony\Component\CssSelector\Node\FunctionNode;

// use Twilio\Rest\Client;


class AdminController extends Controller
{
     
    public function index(){
        $d_user = Auth::user();
        return view('superadmin.beranda',compact('d_user'));
    }

    public function setting(){
        return view('superadmin.setting');
    }

    public function adduser(){
        return view('superadmin.adduser');
    }

    public function prosestambahuser(Request $request){
       $request->validate([
            'username' =>'required',
            'password' =>'required',
            'name' =>'required',
            'akses' =>'required',
        ]);

        $data = $request->all();
        $data ['password'] = Hash::make($request->password);
        $data['password_show'] = $request->password;

        // dd($data);

        Alert::success('Success','Data berhasil disimpan');

        \App\Models\User::create($data);
        // return redirect()->route('tampiluser');
        return redirect('superadmin/tampiluser');
    
    }

    public function tampiluser(){
        $data = \App\Models\User::paginate(5)->withQueryString();
        return view('superadmin.tampiluser',compact('data'));
    }

    public function deleteuser(Request $request){
        
        $data  = $request->id;
   

        foreach ($data as $item){
             DB::table('users')->where('id',$item)->delete();
        }

        Alert::success('Success','Data berhasil dihapus');
        
        return redirect('superadmin/tampiluser');

    }

    public function prosesedituser(Request $request){

        // dd($request->all());

        $request->validate([
            'file_foto' =>'required|mimes:png,jpg|max:10048'
        ]);

       
        // dd($file->getClientOriginalName());

      
        if($request->file()){
            $id = $request->id;
            $file = $request->file('file_foto');

            $fileName = time().'_'.$file->getClientOriginalName();
            $fileExtensi = explode('.',$fileName);
            $fileExtensi = end($fileExtensi);
            $fileName = md5($fileName) . '.' . $fileExtensi;

            $filePath = '/storage/uploads/file_avatar/' . $fileName;

            Image::make($file)->save(storage_path('app/public/uploads/file_avatar/'. $fileName), 10);
           
            $fileModel  = User::find($id);
            $fileModel->file_fhoto = $fileName;
            $fileModel->file_path = $filePath;
            $fileModel->save();

            return back()->with('success','File has been uploaded')->with('file',$fileName);
        }

    
    }

    /******************************** TEMPLATE  ********************************************/
    public function template(){
        return view('superadmin.templatesetting');
    }

    public function editwarna($id){
        DB::table('settings')->where('status','Y')->update(['status'=>'N']);
        $data = \App\Models\Setting::findOrFail($id)->update(['status'=>'Y']);
        
    
        return response()->json($data);
        Alert::success('Success','Data berhasil diubah');

    }

    public function profil(){
        $data  = \App\Models\User::all();
     return view('superadmin.profil',$data);
    }

    public function upimglogin(Request $request){
        // dd($request->all());
        $id = '9';
        $file = $request->file('file');

        $fileName = time().'_'.$file->getClientOriginalName();
        $fileExtensi = explode('.',$fileName);
        $fileExtensi = end($fileExtensi);
        $fileName = md5($fileName) . '.' . $fileExtensi;

        $filePath = '/storage/uploads/file_img_login/' . $fileName;

        Image::make($file)->save(storage_path('app/public/uploads/file_img_login/'. $fileName), 100);
       
        $fileModel  = Setting::find($id);
        $fileModel->image = $fileName;
        $fileModel->path_image = $filePath;
        $fileModel->save();

        return back()->with('success','File has been uploaded')->with('file',$fileName);
    }

    public function simpantitle(Request $request){
        // dd($request->all());
        $uraian = $request->uraian;
        $id = 10;
        \App\Models\Setting::find($id)->update(['uraian' => $uraian]);
        return redirect('superadmin/template')->with('data berhasil disimpan');
    }

    public function bgloginedit(Request $request){
        // dd($request->all());
        $id = '11';
        $file = $request->file('file');

        $fileName = time().'_'.$file->getClientOriginalName();
        $fileExtensi = explode('.',$fileName);
        $fileExtensi = end($fileExtensi);
        $fileName = md5($fileName) . '.' . $fileExtensi;

        $filePath = '/img/' . $fileName;

        // Image::make($file)->save(storage_path('app/public/uploads/file_img_login/'. $fileName), 100);
        // $tes = $request->file->move(storage_path('app/public/uploads/file_bg_login/'.$fileName));
         $request->file->move(public_path('img'),$fileName);
        // dd($tes);

       
        $fileModel  = Setting::find($id);
        $fileModel->image = $fileName;
        $fileModel->path_image = $filePath;
        $fileModel->save();
        return redirect('superadmin/template')->with('data berhasil disimpan');

    }

    public function setdb(){
        return view('superadmin/setdb');
    }

    public function backupdb(){
   
    Artisan::call('backup:run');
    
    }

    public function notif(){
        $user = Auth::user();

        $isi_pesan = [
            'name' => 'Pesan Masuk Hari Ini',
        ];

        $user->notify(new Pesan($isi_pesan));
 

      return redirect('superadmin/template')->with('notifikasi dikirim');
    }

    public function bacanotif($id){
        $notification= auth()->user()->notifications()->find($id);
        if($notification) {
            $notification->markAsRead();
        }
       return redirect('superadmin/template')->with('notifikasi dibaca');
    }

    public function manmenu(){
        $data = \App\Models\Menu::paginate(5)->withQueryString();
        return view('superadmin.manmenu',compact('data'));
    }

    public function simpanmenu(Request $request){
        $id = $request->id;
        if($id == null){
         
           $data = $request->all();  
        \App\Models\Menu::create($data);
        // dd('simpan');
        return redirect('superadmin/manmenu')->with('message', 'Data berhasil disimpan');

        }

        // dd('edit');
        $edit = \App\Models\Menu::find($id);
        $edit->nama_menu =$request->nama_menu;
        $edit->link =$request->link;
        $edit->id_sub_menu = $request->id_sub_menu;
        $edit->status = $request->status;
        $edit->jns_menu = $request->jns_menu;
        $edit->hak_akses =$request->hak_akses;
        $edit->save();
      
        // return view('superadmin.manmenu')->with('data berhasil disimpan');
        return redirect('superadmin/manmenu')->with('message', 'Data berhasil diubah');
    }

    public function apiedit($id){
        $data = \App\Models\Menu::find($id);
        return response()->json($data);
    }

    public function kelolahelper(){
        $data = \App\Models\Fungsi::paginate(10)->withQueryString();
        return view('superadmin/kelolahelper',compact('data'));
    }

    public function searchall(){
        $data = $_GET['value_search'];
        $hsl_cari_fungsi = \App\Models\Fungsi::query()->where('nama_fungsi','LIKE',"%{$data}%")->get();
        $hsl_cari_menu = \App\Models\Menu::query()->where('nama_menu','LIKE',"%{$data}%")->get();
        $all_data = [$hsl_cari_fungsi,$hsl_cari_menu];
        // dd($all_data);
        return view('superadmin/hasilcari',compact('all_data'));
    }


    /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! TEMPLATE !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
    
  
    
   
    
}
