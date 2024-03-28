<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends BaseController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->model('IndexModel');

		$this->load->view('index', [
			'indexItems' => $this->IndexModel->getIndexItems()
		]);

		//$this->load->model(array('index', 'slider', 'comments'));

		/*
		if ($userToken) {
			$this->cookie->set('user_token', $userToken);

			$message_id = $this->db->query("
			SELECT message_id
			FROM admin_messages
			WHERE user_token = '$userToken'
			AND parent_id IS NULL
			")[0]['message_id'];

			if ($message_id) {
				$this->set('dialog_message_id', $message_id);
			} else {
				$this->set('dialog_message_id', null);
			}
		}
		*/

		/*
		$result = $this->index->getIndexItems();
		if ($result) {
			$this->set('objects_count', ceil(count(get_object_vars($result)) / 2));
		}

		$this->set('comments_list', $this->comments->getComments());
		$this->set('slider_images', $this->slider->getSliderImages());
		$this->set('index_items', $result);
		$this->render('index/index.php');


		$this->load->model('User');
		$this->User->get();
		*/

	}
}
