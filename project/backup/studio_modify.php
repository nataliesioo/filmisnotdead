<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$lab_no = $_POST['lab_no'];
$lab_name = $_POST['lab_name'];
$tel = $_POST['tel'];

$ret = mysqli_query($conn, "update lab set lab_name = '$lab_name', tel = '$tel' where lab_no = $lab_no");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=studio_list.php'>";
}

?>

