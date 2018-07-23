<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Repository\ResourcesEloquent;

use App\Model\User\User;
use App\Model\User\Role;
use App\Model\Education\Subject;
use App\Model\User\UserDetail;

class RegisterController extends Controller
{
    private $user;

    private $role;

    private $subject;

    private $user_detail;
    
    public function __construct(User $user,Role $role,Subject $subject,UserDetail $user_detail) {
        $this->user = new ResourcesEloquent($user);
        $this->role = new ResourcesEloquent($role);
        $this->subject = new ResourcesEloquent($subject);
        $this->user_detail = new ResourcesEloquent($user_detail);
    }

    public function registerUser(Request $request) {

        $role = $this->role->where('role_id',$request->role_id,'first');

        $data = $request->only($this->user->getModel()->fillable);

        $data['user_id'] = $this->user->createID('user_id',9);

        $data['password'] = makeHash($request->password);

        $data['role_id'] = $role->role_id;
        
        $user = $this->user->add($data);

        $subject = $this->subject->where('subject_id', $request->subject_id,'first');
     
        $data_details = array('user_id' => (int)$user->user_id,
        'subject_id' => $subject->subject_id,'user_detail_id' => $this->user_detail->createID('user_detail_id',9));

        $user_detail = $this->user_detail->add($data_details);

        return response()->json([
            'success' => true,
            'user' => $user,
            'user_detail' => $user_detail
        ],200);
  
    }
}
