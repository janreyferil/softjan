<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Repository\ResourcesEloquent;

use App\Model\User;

class UsersController extends Controller
{
    private $user;
    
    public function __construct(User $user) {
        $this->user = new ResourcesEloquent($user);
    }

    public function index() {
        return $this->user->all();
    }
}
