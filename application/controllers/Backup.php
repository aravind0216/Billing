<?php

class Backup extends CI_Controller

{

	function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
        $this->load->helper('form');
        $this->load->database();
    }
	
	public function index()
	{
		$this->load->view('backup');
    }
    public function database_backup()
    {
    $this->load->dbutil();
    $db_format=array('format'=>'zip','filename'=>'billing.sql');
    $backup=& $this->dbutil->backup($db_format);
    $dbname='backup-on-'.date('Y-m-d').'.zip';
    $save='assets/db_backup/'.$dbname;
    write_file($save,$backup);
    force_download($dbname,$backup);
  	}
    public function reStore()
    {
     $this->load->database();
    }
    
}




?>