<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<style type="text/css">
    .body {
        font-family: Jost, sans-serif !important;
    }

    a {
        outline: none;
        text-decoration: none;
        color: #555;
    }

    a:hover,
    a:focus {
        outline: none;
        text-decoration: none;
    }

    img {
        border: 0;
    }

  

    a,
    input,
    button {
        outline: none !important;
    }

    button::-moz-focus-inner {
        border: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
        font-weight: 700;
        color: #202342;
        font-family: 'Muli', sans-serif;
    }

    img {
        border: 0;
        vertical-align: top;
        max-width: 100%;
        height: auto;
    }

    ul,
    ol {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    p {
        margin: 0 0 15px 0;
        padding: 0;
    }

    .container-fluid {
        max-width: 1900px;
    }

    .widget-style3:hover img {
        filter: brightness(0) invert(1) !important;
    }

    /* Common Class */
    .pd-5 {
        padding: 5px;
    }

    .pd-10 {
        padding: 10px;
    }

    .pd-20 {
        padding: 20px;
    }

    .pd-30 {
        padding: 30px;
    }

    .pb-10 {
        padding-bottom: 10px;
    }

    .pb-20 {
        padding-bottom: 20px;
    }

    .pb-30 {
        padding-bottom: 30px;
    }

    .pt-10 {
        padding-top: 10px;
    }

    .pt-20 {
        padding-top: 20px;
    }

    .pt-30 {
        padding-top: 30px;
    }

    .pr-10 {
        padding-right: 10px;
    }

    .pr-20 {
        padding-right: 20px;
    }

    .pr-30 {
        padding-right: 30px;
    }

    .pl-10 {
        padding-left: 10px;
    }

    .pl-20 {
        padding-left: 20px;
    }

    .pl-30 {
        padding-left: 30px;
    }

    .px-30 {
        padding-left: 30px;
        padding-right: 30px;
    }

    .px-20 {
        padding-left: 20px;
        padding-right: 20px;
    }

    .py-30 {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .py-20 {
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .mb-30 {
        margin-bottom: 30px;
    }

    .mb-50 {
        margin-bottom: 20px;
    }

    .font-30 {
        font-size: 20px;
        line-height: 1.46em;
    }

    .font-24 {
        font-size: 24px;
        line-height: 1.5em;
    }

    .font-20 {
        font-size: 15.3px;
        line-height: 1.5em;
    }

    .font-18 {
        font-size: 18px;
        line-height: 1.6em;
    }

    .font-16 {
        font-size: 16px;
        line-height: 1.75em;
    }

    .font-14 {
        font-size: 14px;
        line-height: 1.85em;
    }

    .font-12 {
        font-size: 12px;
        line-height: 2em;
    }

    .weight-300 {
        font-weight: 300;
    }

    .weight-400 {
        font-weight: 400;
    }

    .weight-500 {
        font-weight: 500;
    }

    .weight-600 {
        font-weight: 600;
    }

    .weight-700 {
        font-weight: 700;
    }

    .weight-800 {
        font-weight: 800;
    }

    .text-blue {
        color: #1b00ff;
    }

    .text-dark {
        color: #000000;
    }

    .text-white {
        color: #ffffff;
    }

    .height-100-p {
        height: 100%;
    }

    .bg-white {
        background: #ffffff;
    }

    .border-radius-10 {
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 30px 0;
    }

    .border-radius-100 {
        -webkit-border-radius: 100%;
        -moz-border-radius: 100%;
        border-radius: 100%;
    }

    .box-shadow {
        -webkit-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
        -moz-box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
        box-shadow: 0px 0px 28px rgba(0, 0, 0, .08);
    }

  
    .content-header h1 {
        font-size: 18px;
        /*margin: 0 20px;*/
    }

    .widget-style3 {
        box-shadow: rgb(0 0 0 / 16%) 0px 1px 4px;
        padding: 15px;
        border-radius: 15px;
        position: relative;
        z-index: 1;
        height: 100%;
        transition: .5s;
    }

    .widget-style3:hover:before {
        height: 100%;
        background: #ad1e1d;
    }

    .widget-style3:before {
        position: absolute;
        content: "";
        z-index: -1;
        width: 100%;
        height: 0;
        background: #ad1e1d;
        left: 0;
        bottom: 0;
        transition: .5s;
        border-radius: 15px;
    }

    .widget-style3:hover i {
        color: #fff;
    }

    .widget-style3:hover .weight-500.font-20 {
        color: #fff;
    }

    .widget-style3:hover .text-dark {
        color: #fff !important;
    }

    a.d-block {
        color: #ad1e1d !important;
        font-weight: bold;
    }

    .widget-style3 .widget-data {
        width: calc(100% - 60px);
    }

    .widget-style3 .widget-icon {
        width: 30px;
        height: 50px;
        font-size: 30px;
        line-height: 1;
        margin: 0 15px;
    }

    .widget-style3 i {
        color: black;
    }

    .widget-style3:hover img {
        -webkit-filter: invert(40%) grayscale(100%) brightness(40%) sepia(100%) hue-rotate(-70deg) saturate(400%) contrast(2);
        /* filter: grayscale(100%) brightness(40%) sepia(100%) hue-rotate(-50deg) saturate(600%) contrast(0.8); */
    }

    .apexcharts-legend-marker {
        margin-right: 6px !important;
    }

    .page_title_card {
        display: flex;
        margin-bottom: 6px;
    }

    .page_title_card h5 {
        font-size: 16px;
        font-weight: 500;
        color: gray;
        padding: 0 10px 0 0;
    }

    .content-wrapper {
        background: #fff;
        text-transform: capitalize;
    }

    .super-cards {
        padding: 0 30px;
    }

    .Purchase-card {
        box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;
        padding: 20px;
        height: 100%;
    }

</style>

<section class="content-header">
    <div class="container">
        <div class="timeline">
            <!-- <div class="time-label">
      <span class="bg-red">Consumables Items</span>
      </div> -->
            <div class="card">

                <div class="card-body">

                    <div class="container-fluid pb-3">

                                <div class="row" style="">
                                    <div class="col-xl-3 mb-50">
                                        <a href="#">

                                            <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                                                <div class="d-flex flex-wrap">
                                                    <div class="widget-data">
                                                        <div class="weight-500 font-20">Total blood Request</div>
                                                        <div class="weight-500 font-30 text-dark"><?= $total_req_send ?></div>
                                                    </div>
                                                    <div class="widget-icon">
                                                        <div class="icon"><i class="fa-solid fa-hand-holding-medical"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 mb-50">
                                        <a href="#">

                                            <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                                                <div class="d-flex flex-wrap">
                                                    <div class="widget-data">
                                                        <div class="weight-500 font-20">Blood Request Pending</div>
                                                        <div class="weight-500 font-30 text-dark"><?= $total_req_pending ?></div>
                                                    </div>
                                                    <div class="widget-icon">
                                                        <div class="icon"><i class="fa-solid fa-hourglass-half"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 mb-50">
                                        <a href="#">

                                            <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                                                <div class="d-flex flex-wrap">
                                                    <div class="widget-data">
                                                        <div class="weight-500 font-20">Blood Request Accepted</div>
                                                        <div class="weight-500 font-30 text-dark"><?= $total_req_accepted ?></div>
                                                    </div>
                                                    <div class="widget-icon">
                                                        <div class="icon"><i class="fa-solid fa-circle-check"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-xl-3 mb-50">
                                        <a href="#">
                                            <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                                                <div class="d-flex flex-wrap">
                                                    <div class="widget-data">
                                                        <div class="weight-500 font-20">Blood Request Rejected</div>
                                                        <div class="weight-500 font-30 text-dark"><?= $total_req_rejected?></div>
                                                    </div>
                                                    <div class="widget-icon">
                                                        <div class="icon"><i class="fa-solid fa-circle-xmark"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-xl-3 mb-50">
                                        <a href="<?php echo base_url('admin/donations/discard') ?>">
                                            <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                                                <div class="d-flex flex-wrap">
                                                    <div class="widget-data">
                                                        <div class="weight-500 font-20">Total Blood Issued</div>
                                                        <div class="weight-500 font-30 text-dark"><?= $total_blood_issued ?></div>
                                                    </div>
                                                    <div class="widget-icon">
                                                        <div class="icon"><i class="fa-solid fa-droplet"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 mb-50">
                                        <a href="<?php echo base_url('admin/donations/discard') ?>">
                                            <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                                                <div class="d-flex flex-wrap">
                                                    <div class="widget-data">
                                                        <div class="weight-500 font-20">Blood Issued Received</div>
                                                        <div class="weight-500 font-30 text-dark"><?= $total_blood_rec ?></div>
                                                    </div>
                                                    <div class="widget-icon">
                                                        <div class="icon"><i class="fa-solid fa-box-open"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-3 mb-50">
                                        <a href="<?php echo base_url('admin/donations/discard') ?>">
                                            <div class="bg-white box-shadow border-radius-10 height-100-p widget-style3">
                                                <div class="d-flex flex-wrap">
                                                    <div class="widget-data">
                                                        <div class="weight-500 font-20">Blood Issued Not Received</div>
                                                        <div class="weight-500 font-30 text-dark"><?= $total_blood_rec_not?></div>
                                                    </div>
                                                    <div class="widget-icon">
                                                        <div class="icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>


                            </div>
                    </div>
                </div>
            </div>
</section>