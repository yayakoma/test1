<?php
if ($_POST['type'] == 'test') {
  $phanqua = array('10' => '20', '20' => '20', '50' => '20', '100' => '20', '200' => '20', '500' => '20'); //chỉnh tỉ lệ ở đây

  $mangphanqua = array();
  foreach ($phanqua as $phanqua => $value) {
    $mangphanqua = array_merge($mangphanqua, array_fill(0, $value, $phanqua));
  }

  $k = $mangphanqua[array_rand($mangphanqua)];
  $img = '' . $k . 'k.png';
  $status = 'success'; //
  $ketqua123 = 'success';
  $msg = 'Chúc mừng bạn đã may mắn rút được ' . number_format($k) . 'K. Mau nhận quà lì xì đi hjhj';
  $arr = array('status' => $status, 'success' => $ketqua123, 'img' => $img, 'msg' => $msg);
  echo json_encode($arr);
} else {
  echo '?';
}
