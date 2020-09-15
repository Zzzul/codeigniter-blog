<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_post', 'post');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session', 'upload'));
	}

	public function index()
	{
		$data = array(
			'title' => 'CI-Blog',
			'posts' => $this->post->getAllData(),
		);

		$this->load->view('templates/v_header', $data);
		$this->load->view('v_post', $data);
		$this->load->view('templates/v_footer', $data);
	}


	public function detail($slug)
	{
		$postDetail = $this->post->getDetailPost($slug);

		$data = array(
			'posts'			=> $this->post->getAllData(),
			'title'			=> $postDetail['title'],
			'content' 		=> $postDetail['content'],
			'slug' 			=> $postDetail['slug'],
			'date_create'	=> $postDetail['date_create'],
		);

		$this->load->view('templates/v_header', $data);
		$this->load->view('v_detail', $data);
		$this->load->view('templates/v_footer', $data);
	}


	public function add()
	{
		$data = array(
			'title' => 'Add Post',
		);

		$this->load->view('templates/v_header', $data);
		$this->load->view('v_add');
		$this->load->view('templates/v_footer');
	}


	public function save()
	{
		$title = $this->input->post('title');
		$content = $this->input->post('content');

		// validate input           
		$this->form_validation->set_rules('title', 'Title', 'required|is_unique[posts.title]');
		$this->form_validation->set_rules('content', 'Content', 'required');

		// validate image
		if (empty($_FILES['thumbnail']['name'])) {
			$this->form_validation->set_rules('thumbnail', 'Thumbnail', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->add();
		} else {

			$config['upload_path']		= './assets/img/'; //path folder
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp';
			$config['encrypt_name']		= TRUE;

			$this->upload->initialize($config);

			if (!empty($_FILES['thumbnail']['name'])) {
				// if user  uploading image

				if ($this->upload->do_upload('thumbnail')) {
					$img = $this->upload->data();

					//compress Image
					$this->_resizeImage($img['file_name']);

					$thumbnail = $img['file_name'];

					$data = array(
						'title'			=> $title,
						// built in helper CI3
						'slug'			=> url_title($title),
						'thumbnail' 	=> $thumbnail,
						'content' 		=> $content,
						'date_create'	=> date("Y-m-d H:i:s"),
						'last_update'	=> date("Y-m-d H:i:s"),
					);

					// insert data with model
					$this->post->insertPost('posts', $data);

					$this->session->set_flashdata('message', '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Save Succesfully!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					');
					redirect('post/detail/' . url_title($title));
				} else {
					// if uploading image error
					// show error
					$this->session->set_flashdata('message', '
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							' . $this->upload->display_errors() . '
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					');
					redirect('post/detail/' . url_title($title));
				}
			} else {
				// if user not uploading image
				$this->session->set_flashdata('message', '
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
							image is empty or type of image not allowed!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
				');
				redirect('post/detail/' . url_title($title));
			}
		}
	}


	function _resizeImage($file_name)
	{
		// Image resizing config
		$config = array(
			'image_library' => 'GD2',
			'source_image'  => './assets/img/' . $file_name,
			'maintain_ratio' => FALSE,
			'width'         => 600,
			'height'        => 400,
			'new_image'     => './assets/img/resize/' . $file_name
		);

		// load config (built in liblary CI3)
		$this->load->library('image_lib', $config);

		$this->image_lib->initialize($config);
		if (!$this->image_lib->resize()) {
			return false;
		}
		$this->image_lib->clear();
	}


	public function edit($slug)
	{
		// get data from model
		$postDetail = $this->post->getDetailPost($slug);

		$data = array(
			'title'			=> $postDetail['title'],
			'content' 		=> $postDetail['content'],
			'date_create'	=> $postDetail['date_create'],
			'id'			=> $postDetail['id'],
			'slug'			=> $postDetail['slug'],
			'thumbnail'		=> $postDetail['thumbnail'],
		);

		$this->load->view('templates/v_header', $data);
		$this->load->view('v_edit', $data);
		$this->load->view('templates/v_footer', $data);
	}


	public function update()
	{
		$title 			= $this->input->post('title');
		$id				= $this->input->post('id');
		$slug			= $this->input->post('slug');
		$content 		= $this->input->post('content');
		$old_image		= $this->input->post('old_image');
		$last_update 	= date("Y-m-d H:i:s");

		$where = array('id' => $id);

		$no_upload_image = array(
			'title'			=> $title,
			'content'		=> $content,
			'last_update'	=> $last_update,
		);

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');


		if ($this->form_validation->run() == FALSE) {
			redirect('post/edit/' . $slug);
		} else {

			$config['upload_path']		= './assets/img/'; //path folder
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg|bmp';
			$config['encrypt_name']		= TRUE;

			$this->upload->initialize($config);

			// if user upload new image
			if (!empty($_FILES['thumbnail']['name'])) {

				if ($this->upload->do_upload('thumbnail')) {
					$img = $this->upload->data();

					//Compress Image
					$this->_resizeImage($img['file_name']);

					$thumbnail = $img['file_name'];

					$data = array(
						'title'			=> $title,
						'content'		=> $content,
						'last_update'	=> $last_update,
						'thumbnail'   	=> $thumbnail,
					);

					$this->db->update('posts', $data, $where);

					// remove old image thumbnail
					$filename = explode(".", $old_image)[0];
					array_map('unlink', glob(FCPATH . "assets/img/$filename.*"));
					array_map('unlink', glob(FCPATH . "assets/img/resize/$filename.*"));

					$this->session->set_flashdata('message', '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Update Succesfully!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					');
					redirect('post/detail/' . $slug);
				} else {
					// if upload image fail
					echo $this->upload->display_errors();
				}
			} else {
				// if user doesn't upload new image
				$this->db->update('posts', $no_upload_image, $where);
				$this->session->set_flashdata('message', '
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							Update Succesfully!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					');
				redirect('post/detail/' . $slug);
			}
		}
	}


	public function delete($id)
	{
		$where = array('id' => $id);

		$this->post->deletePost($where, 'posts');

		$this->session->set_flashdata('message', '
					<div class="alert alert-success alert-dismissible fade show" role="alert">
							Delete Successfully!
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
				');
		redirect('/');
	}
}
