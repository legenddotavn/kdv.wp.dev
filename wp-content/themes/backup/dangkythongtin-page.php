<!--
	Template Name: Đăng ký thông tin
-->
<?php
session_start();
global $wpdb;
$get_ID = get_current_user_id();
$user = wp_get_current_user();
$allowed_roles = array('editor', 'administrator');
$selectid = $wpdb->get_results(
    "
	SELECT ID
	FROM thongtinchung
	WHERE user_id = '$get_ID'
	"
);
$check = $wpdb->num_rows;
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
} elseif ($check > 0) {
    wp_redirect(home_url() . '/xem-thong-tin');
    exit;
}
elseif ($wpdb->num_rows == 0) {
get_header();
ini_set('display_errors', 0);
$current_user = wp_get_current_user();
?>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><?php echo '<a href="' . admin_url() . '">' . '<i class="fa fa-user"></i> ' . $current_user->user_login . '</a>'; ?></li>
                <?php if( array_intersect($allowed_roles, $user->roles ) ): ?>
                    <li><a href="<?php echo home_url() . '/tim-kiem'; ?>"><i class="fa fa-search"></i> Tìm kiếm thông tin KĐV</a></li>
                <?php endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo admin_url(); ?>"><i class="fa fa-cog"></i> Quản lý tài khoản</a></li>
                <li><a href="<?php echo wp_logout_url(home_url()); ?>">Đăng xuất <i class= "fa fa-sign-out"></i></i></a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="header">
        <div class="headerimg">
            <img src="<?php echo bloginfo('template_directory') . '/img/logo.jpg'; ?>" alt="" class="img-responsive"
                 style="margin:10px auto">
        </div>
        <div class="headertitle alert-success">
            <h1>THÔNG TIN KIỂM ĐỊNH VIÊN</h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="luuy bs-callout bs-callout-danger " id="callout-type-b-i-elems">
        <i>Lưu ý:<br>
            Quý Thầy/Cô vui lòng nhập đầy đủ thông tin vào các mục được đánh dấu (*)
        </i>
    </div>
    <?php //echo home_url() . '/xem-thong-tin?submitted=yes'; ?>
    <form action="<?php echo home_url() . '/handle'; ?>" method="post" name="formkdv" id="formkdv" class="form-horizontal">
        <div class="alert alert-info">
            <h4>Phần I: Thông tin cá nhân</h4>
        </div> <!-- title -->
        <div class="hovaten form-group">
            <label class="control-label col-sm-3" for="hovatendem">Họ và tên đệm (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="hovatendem" id="hovatendem" value="<?php echo $_POST['hovatendem']; ?>">
            </div>
            <div class="col-sm-3">
                <span style="color:red;display:none;line-height:38px;" id="hovatendem_error"></span>
            </div>
        </div> <!-- hovaten -->
        <div class="form-group">
            <label class="control-label col-sm-3" for="ten">Tên (*)</label>
            <div class="col-sm-4">
                <input class="form-control" type="text" name="ten" id="ten" value="<?php echo $_POST['ten']; ?>">
            </div>
            <div class="col-sm-3">
                <span style="color:red;display:none;line-height:38px;" id="ten_error"></span>
            </div>
        </div>
        <div class="ngaysinh form-group">
            <label class="control-label col-sm-3" for="ngaysinh">Ngày sinh (*)</label>
            <div class="col-sm-4">
                <input type="text" class="datepicker form-control" name="ngaysinh" id="ngaysinh" value="<?php echo $_POST['ngaysinh']; ?>"> (Theo định dạng ngày-tháng-năm)
            </div>
            <div class="col-sm-3">
                <span style="color:red;display:none;line-height:38px;" id="ngaysinh_error"></span>
            </div>
        </div>
        <div class="gioitinh form-group">
            <label class="control-label col-sm-3" for="gioitinh">Giới tính (*)</label>
            <div class="col-sm-4">
                <?php if ($_POST['gioitinh'] == 1)
                    echo "<label class='radio-inline'><input type='radio' name='gioitinh' id='nam' value='1' checked/>Nam</label>
    					  <label class='radio-inline'><input type='radio' name='gioitinh' id='nu' value='2' />Nữ</label>";
                elseif ($_POST['gioitinh'] == 2) {
                    echo "<label class='radio-inline'><input type='radio' name='gioitinh' id='nam' value='1'/>Nam</label>
    					  <label class='radio-inline'><input type='radio' name='gioitinh' id='nu' value='2'  checked/>Nữ</label>";
                } else echo "<label class='radio-inline'><input type='radio' name='gioitinh' id='nam' value='1'/>Nam</label>
    						  <label class='radio-inline'><input type='radio' name='gioitinh' id='nu' value='2'/>Nữ</label>";
                ?>
            </div>
        </div> <!-- gioitinh -->
        <div class="quequan form-group">
            <label class="control-label col-sm-3" for="quequan">Quê quán (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="quequan" value="<?php echo $_POST['quequan']; ?>">
            </div>
            <div class="col-sm-3">
            <span style="color:red;display:none;line-height:38px;" id="quequan_error"></span>
            </div>
        </div> <!-- quequan -->
        <div class="noicongtac form-group">
            <label class="control-label col-sm-3" for="noicongtac">Nơi công tác (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="noicongtac" style="" value="<?php echo $_POST['noicongtac']; ?>">
            </div>
        </div> <!-- noicongtac -->
        <div class="thamniencongtac form-group">
            <label class="control-label col-sm-3" for="thamniencongtac">Thâm niên công tác (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="thamniencongtac" style="" value="<?php echo $_POST['thamniencongtac']; ?>">
            </div>
            <div class="col-sm-1">
                <span style="line-height:38px">năm</span>
            </div>
        </div> <!-- thamniencongtac -->
        <div class="alert alert-info">
            <h4>Phần II: Thông tin liên lạc</h4>
        </div> <!-- title -->
        <div class="diachilienhe form-group">
            <label class="control-label col-sm-3" for="diachilienhe">Địa chỉ liên hệ (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="diachilienhe" style="" value="<?php echo $_POST['diachilienhe']; ?>">
            </div>
        </div> <!-- diachilienhe -->
        <div class="dienthoaicodinh form-group">
            <label class="control-label col-sm-3" for="dienthoaicodinh">Điện thoại cố định</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="dienthoaicodinh" style="" value="<?php echo $_POST['dienthoaicodinh']; ?>">
            </div>
        </div> <!-- dienthoaicodinh -->
        <div class="dienthoaididong form-group">
            <label class="control-label col-sm-3" for="dienthoaididong">Điện thoại di động (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="dienthoaididong" style="" value="<?php echo $_POST['dienthoaididong']; ?>">
            </div>
        </div> <!-- dienthoadidong -->
        <div class="email form-group">
            <label class="control-label col-sm-3" for="emaillienhe">Email liên hệ (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="emaillienhe" style="" value="<?php echo $_POST['emaillienhe']; ?>">
            </div>
        </div> <!-- email -->
        <div class="fax form-group">
            <label class="control-label col-sm-3" for="fax">Fax</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="fax" style="" value="<?php echo $_POST['fax']; ?>">
            </div>
        </div> <!-- fax -->
        <div class="alert alert-info">
            <h4>Phần III: Trình độ chuyên môn, nghiệp vụ</h4>
        </div> <!-- title -->
        <div class="hochamhocvi form-group">
            <label class="control-label col-sm-3" for="chucdanh">Chức danh (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="chucdanh" style="" value="<?php echo $_POST['chucdanh']; ?>">
            </div>
        </div> <!-- hochamhocvi -->
        <div class="hochamhocvi form-group">
            <label class="control-label col-sm-3" for="hocvi">Học vị (*)</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="hocvi" style="" value="<?php echo $_POST['hocvi']; ?>">
            </div>
        </div> <!-- hochamhocvi -->
        <div class="linhvucchuyenmon form-group">
            <label class="control-label col-sm-3" for="linhvucchuyenmon">Lĩnh vực chuyên môn (*)</label>
            <div class="col-sm-4">
            <?php
                $linhvucchuyenmon = $wpdb->get_results
                (
                    'SELECT * from danhmucmanganh',
                    ARRAY_N
                );
            ?>
            <select name="linhvucchuyenmon" class="form-control" id="linhvucchuyenmon">
                <option value="0">Vui lòng chọn</option>}
                option
                <?php
                foreach ($linhvucchuyenmon as $key) { ?>
                    <option value="<?php echo $key[1]; ?>"><?php echo $key[1]; ?></option>
                <?php } ?>
            </select>
            </div>
        </div> <!-- end .linhvucchuyenmon -->
        <div class="chuyennganhdaotaobacthacsi form-group">
            <label class="control-label col-sm-3" for="chuyennganhdaotaothacsi">Chuyên ngành thạc sĩ (*)</label>
            <div class="col-sm-12">
                <table id="trinhdothacsi" class="table table-striped table-hover table-bordered trinhdothacsi margin-top">
                    <tr class="success">
                        <td align="center">Chuyên ngành đào tạo thạc sĩ</td>
                        <td align="center">Nơi đào tạo tiến sĩ</td>
                        <td align="center">Năm cấp bằng</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" align="center" class="form-control" placeholder="Chuyên ngành đào tạo" name="chuyennganhthacsi[]" value="<?php echo $data[2]; ?>"></td>
                        <td align="center"><input type="text" align="center" class="form-control" placeholder="Nơi đào tạo" name="noidaotaothacsi[]" value="<?php echo $data[3]; ?>"></td>
                        <td align="center"><input type="text" align="center" class="form-control" placeholder="Năm cấp bằng" name="namcapbangthacsi[]" value="<?php echo $data[4]; ?>"></td>
                        <td align="center"><button type="button" class="btn btn-danger delete btn-sm">Xóa</button></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12">
                <button class="themtrinhdothacsi btn btn-success btn-sm" type="button" id="themtrinhdothacsi"><i class="fa fa-plus"></i></button>
            </div>
        </div> <!-- ./chuyennganhdaotaobacthacsi -->
        <div class="chuyennganhdaotaobactiensi form-group">
            <label class="control-label col-sm-3" for="chuyennganhdaotaotiensi">Chuyên ngành tiến sĩ (*)</label>
            <div class="col-sm-12">
                <table id="trinhdotiensi" class="table table-striped table-hover table-bordered trinhdotiensi margin-top">
                    <tr class="success">
                        <td align="center">Chuyên ngành đào tạo tiến sĩ</td>
                        <td align="center">Nơi đào tạo tiến sĩ</td>
                        <td align="center">Năm cấp bằng</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" align="center" class="form-control" placeholder="Chuyên ngành đào tạo" name="chuyennganhtiensi[]" value="<?php echo $data[2]; ?>"></td>
                        <td align="center"><input type="text" align="center" class="form-control" placeholder="Nơi đào tạo" name="noidaotaotiensi[]" value="<?php echo $data[3]; ?>"></td>
                        <td align="center"><input type="text" align="center" class="form-control" placeholder="Năm cấp bằng" name="namcapbangtiensi[]" value="<?php echo $data[4]; ?>"></td>
                        <td align="center"><button type="button" class="btn btn-danger delete btn-sm">Xóa</button></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-2">
                <button class="themtrinhdotiensi btn btn-success btn-sm" type="button" id="themtrinhdotiensi" ><i class="fa fa-plus"></i></button>
            </div>
        </div>
            <div class="chungchidaotaokiemdinhvien form-group">
                <label class="control-label col-sm-3" for="cckdv">Chứng chỉ Kiểm định viên (*)</label>
                <div class="col-sm-4">
                <?php
                if ($_POST['cckdv'] == 1) {
                    echo ' <label class="radio-inline"><input type="radio" name="cckdv" value="1" checked /> Có </label>
										<label class="radio-inline"><input type="radio" name="cckdv" value="2" /> Không </label>';
                } elseif ($_POST['cckdv'] == 2) {
                    echo ' <label class="radio-inline"><input type="radio" name="cckdv" value="1"  /> Có </label>
										<label class="radio-inline"><input type="radio" name="cckdv" value="2" checked /> Không </label>';
                } else echo ' <label class="radio-inline"><input type="radio" name="cckdv" value="1"  /> Có </label>
										<label class="radio-inline"><input type="radio" name="cckdv" value="2" /> Không </label>';
                ?>
                </div>
            </div> <!-- cckiemdinhvien -->
            <div id="sochungchi" class="form-group">
                <label class="control-label col-sm-2  col-sm-offset-1" for="socc">Số chứng chỉ</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="sochungchi" <?php echo $_POST['cckdv'] != 1 ? 'disabled="disabled"' : ''; ?> value="<?php echo $_POST['sochungchi']; ?>">
                </div>
                <label class="control-label col-sm-2" for="ngaycap">Ngày cấp</label>
                <div class="col-sm-3">
                    <input type="text" class="datepicker form-control" name="ngaycapcc" <?php echo $_POST['cckdv'] != 1 ? 'disabled="disabled"' : ''; ?> value="<?php echo $_POST['ngaycapcc']; ?>">
                </div>
            </div> <!-- socc -->
            <div class="thekiemdinhvien form-group">
                <label class="control-label col-sm-3" for="thekiemdinhvien">Thẻ kiểm định viên</label>
                <div class="col-sm-4">
                <?php
                if ($_POST['thekdv'] == 1) {
                    echo ' <label class="radio-inline"><input type="radio" name="thekdv" value="1" checked /> Có </label>
										<label class="radio-inline"><input type="radio" name="thekdv" value="2" /> Không </label>';
                } elseif ($_POST['thekdv'] == 2) {
                    echo ' <label class="radio-inline"><input type="radio" name="thekdv" value="1"  /> Có </label>
										<label class="radio-inline"><input type="radio" name="thekdv" value="2" checked /> Không </label>';
                } else echo ' <label class="radio-inline"><input type="radio" name="thekdv" value="1"  /> Có </label>
										<label class="radio-inline"><input type="radio" name="thekdv" value="2" /> Không </label>';
                ?>
                </div>
            </div>
            <div id="sothe" class="form-group">
                <label class="control-label col-sm-1 col-sm-offset-2" for="sothe">Số thẻ</label>
                <div class="col-sm-3">
                <input class="form-control" type="text"
                                           name="sothekdv" <?php echo $_POST['thekdv'] != 1 ? 'disabled="disabled"' : ''; ?>
                                           value="<?php echo $_POST['sothekdv']; ?>">
                </div>
                <label class="control-label col-sm-2" for="ngaycap">Ngày cấp</label>
                <div class="col-sm-3">
                <input type="text" class="datepicker form-control"
                                                  name="ngaycapthe" <?php echo $_POST['thekdv'] != 1 ? 'disabled="disabled"' : ''; ?>
                                                  value="<?php echo $_POST['ngaycapthe']; ?>">
                </div>
            </div> <!-- sothe -->
            <div class="trinhdongoaingu form-group">
                <label class="control-label col-sm-3" for="trinhdongoaingu">Trình độ ngoại ngữ (*)</label>
                <div class="col-sm-12">
                <table id="trinhdongoaingu" class="ngoaingu table table-striped table-hover table-bordered margin-top" cellpadding="2" cellspacing="0">

                    <tr style="font-weight:bold; font-size:17px;" class="success">
                        <td style="text-align:center">Ngoại ngữ</td>
                        <td style="text-align:center">Nghe</td>
                        <td style="text-align:center">Nói</td>
                        <td style="text-align:center">Đọc</td>
                        <td style="text-align:center">Viết</td>
                        <td style="text-align:center"></td>
                    </tr>
                    <tr>
                        <td align="center">
                            <select name="ngoaingu[]" class="form-control">
                                <option value="0">Chọn ngoại ngữ</option>
                                <option value="1">Tiếng Anh</option>
                                <option value="2">Tiếng Pháp</option>
                                <option value="3">Tiếng Nga</option>
                                <option value="4">Tiếng Đức</option>
                                <option value="5">Ngoại ngữ khác</option>
                            </select>
                            <input class="form-control" type="text" name="ngoaingukhac[]" value="" placeholder=""
                                   style="display: none;margin-top:5px;">
                        </td>
                        <td align="center">
                            <select name="nghe[]" class="form-control">
                                <option value="1">Tốt</option>
                                <option value="2">Khá</option>
                                <option value="3">Trung bình</option>
                                <option value="4">Yếu</option>
                            </select>
                        </td>
                        <td align="center">
                            <select name="noi[]" class="form-control">
                                <option value="1">Tốt</option>
                                <option value="2">Khá</option>
                                <option value="3">Trung bình</option>
                                <option value="4">Yếu</option>
                            </select>
                        </td>
                        <td align="center">
                            <select name="doc[]" class="form-control">
                                <option value="1">Tốt</option>
                                <option value="2">Khá</option>
                                <option value="3">Trung bình</option>
                                <option value="4">Yếu</option>
                            </select>
                        </td>
                        <td align="center">
                            <select name="viet[]" class="form-control">
                                <option value="1">Tốt</option>
                                <option value="2">Khá</option>
                                <option value="3">Trung bình</option>
                                <option value="4">Yếu</option>
                            </select>
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-danger delete btn-sm">Xóa</button>
                        </td>
                    </tr>
                </table>
                </div>
                <div class="col-sm-12">
                <button id="them_ngoai_ngu" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></button>
                </div>
            </div> <!-- trinhdongoaingu -->
            <div class="trinhdotinhoc form-group">
                <label class="control-label col-sm-3" for="trinhdotinhoc">Trình độ tin học (*)</label>
                <div class="col-sm-4">
                    <input type="text" name="trinhdotinhoc" class="form-control" value="<?php echo $_POST['trinhdotinhoc']; ?>">
                </div>
                <div class="col-sm-3">
                    <span style="color:red;display:none;line-height:38px;" id="trinhdotinhoc_error"></span>
                </div>
            </div> <!-- trinhdotinhoc -->
            <div class="alert alert-info">
                <h4>Phần IV: Quá trình công tác</h4>
            </div> <!-- title -->
            <div class="quatrinhcongtac form-group">
                <div class="col-sm-12">
                <table id="quatrinhcongtac" cellpadding="2" cellspacing="0" class="table table-striped table-hover table-bordered">
                    <tr style="font-weight:bold; font-size:17px;" class="success">
                        <td align="center">Thời gian</td>
                        <td align="center">Nơi công tác</td>
                        <td align="center">Chức vụ</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><input type="text" class="form-control" name="thoigianct[]"
                                                  placeholder="   Thời gian"
                                                  value=""></td>
                        <td align="center"><input type="text" class="form-control" name="noicongtac_quatrinh[]"
                                                  placeholder="   Nơi công tác"
                                                  value=""></td>
                        <td align="center"><input type="text" class="form-control" name="chucvu[]"
                                                  placeholder="   Chức vụ" value="">
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-danger delete btn-sm">Xóa</button>
                        </td>
                    </tr>
                </table>
                </div>
                <div class="col-sm-12">
                <button class="themquatrinhcongtac btn btn-success btn-sm" type="button"><i class="fa fa-plus"></i></button>
                </div>
            </div> <!-- quatrinhcongtac -->
            <div class="alert alert-info">
                <h4>Phần V: Kinh nghiệm trong Đảm bảo và Kiểm định chất lượng</h4>
            </div> <!-- title -->
            <div class="thamgiadgn form-group">
                <label class="control-label col-sm-6" for="thamgiadgn">Thầy/Cô đã từng tham gia đoàn Đánh giá ngoài (ĐGN) chưa? (*)</label>
                <div class="col-sm-4">
                <?php if ($_POST['thamgiadgn'] == 1) {
                    echo '<label class="radio-inline"><input type="radio" name="thamgiadgn" value="1" checked/> Có </label>
										<label class="radio-inline"><input type="radio" name="thamgiadgn" value="2" /> Không </label>';
                } elseif ($_POST['thamgiadgn'] == 2) {
                    echo '<label class="radio-inline"><input type="radio" name="thamgiadgn" value="1" /> Có </label>
										<label class="radio-inline"><input type="radio" name="thamgiadgn" value="2" checked/> Không </label>';
                } else echo '<label class="radio-inline"><input type="radio" name="thamgiadgn" value="1" /> Có </label>
										<label class="radio-inline"><input type="radio" name="thamgiadgn" value="2"/> Không </label>';

                ?>
                </div>
            </div>    <!-- thamggiadgn -->
            <div class="bangthamgiadgn" style="display:none">
                <table id="thamgiadgn" cellpadding="2" cellspacing="0" class="thamgiadgn table table-striped table-bordered">
                    <tr class="success">
                        <td align="center">Đơn vị tổ chức</td>
                        <td align="center">Đơn vị được đánh giá</td>
                        <td align="center">Vai trò trong đoàn</td>
                        <td align="center">Tiêu chuẩn được phân công</td>
                        <td></td>
                    </tr>
                    <tr class="lv1">
                        <td align="center">
                            <select name="donvitochuc1" class="donvitochuc1 form-control">
                                <?php
                                $kq_select_don_vi_to_chuc = $wpdb->get_results('SELECT * FROM cacdonvitochucdgn', ARRAY_N);
                                foreach ($kq_select_don_vi_to_chuc as $row) {
                                    echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                                }
                                ?>

                                <!-- <option value="4">Đơn vị khác</option> -->
                            </select>
                        </td>
                        <td align="center">
                            <input type="text" name="donviduocdanhgia1" value="" placeholder="" class="form-control">
                        </td>
                        <td align="center">
                            <select name="vaitrotrongdoan1" class="vaitrotrongdoan1 form-control">
                                <option value="1">Trưởng đoàn</option>
                                <option value="2">Thư ký Đoàn</option>
                                <option value="3">Thành viên Đoàn</option>
                                <option value="4">Tổ thư ký</option>
                                <option value="5">Quan sát viên</option>
                            </select>
                        </td>
                        <td align="center">
                            <table>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox" name="row1tc[]" value="1"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="2"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="3"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="4"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="5"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="6"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="7"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="8"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="9"></td>
                                    <td><input type="checkbox" name="row1tc[]" value="10"></td>
                                </tr>
                            </table>
                        </td>
                        <td align="center">
                            <button type="button" class="btn btn-danger delete btn-sm">Xóa</button>
                        </td>
                    </tr>

                </table>
                <button id="themthamgiadgn" type="button" class="btn btn-success btn-sm">
                    <i class="fa fa-plus"></i>
                </button>
                <input type="hidden" id="countthamgiadgn" name="countthamgiadgn" value="<?php echo isset($_POST['countthamgiadgn']) ? $_POST['countthamgiadgn'] : '1'; ?>">
            </div> <!-- bangthamgiadgn -->
            <div class="kinhnghiemvietbc form-group">
                <label class="control-label col-sm-6" for="kinhnghiemvietbc">Thầy/Cô đã có kinh nghiệm viết báo cáo tự đánh giá chưa? (*)</label>
                <div class="col-sm-4">
                <?php if ($_POST['kinhnghiemvietbc'] == 1) {

                    echo '<label class="radio-inline"><input type="radio" name="kinhnghiemvietbc" value="1" checked/> Có </label>
										<label class="radio-inline"><input type="radio" name="kinhnghiemvietbc" value="2" /> Không </label>';
                } elseif ($_POST['kinhnghiemvietbc'] == 2) {
                    echo '<label class="radio-inline"><input type="radio" name="kinhnghiemvietbc" value="1" /> Có </label>
										<label class="radio-inline"><input type="radio" name="kinhnghiemvietbc" value="2" checked/> Không </label>';
                } else echo '<label class="radio-inline"><input type="radio" name="kinhnghiemvietbc" value="1" /> Có </label>
										<label class="radio-inline"><input type="radio" name="kinhnghiemvietbc" value="2"/> Không </label>';

                ?>
                </div>
            </div> <!-- kinhnghiemvietbc -->
            <div class="cackhoahocdambaovakiemdinhchatluong form-group">
                <label class="control-label col-sm-8 col-sm-offset-1" for="cackhoahocdambaovakiemdinhchatluong">Các khóa học liên quan đến Đảm bảo và Kiểm định chất lượng mà Thầy/Cô đã từng tham gia</label>
                <div class="col-sm-12">
                <table id="cackhoahocdambaovakiemdinhchatluong" cellpadding="2" cellspacing="0"class="table table-striped table-bordered margin-top">
                    <tr class="success">
                        <td align="center">Tên khóa học</td>
                        <td align="center">Thời gian</td>
                        <td align="center">Nơi đào tạo</td>
                        <td align="center"></td>
                    </tr>
                    <tr>
                        <td align="center"><input class="form-control" type="text" name="khoahoc[]"
                                                  placeholder="   Nhập tên Khóa học"
                                                  value=""></td>
                        <td align="center"><input class="form-control" type="text" name="thoigiankh[]"
                                                  placeholder="   Thời gian"
                                                  value=""></td>
                        <td align="center"><input class="form-control" type="text" name="noidaotao[]"
                                                  placeholder="   Nơi đào tạo"
                                                  value=""></td>
                        <td align="center">
                            <button type="button" class="btn btn-danger delete btn-sm">Xóa</button>
                        </td>
                    </tr>
                </table>
                </div>
                <div class="col-sm-12">
                <button class="themkhoahoc btn btn-success btn-sm" type="button"><i class="fa fa-plus"></i></button>
                </div>
            </div> <!-- cackhoahocdambaovakiemdinhchatluong -->
            <div class="kinhnghiemkhac form-group">
                <label class="control-label col-sm-8" for="kinhnghiemkhac">Những kinh nghiệm khác liên quan đến Đảm bảo và Kiểm định chất lượng giáo dục</label>
                <div class="col-sm-12 margin-top">
                    <textarea name="kinhnghiemkhac" class="form-control" style="font-size:17px;width:100%;" rows="5"
                          value="<?php echo $_POST['kinhnghiemkhac']; ?>"></textarea>
                </div>
            </div> <!-- nhungkinhnghiemkhac -->
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="submit" value="Hoàn tất" name="create" class="btn btn-success centered">
                </div>
            </div>     
    </form>
</div>
</div> <!-- container -->
<script type="text/javascript" src="<?php echo bloginfo('template_directory') . '/js/jquery-1.11.2.min.js'; ?>"></script>
<script src="<?php echo bloginfo('template_directory') . '/js/jquery-ui.min.js'; ?>"></script>
<script src="<?php echo bloginfo('template_directory') . '/js/bootstrap.min.js'; ?>"></script>
<script type="text/javascript">

    $(function () {
        /* === Add datepicker functioN to ngaysinh input === */
        $(".datepicker").datepicker({yearRange:'1930:2020',
            numberOfMonths: 1,  dateFormat: 'dd-mm-yy',
            monthNames: ['Một','Hai','Ba','Tư','Năm','Sáu','Bảy','Tám','Chín', 
            'Mười','Mười một','Mười hai'] ,
            monthNamesShort: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5',
            'Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'] ,
            dayNames: ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm',
             'Thứ sáu', 'Thứ bảy'],
            dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
            // showOn: 'both',
            changeMonth: true , changeYear: true,
            currentText: 'Hôm nay', weekHeader: 'Tuần'
        });

        /* === Them trinh do thac si === */
        $("#themtrinhdothacsi").click
        (
            function()
            {
                $(".trinhdothacsi tr:last").after
                (
                    '<tr>'+
                        '<td align="center"><input type="text" class="form-control" name="chuyennganhthacsi[]" placeholder="Chuyên ngành đào tạo"></td>'+
                        '<td align="center"><input type="text" class="form-control" name="noidaotaothacsi[]"  placeholder="Nơi đào tạo"></td>'+
                        '<td align="center"><input type="text" class="form-control" name="namcapbangthacsi[]" placeholder="Năm cấp bằng"></td>'+
                        '<td align="center"><button type="button" class="btn btn-danger delete btn-sm">Xóa</button></td>'+
                    '</tr>'
                );
            }
        );

        /* === Them trinh do tien si === */
        $("#themtrinhdotiensi").click(
            function()
            {
                $(".trinhdotiensi tr:last").after
                (
                    '<tr>'+
                        '<td align="center"><input type="text" class="form-control" name="chuyennganhtiensi[]" placeholder="Chuyên ngành đào tạo"></td>'+
                        '<td align="center"><input type="text" class="form-control" name="noidaotaotiensi[]"  placeholder="Nơi đào tạo"></td>'+
                        '<td align="center"><input type="text" class="form-control" name="namcapbangtiensi[]" placeholder="Năm cấp bằng"></td>'+
                        '<td align="center"><button type="button" class="btn btn-danger delete btn-sm">Xóa</button></td>'+
                    '</tr>'
                );
            }
        );

        $('input[name=thekdv]').change(function () {
            var thekdv_value = $(this).val();
            if (thekdv_value == 1) {
                $("input[name=sothekdv]").prop('disabled', false);
                $("input[name=ngaycapthe]").prop('disabled', false);
            }
            else {
                $("input[name=sothekdv]").prop('disabled', true);
                $("input[name=ngaycapthe]").prop('disabled', true);
            }
            ;

        });

        $('input[name=cckdv]').change(function () {
            var cckdv_value = $(this).val();
            if (cckdv_value == 1) {
                $("input[name=sochungchi]").prop('disabled', false);
                $("input[name=ngaycapcc]").prop('disabled', false);
            }
            else {
                $("input[name=sochungchi]").prop('disabled', true);
                $("input[name=ngaycapcc]").prop('disabled', true);
            }
            ;

        });

        $("#them_ngoai_ngu").on('click',function(){
            $("#trinhdongoaingu tr:last").after
            (
                '<tr>'+
                    '<td align="center">'+
                        '<select name="ngoaingu[]" class="form-control" >'+
                            '<option value="0">Chọn ngôn ngữ</option>'+
                            '<option value="1">Tiếng Anh</option>'+
                            '<option value="2">Tiếng Pháp</option>'+
                            '<option value="3">Tiếng Nga</option>'+
                            '<option value="4">Tiếng Đức</option>'+
                            '<option value="5" >Ngoại ngữ khác</option>'+
                        '</select>'+
                        '<input  type="text"  name="ngoaingukhac[]" value="" placeholder="" class="form-control" style="display: none;none;margin-top:5px;">'+
                    '</td>'+
                    '<td align="center">'+
                        '<select class="form-control" name="nghe[]">'+
                            '<option value="1">Tốt</option>'+
                            '<option value="2">Khá</option>'+
                            '<option value="3">Trung bình</option>'+
                            '<option value="4">Yếu</option>'+
                        '</select>'+
                    '</td>'+
                    '<td align="center">'+
                        '<select  class="form-control" name="noi[]">'+
                            '<option value="1">Tốt</option>'+
                            '<option value="2">Khá</option>'+
                            '<option value="3">Trung bình</option>'+
                            '<option value="4">Yếu</option>'+
                        '</select>'+
                    '</td>'+
                    '<td align="center">'+
                        '<select class="form-control" name="doc[]" >'+
                            '<option value="1">Tốt</option>'+
                            '<option value="2">Khá</option>'+
                            '<option value="3">Trung bình</option>'+
                            '<option value="4">Yếu</option>'+
                        '</select>'+
                    '</td>'+
                    '<td align="center">'+
                        '<select class="form-control" name="viet[]">'+
                            '<option value="1">Tốt</option>'+
                            '<option value="2">Khá</option>'+
                            '<option value="3">Trung bình</option>'+
                            '<option value="4">Yếu</option>'+
                        '</select>'+
                    '</td>'+
                    '<td align="center"><button type="button" class="btn btn-danger delete btn-sm">Xóa</button></td>'+
                '</tr>'
            );
        });

        $('#trinhdongoaingu').on('change','select[name^="ngoaingu"]',function(){
            if ($(this).val() == 5)
            {
                $(this).next().css("display","block");
            }
            else
            {
                $(this).next().css("display","none");
            }
        }); 

        /* === Add new line to quatrinhcongtac table === */
        $(".themquatrinhcongtac").click(
            function()
            {
                $(".quatrinhcongtac tr:last").after
                (
                    '<tr>'+
                        '<td><input class="form-control" type="text" name="thoigianct[]" placeholder="   Thời gian"  ></td>'+
                        '<td><input class="form-control" type="text" name="noicongtac_quatrinh[]"  placeholder="   Nơi công tác"  ></td>'+
                        '<td><input class="form-control" type="text" name="chucvu[]" placeholder="   Chức vụ"  ></td>'+
                        '<td align="center"><button type="button" class="btn btn-danger delete btn-sm">Xóa</button></td>'+
                    '</tr>'
                );
            }
        );

        /* === Add new line to khoahoc table === */
        $(".themkhoahoc").click
        (
            function()
            {
                $("#cackhoahocdambaovakiemdinhchatluong tr:last").after
                (
                    '<tr>'+
                        '<td><input class="form-control" type="text" name="khoahoc[]" placeholder="   Nhập tên khóa học" ></td>'+
                        '<td><input class="form-control" type="text" name="thoigiankh[]"  placeholder="   Thời gian"  ></td>'+
                        '<td><input class="form-control" type="text" name="noidaotao[]" placeholder="   Nơi đào tạo"  ></td>'+
                        '<td align="center"><button type="button" class="btn btn-danger delete btn-sm">Xóa</button></td>'+
                    '</tr>'
                );
            }
        );

        $('input[name=thamgiadgn]').change(function () {
            var thamgiadgn_value = $(this).val();
            if (thamgiadgn_value == 1) {
                $(".bangthamgiadgn").show();
            }
            else {
                $(".bangthamgiadgn").hide();
            }

        });
    });

    $('.donvitochuc1').on('change', function () {
        if ($('.donvitochuc1').val() == 4) {
            $('.donvitochuckhac1').css("display", "block");
        } else {
            $('.donvitochuckhac1').css("display", "none");
        }
    });
    $(function () {
        var count = $('#countthamgiadgn').val();
        $("#themthamgiadgn").click(function () {
            count++;
            $('.thamgiadgn  tr[class="lv1"]:last').after(
                '<tr class="lv1">' +
                '<td align="center">' +
                '<select name="donvitochuc' + count + '" class="donvitochuc' + count + '  form-control">' +
                '<?php
                    $kq_select_don_vi_to_chuc = $wpdb->get_results
                    (
                        'SELECT * FROM cacdonvitochucdgn',
                        ARRAY_N
                    );
                    foreach ($kq_select_don_vi_to_chuc as $row) {
                        echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
                    }
                    ?>'
                +
                '</select>' +
                '<input type="text" name="donvitochuckhac1" class="donvitochuckhac' + count + ' form-control" value="" placeholder="" style="display:none">' +
                '</td>' +
                '<td align="center">' +
                '<input type="text" name="donviduocdanhgia' + count + '" value="" placeholder="" class="form-control">' +
                '</td>' +
                '<td align="center">' +
                '<select name="vaitrotrongdoan' + count + '" class="vaitrotrongdoan' + count + '  form-control" >' +
                '<option value="1">Trưởng đoàn</option>' +
                '<option value="2">Thư ký Đoàn</option>' +
                '<option value="3">Thành viên Đoàn</option>' +
                '<option value="4">Tổ thư ký</option>' +
                '<option value="5">Quan sát viên</option>' +
                '</select>' +
                '</td>' +
                '<td align="center">' +
                '<table>' +
                '<tr>' +
                '<td>1</td>' +
                '<td>2</td>' +
                '<td>3</td>' +
                '<td>4</td>' +
                '<td>5</td>' +
                '<td>6</td>' +
                '<td>7</td>' +
                '<td>8</td>' +
                '<td>9</td>' +
                '<td>10</td>' +
                '</tr>' +
                '<tr>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="1"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="2"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="3"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="4"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="5"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="6"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="7"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="8"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="9"></td>' +
                '<td><input type="checkbox" name="row' + count + 'tc[]" value="10"></td>' +
                '</tr>' +
                '</table>' +
                '</td>' +
                '<td align="center"><button type="button" class="btn btn-danger delete btn-sm">Xóa</button></td>'+
                '</tr>'
            );
            $("#countthamgiadgn").val(count);
        });
    });
    /* === Function delete table row on delete clicked === */
    function deleteTableRow (tableSelector, deleteButtonSelector) {
        $(tableSelector).on('click',deleteButtonSelector,function(){
            $(this).parent().parent('tr').remove();
        });
    }
    deleteTableRow('#trinhdothacsi','button.delete');
    deleteTableRow('#trinhdotiensi','button.delete');
    deleteTableRow('#trinhdongoaingu','button.delete');
    deleteTableRow('#quatrinhcongtac','button.delete');
    deleteTableRow('#thamgiadgn','button.delete');
    deleteTableRow('#cackhoahocdambaovakiemdinhchatluong','button.delete');
</script>
<?php get_footer();
}
?>
