<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class election extends CI_Controller{

        function __construct(){
          parent:: __construct();
          $this->load->model('election_model', 'e');
          $this->load->model('voter_model', 'm');
          $this->load->helper('url_helper');
        }

        public function view($slug = NULL)
        {
                $data['election_data'] = $this->e->get_election($slug);
                if (empty($data['election_data']))
                {
                        show_404();
                }
                //$data['Elec_Title'] = $data['election_data']['Elec_Title'];

                $this->load->view('templates/admin_header', $data);
                $this->load->view('admin/overview', $data);
                $this->load->view('templates/admin_footer');
        }

        public function dashboard($page = 'dashboard')
        {
                if ( ! file_exists(APPPATH.'views/election/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }
                //$data['title'] = ucfirst($page); // Capitalize the first letter
                //$this->input->post('check'),

                $data['elections'] = $this->e->getElections();
                $this->load->view('templates/header');
                $this->load->view('election/'.$page, $data);
                $this->load->view('templates/footer');
        }

        public function sort($page = 'dashboard')
        {
                if ( ! file_exists(APPPATH.'views/election/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }
                //$data['title'] = ucfirst($page); // Capitalize the first letter
                //$this->input->post('check'),

                $data['elections'] = $this->e->getSortedElections();
                $this->load->view('templates/header');
                $this->load->view('election/'.$page, $data);
                $this->load->view('templates/footer');
        }

        public function new($page = 'new')
        {
                if ( ! file_exists(APPPATH.'views/election/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }

                $data['title'] = ucfirst($page); // Capitalize the first letter

                $this->load->view('templates/header');
                $this->load->view('election/'.$page, $data);
                $this->load->view('templates/footer');
        }

        public function voterspage($page = 'voters')
        {
                if ( ! file_exists(APPPATH.'views/election/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }

                $data['title'] = ucfirst($page); // Capitalize the first letter

                $data['voters'] = $this->m->getVoters();
                $this->load->view('templates/header');
            		$this->load->view('election/'.$page, $data);
            		$this->load->view('templates/footer');
        }

        public function newvoter($page = 'newvoter')
        {
                if ( ! file_exists(APPPATH.'views/election/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }

                //$data['title'] = ucfirst($page); // Capitalize the first letter

                $data['voters'] = $this->m->getVoters();
                $this->load->view('templates/header');
            		$this->load->view('election/'.$page, $data);
            		$this->load->view('templates/footer');
        }
        public function voters($page = 'voters')
        {
                if ( ! file_exists(APPPATH.'views/admin/'.$page.'.php'))
                {
                        // Whoops, we don't have a page for that!
                        show_404();
                }

                $data['title'] = ucfirst($page); // Capitalize the first letter

                //$data['voters'] = $this->m->getVoters();
                $this->load->view('templates/admin_header');
            		$this->load->view('admin/'.$page, $data);
            		$this->load->view('templates/admin_footer');
        }

        public function create()
        {
          $result = $this->e->CreateElection();
          if($result){
      			$this->session->set_flashdata('success_msg', 'Election Successfully Created.');
      		}else{
      			$this->session->set_flashdata('error_msg', 'Fail to Create Election.');
      		}
          redirect(base_url('election/dashboard'));
        }

        public function createVoter(){
          $result = $this->m->create();
      		if($result){
      			$this->session->set_flashdata('success_msg', 'Record added successfully.');
      		}else{
      			$this->session->set_flashdata('error_msg', 'Fail to add record.');
      		}
      		redirect(base_url('election/voterspage'));
      	}

        public function updateVoter(){
      		$result = $this->m->update();
      		if($result){
      			$this->session->set_flashdata('success_msg', 'Record updated successfully.');
      		}else{
      			$this->session->set_flashdata('error_msg', 'Fail to update record.');
      		}
      		redirect(base_url('election/voterspage'));
      	}

        public function deleteVoter(){
      		$result = $this->m->delete();
      		if($result){
      			$this->session->set_flashdata('success_msg', 'Record deleted successfully.');
      		}else{
      			$this->session->set_flashdata('error_msg', 'Faill to delete record.');
      		}
      		redirect(base_url('election/voterspage'));
      	}
}

?>
