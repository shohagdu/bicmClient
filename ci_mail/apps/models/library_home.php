<?php
class library_home extends CI_Model {

   function _construct()
    {
          parent::_construct();
    }
	
	
	public function email($to,$subject,$message){
		
		$from='editor@jfmg.bicm.ac.bd';
		$config['useragent'] = 'Editor:Journal of Financial Markets and Governance, BICM';
        $config['protocol'] = 'smtp';
        $config['mailpath'] = '';
        $config['smtp_host'] = 'webmail.jfmg.bicm.ac.bd'; 
        $config['smtp_user'] = 'editor@jfmg.bicm.ac.bd'; 
        $config['smtp_pass'] = '!jxR!wd_~C&Z';
        $config['smtp_port'] = '25';
        $config['smtp_timeout'] = '5';
        $config['wordwrap'] = TRUE;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['validate'] = FALSE;
        $config['priority'] = 3;
        $config['crlf'] = '\r\n';
        $config['newline'] = '\r\n';
        $config['bcc_batch_mode'] = FALSE;
        $config['bcc_batch_size'] = 200;
        $this->load->library('email');
        $this->email->initialize($config);
		
		$brand='Editor:Journal of Financial Markets and Governance, BICM';
		$this->email->from($from,$brand);
		$this->email->reply_to($from,$from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
		$this->email->send();
	}
}
?>