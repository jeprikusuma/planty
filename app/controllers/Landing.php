<?php


class Landing extends Controller{

    public function index(){
        if(Session::find()){
            header('Location:'.BASEURL.'/Auth');
            echo("<script>location.href = '".BASEURL."/Auth';</script>");
        }

        $data['header'] = 'Halo!';
        $this->view('tamplates/header', $data);
        $this->view('landing/index');
        $this->view('tamplates/footer');
    }

}