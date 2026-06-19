<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends BaseAdminController {

    public function payment_required()
    {
        $this->data['page_title'] = 'Access Limit Reached';
        $this->theme->title($this->data['page_title'])->load('payment/payment_required', $this->data);
    }
}
