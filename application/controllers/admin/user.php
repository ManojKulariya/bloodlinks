     <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends BaseAdminController {
public function indexUserRegister(){
		$this->data['page_title']='User Register';

		$this->theme->title($this->data['page_title'])->load('organisations/user_reg', $this->data);
	}	

}