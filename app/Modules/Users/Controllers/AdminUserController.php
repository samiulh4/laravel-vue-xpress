<?php

namespace App\Modules\Users\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Modules\Users\Models\User;
use App\Modules\Users\Models\UserEducationInfo;
use Illuminate\Support\Str;
use Image;
use Illuminate\Contracts\Encryption\DecryptException;


class AdminUserController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('email'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['email'], $request->get('email')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['email']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                return true;
                            }

                            return false;
                        });
                    }

                })
                ->addColumn('action', function ($row) {
                    $encoded_row_id = encrypt($row->id);
                    $editUrl = url('/admin/user/edit', $encoded_row_id);
                    $btn = "<a href='javascript:void(0)' onclick='openViewModal($row->id)' class='btn btn-sm btn-info' title='View'><i class='fa-solid fa-eye'></i></a>";
                    $btn = $btn . '<a href="'.$editUrl.'" class="btn btn-sm btn-primary" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>';
                    $btn = $btn . '<a href="javascript:void(0)" class="btn btn-sm btn-danger" title="Delete"><i class="fa-solid fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("Users::admin.index");
    }
    public function edit($id)
    {
        try {
            $decoded_row_id  = decrypt($id);
            $editData = User::where('id', $decoded_row_id)->first();
            if(empty($editData)){
                die('No Data Found');
            }
            return view("Users::admin.edit", compact('editData'));
        } catch (DecryptException $e) {
            return $e->getMessage();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }// end -:- edit()

    public function create()
    {
        return view("Users::admin.create");
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {
            DB::beginTransaction();
            try {
                $user = new User;

                $user->name = trim($request->name);
                $user->email = trim($request->email);
                $user->password = bcrypt($request->password);
                $user->user_type_id = $request->user_type_id;
                $user->is_active = 0;
                $user->access_portal = 2;
                $user->phone_no = trim($request->phone_no);
                $user->mobile_no = trim($request->mobile_no);
                $user->national_id = trim($request->national_id);
                $user->passport_no = trim($request->passport_no);
                $user->date_of_birth = date('Y-m-d', strtotime(trim($request->date_of_birth)));

                $user_pic_base64 = $request->user_pic_base64;
                $pos = strpos($user_pic_base64, ';');
                $picture_extention = explode('/', substr($user_pic_base64, 0, $pos))[1];
                $picture_contents = file_get_contents($user_pic_base64);
                $picture_name_temp = 'TEMP_' . date('YmdHis') . '.' . $picture_extention;
                $picture_name = 'USER_' . date('YmdHis') . '.' . $picture_extention;
                $picture_directory = public_path() . '/uploads/images/users/';
                $picture_link = 'uploads/images/users/' . $picture_name;

                file_put_contents($picture_directory . $picture_name_temp, $picture_contents);

                $picture_resize = Image::make($picture_directory . $picture_name_temp);
                $picture_resize->fit(300, 300);
                $picture_resize->save($picture_directory . $picture_name);

                if (file_exists($picture_directory . $picture_name_temp)) {
                    unlink($picture_directory . $picture_name_temp);
                }


                $user->photo = $picture_link;


                $user->save();
                $user_id = $user->id;

                $education_title = $request->education_title;
                $education_result = $request->education_result;
                $education_institution = $request->education_institution;

                if (!empty($education_title[0])) {
                    for ($i = 0; $i < count($education_title); $i++) {
                        $userEducationInfo = new UserEducationInfo;

                        $userEducationInfo->user_id = $user_id;
                        $userEducationInfo->education_title = $education_title[$i];
                        $userEducationInfo->education_result = $education_result[$i];
                        $userEducationInfo->education_institution = $education_institution[$i];

                        $userEducationInfo->save();
                    }
                }
                DB::commit();
                return response()->json([
                    'responseStatus' => true,
                    'message' => 'User information store successfully.'
                ]);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json([
                    'responseStatus' => false,
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return 'This request is not ajax !';
        }
    }// end -:- store()


    public function show($id)
    {

    }





    public function update(Request $request)
    {

    }


}// end -:- AdminUserController
