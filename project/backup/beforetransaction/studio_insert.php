<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$lab_name = $_POST['lab_name'];
$tel = $_POST['tel'];

$ret = mysqli_query($conn, "insert into lab (lab_name, tel) values('$lab_name', '$tel')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=studio_list.php'>";
}

?>

