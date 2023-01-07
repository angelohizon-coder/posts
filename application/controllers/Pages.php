<?php

class Pages extends CI_Controller {

    public function view($param = null) {

        if ($param == null || $param == "home.php") {
            $page = "home";

            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
                show_404();
            }

            // $data is an associative array
            $data['title'] = "Blog Posts";
            $data['document'] = $this->Posts_model->get_posts();

            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        } else {
            $page = "post";

            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
                show_404();
            }

            // $data is an associative array
            $data['document'] = $this->Posts_model->get_single_post($param);

            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }

    }

    public function add() {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">',"</div>");
        $this->form_validation->set_rules('title', 'title', "required|min_length[1]|max_length[255]");
        $this->form_validation->set_rules('body', 'body', 'required');

        $this->load->library('form_validation');

        if($this->form_validation->run() == FALSE) {
            $page = "add";

            if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
                show_404();
            }

            $data['header'] = "Add Post";
            $data['error'] = "";

            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        } else {
            $page = "add";
            $result = $this->Posts_model->check_post();

            $data['header'] = "Add Post";
            if ($result >= 1) {
                $data['error'] = "Please enter a unique title";

                $this->load->view('templates/header');
                $this->load->view('pages/'.$page, $data);
                $this->load->view('templates/footer');
            } else {
                $result = $this->Posts_model->insert_post();
                $this->session->set_flashdata('Insert', 'Post was Added');
                // Equivalent of set_flashdata
                // $_SESSION['Insert'] = "Post was added"
                
                redirect(base_url());
            }
        }
    }

    public function edit($param = null) {
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">',"</div>");
        $this->form_validation->set_rules('title', 'title', "required|min_length[1]|max_length[255]");
        $this->form_validation->set_rules('body', 'body', 'required');

        $this->load->library('form_validation');

        $page = "edit";

        // redirects to the edit page
        if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
            show_404();
        }

        if($this->form_validation->run() == FALSE) {
            $data['header'] = "Edit Post";
            $data['id'] = $param;

            $this->load->view('templates/header');
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        } else {
            $this->Posts_model->edit_post();
            redirect(base_url());
        }
    }

    public function delete($param = null) {
        $this->load->library('form_validation');

        $this->Posts_model->delete_post();
        redirect(base_url());
    }

}