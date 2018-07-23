<?php

namespace App\Http\Middleware;

use Closure;

use App\Http\Repository\ResourcesEloquent;

use App\Model\User\User;
use App\Model\User\Role;
use App\Model\Education\Subject;
use App\Model\User\UserDetail;

class SetupMiddleware
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

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
     
        $roles_check = $this->role->all();
        
        if($roles_check->isEmpty()) {

            $roles = array(array('role_id'=>$this->role->createID('role_id',9),'name' => 'admin'),
            array('role_id'=>$this->role->createID('role_id',9),'name' => 'teacher'),
            array('role_id'=>$this->role->createID('role_id',9),'name' => 'student'));

            foreach($roles as $role) {
  
               $this->role->add($role);
            }

            $users_check = $this->user->all();      
            
            if($users_check->isEmpty()) {
    
                $admin_role = $this->role->where('name','admin','first');
                
                $data = [
                    'user_id' => $this->user->createID('user_id',9),
                    'role_id' => $admin_role->role_id,
                    'email' => 'admin@gmail.com',
                    'password' => ''
                ];
    
                $user = $this->user->add($data);

                $subjects_check = $this->subject->all();

                if($subjects_check->isEmpty()) {

                    $subjects = array('subject_id' => $this->subject->createID('subject_id',9),'name' => 'non subject');

                    $subject = $this->subject->add($subjects);

                    $user_detail_check = $this->user_detail->all();
                  
                    if($user_detail_check->isEmpty()) { 
                        
                        $user_detail = array('user_detail_id' => $this->user_detail->createID('user_detail_id',9),'user_id' => $user->user_id,
                        'subject_id' => $subject->subject_id);
                        
                        $this->user_detail->add($user_detail);

                        return response()->json([
                            'success' => true,
                            'message' => 'Welcome to online class application by SoftJan. I remind you that this account default email is admin@gmail.com and the password is blank or none. Thank you'
                        ],200);
                    }
                }
            }
        }

        // Pre-Middleware Action

        $response = $next($request);

        // Post-Middleware Action

        return $response;
    }
}
