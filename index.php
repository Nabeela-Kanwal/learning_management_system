<?php
$system_name          = $this->db->get_where('settings', array('key' => 'system_name'))->row()->value;
$system_title         = $this->db->get_where('settings', array('key' => 'system_title'))->row()->value;
$user_details         = $this->user_model->get_all_user($this->session->userdata('user_id'))->row_array();
$text_align           = $this->db->get_where('settings', array('key' => 'text_align'))->row()->value;
$logged_in_user_role  = strtolower($this->session->userdata('role'));

// Robust language check (covers multiple builds/storage)
$lang_opt   = strtolower(get_settings('system_language') ?? '');
$lang_opt2  = strtolower(get_settings('language') ?? '');
$lang_sess  = strtolower($this->session->userdata('language') ?? '');
$is_urdu    = ($lang_opt === 'urdu' || $lang_opt2 === 'urdu' || strpos($lang_sess, 'ur') === 0);
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo get_phrase($page_title); ?> | <?php echo $system_title; ?></title>

    <!-- meta tags -->
    <?php include 'metas.php'; ?>

    <!-- core/admin css files -->
    <?php include 'includes_top.php'; ?>

    <!-- Urdu admin CSS MUST load AFTER core css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/urdu-admin.css?v=1.0.4'); ?>">
    <!-- Optional: universal layout fixes (load last, after urdu-admin.css) -->
    <link rel="stylesheet" href="<?php echo base_url('assets/backend/css/admin-fixes.css?v=1.0.2'); ?>">
    <style>
        body .wrapper .content-page {
            position: relative;
            margin-top: -970px !important;
            padding-top: 72px !important;
            min-height: auto !important;
            z-index: 10;
        }
    </style>

</head>

<body class="<?php echo $is_urdu ? 'be-ur rtl' : ''; ?>">
    <!-- HEADER -->
    <?php include 'header.php'; ?>

    <div class="container-fluid">
        <div class="wrapper">
            <!-- SIDEBAR -->
            <?php include $logged_in_user_role . '/navigation.php'; ?>

            <!-- PAGE CONTAINER -->
            <div class="content-page">
                <div class="content">
                    <!-- PAGE CONTENT -->
                    <?php include $logged_in_user_role . '/' . $page_name . '.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- core/admin js files -->
    <?php include 'includes_bottom.php'; ?>
    <?php include 'modal.php'; ?>
    <?php include 'common_scripts.php'; ?>
</body>

</html>
