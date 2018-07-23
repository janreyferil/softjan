<?php

namespace App\Http\Repository;

use Illuminate\Database\Eloquent\Model;

class ResourcesEloquent implements ResourcesInterface {
  
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function all() {
        $categories = $this->model->all();

        return $categories;
    }

    public function single($id) {
        $category = $this->model->find($id);

        return $category;
    }

    public function add(array $data) {
       $category = $this->model->create($data);

       return $category;
    }

    public function change(array $data,$id) {
       $category = $this->model->find($id);

       $category->update($data);

       return $category;
    }

    public function delete($id) {
       $category = $this->model->find($id);

       $category->delete();
    }

    public function where(string $key,$value,string $option){
        if($option === 'first') {
            return $this->model->where($key,$value)->first();
        } elseif($option === 'get') {
            return $this->model->where($key,$value)->get();
        }
    }

    public function createID(string $key,$len) {
        $generate = generateID($len);
        
        $user_id = $this->model->where($key,$generate)->first();

        if($user_id !== null) {
            $generate = generateID($len);
        }

        return $generate;
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
        return $this;
    }

    public function with($relations) {
        return $this->model->with($relations);
    }

}
