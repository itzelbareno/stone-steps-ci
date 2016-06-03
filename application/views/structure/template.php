<?php
	if($content != 'signup' && $content != 'login' && !isset($_SESSION['user'])){
		redirect(base_url().'login');
	}

	if(($content == 'signup' || $content == 'login') && isset($_SESSION['user'])){
		redirect(base_url());
	}

	$this->load->view('structure/header');
    $this->load->view($content); 
    $this->load->view('structure/footer');
?>