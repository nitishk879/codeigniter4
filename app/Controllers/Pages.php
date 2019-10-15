<?php namespace App\Controllers;
use App\Models\BlogModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Files\UploadedFile;

class Pages extends Controller {

    public function index(){
        $model = new BlogModel();

        $data = array(
            'blogs'     => $model->getBlog(),
            'title'     =>  'Blogs page for CI4'
        );

        echo view('templates/header', $data);
        echo view('pages/page', $data);
        echo view('templates/footer', $data);
    }

    public function create(){
        helper('form');
        $model = new BlogModel();
        $file = $this->request->getFile('userfile');

        if (! $this->validate([
            'title' => 'required|min_length[3]|max_length[255]',
            'body'  => 'required'
        ])){
            echo view('templates/header', ['title' => 'Create a Blog']);
            echo view('pages/add-blog');
            echo view('templates/footer');

        }else{
            if($file){
                if ($file->isValid() && !$file->hasMoved()){
                    $newName = $file->getName();
                    $file->move(WRITEPATH . 'uploads', $newName);
                }
            }

            $model->save([
                'blog_title' => $this->request->getVar('title'),
                'blog_slug'  => url_title($this->request->getVar('title')),
                'blog_description'  => $this->request->getVar('body'),
                'blog_image'  => $newName,
            ]);

            $data['title'] = 'Blog created Successfully';

            echo view('templates/header', $data);
            echo view('pages/page', $data);
            echo view('templates/footer');
        }
    }
    public function view($slug = NULL){
        $model = new BlogModel();

        $data['blog'] = $model->getBlog($slug);

        if (empty($data['blog']))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: '. $slug);
        }

        $data['title'] = $data['blog']['blog_title'];

        echo view('templates/header', $data);
        echo view('page/view', $data);
        echo view('templates/footer');
    }

    public function about($page = 'about'){
        if ( ! is_file(APPPATH.'/Views/pages/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        echo view('templates/header', $data);
        echo view('pages/'.$page, $data);
        echo view('templates/footer', $data);
    }
}