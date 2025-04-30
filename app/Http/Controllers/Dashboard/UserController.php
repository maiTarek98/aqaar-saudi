<?php

namespace App\Http\Controllers\Dashboard;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Http\Requests\Dashboard\User\StoreUserRequest;
use App\Http\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Http\Traits\HomeTraits;
class UserController extends Controller
{
    use UploadImageTrait;use HomeTraits;
    private UserRepositoryInterface $userRepository;
    public function __construct(UserRepositoryInterface $userRepository) 
    {     
        $this->middleware('permission:'.request()->account_type.'-list', ['only' => ['index','show']]);
        $this->middleware('permission:'.request()->account_type.'-create', ['only' => ['create','store']]);
        $this->middleware('permission:'.request()->account_type.'-edit', ['only' => ['update','edit']]);
        $this->middleware('permission:'.request()->account_type.'-delete', ['only' => ['destroy','delete_all']]);
        $this->userRepository = $userRepository;
    }
    
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 10);
        $searchQuery = trim($request->query('search'));
        $role = $request->query('role');
        $sortBy = $request->input('sortBy', 'asc');

        // ضبط قيمة account_type إذا كان role موجودًا
        if ($role) {
            if($role == 'user' || $role == 'admin' || $role == 'vendor' || $role == 'subadmin'){
                $request->merge(['account_type' => $role . 's']);
            }else{
                $request->merge(['account_type' =>'admins']);
            }
        }

        $result = User::query();

        // فلترة حسب الدور إذا تم تمرير `role`
        if ($role) {
            $result->whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            });
        } else {
            // الفلترة حسب `account_type` فقط في حالة تمريره
            if ($request->query('account_type')) {
                $accountType = $request->query('account_type');
                if ($accountType === 'admins') {
                    $result->where('account_type', 'admins');
                } else {
                    $result->where('account_type', $accountType);
                }
            }
        }

        // البحث عن المستخدمين
        if ($searchQuery) {
            $result->where(function ($query) use ($searchQuery) {
                $query->where('email', 'like', '%' . $searchQuery . '%')
                    ->orWhere('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('mobile', 'like', '%' . $searchQuery . '%');
            });
        }

        // الفلترة حسب التاريخ
        $queryParameters = $request->query();
        $result = $result->when($request->query('from_date'), function ($query, $from_date) {
                $query->where('created_at', '>=', $from_date);
            })->when($request->query('to_date'), function ($query, $to_date) {
                $query->where('created_at', '<=', $to_date);
            })->with('roles')
            ->forSubadmin()
            ->orderBy('id', $sortBy);
        if ($per_page === 'all') {
            $result = $result->get(); 
        } else {
            $result = $result->paginate((int) $per_page);
            $result->withQueryString();
        }
        if($request->account_type == 'users'){
            $fields = ['id', 'name', 'mobile', 'user_type'];
        }
        else{
            $fields = ['id', 'name', 'mobile', 'email'];
        }
        $model = 'users';

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.crud-table', compact('result', 'fields', 'queryParameters', 'model'))->render(),
            ]);
        }

        return view('admin.users.index', compact('result', 'queryParameters', 'fields', 'model'));
    }


    public function create()
    {
        $user = new User() ;
        $roles=Role::whereNotIn('id',[3,4])->select('id','guard_name','name')->get();
        return view('admin.users.create', compact('user','roles'));
    }
    public function store(StoreUserRequest $request)
    {
        $userDetails = $request->except('_token');
        $user = $this->userRepository->createUser($userDetails);
        if($request->ajax()){

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
            ]);
        }
        if($user == false){
            return redirect()->back()->with('info',trans('messages.done but email will not sent'));
        }
        return redirect()->back()->with('success',trans('messages.AddSuccessfully'));
    }
    public function show(User $user,Request $request)
    {   
        if($user->account_type != $request->account_type){
            abort(404);
        }
        return view('admin.users.show', compact('user'));
    }
    public function edit(User $user)
    {   

        if(auth('web')->check() && auth('web')->user()->id == $user->id || auth('admin')->check()){
                $roles=Role::whereNotIn('id',[3,4])->select('id','guard_name','name')->get();
                $userRole = $user->roles?->pluck('name')->first();
                return view('admin.users.edit', compact('user','roles','userRole'));
        }
        else{
            return back();
        }
    }
    public function update(StoreUserRequest $request, User $user)
    {
        $userDetails = $request->except('_token','_method');
        $this->userRepository->updateUser($user->id, $userDetails);
    
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));
    }

    public function destroy(User $user)
    {
        $this->userRepository->deleteUser($user->id);
        return redirect()->back()->with('success',trans('messages.DeleteSuccessfully'));
    }
    public function userWishlistsDelete($id)
    {
        Wishlist::where('id',$id)->delete();
        return redirect()->back()->with('success',trans('messages.DeleteSuccessfully'));
    }
     public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        if (!is_array($ids)) {
            $ids = explode(",", $ids);
        }
        $ids = array_filter($ids, fn($id) => is_numeric($id));
    
        if (empty($ids)) {
            return response()->json(['error' => 'لم يتم تحديد عناصر للحذف.'], 400);
        }
    
        User::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => trans('messages.RecordsDeleteSuccessfully')]);
    }
    public function changeStatus(User $user,Request $request){
        $request->validate(['status' => 'required|string|in:accepted,blocked,pending']);

        $user->update(['status' => $request->status]);
        return redirect()->back()->with('success',trans('messages.UpdateSuccessfully'));

    }
    
    public function blockClient(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);
        $user = User::find($request->user_id);
        $user->update(['status' => 'blocked']);
        return response()->json(['success' => true, 'message' => trans('messages.user blocked successfully')]);
    }
    public function copyReviewLink(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id']);

        $user = User::find($request->user_id);
        $link = route('orders.review', ['id' => $user->id]);

        return response()->json(['success' => true, 'link' => $link]);
    }


}   