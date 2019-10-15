<?php namespace App\Models;

use CodeIgniter\Model;


class BlogModel extends Model{

    protected $table = 'blog';
    protected $allowedFields = ['blog_title', 'blog_slug', 'blog_description'];

    public function getBlog($slug = false){
        if ($slug === false){
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['blog_slug' => $slug])
            ->first();
    }

}