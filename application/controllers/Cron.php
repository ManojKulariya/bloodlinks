<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends BaseFrontController
{
  //Blood Banks

  function expire_payments()
  {
        $this->db->query("
            UPDATE bl_payments p
            JOIN bl_blood_banks bb ON p.bloodbank_id = bb.user_id
            SET 
                bb.payments_approved = 0,
                p.status = 'inactive'
            WHERE p.exp_date < CURDATE()
            AND p.status = 'active'
        ");
  }
}
