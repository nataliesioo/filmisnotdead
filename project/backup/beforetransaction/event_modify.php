<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$event_no = $_POST['event_no'];
$event_name = $_POST['event_name'];
$date = $_POST['date'];
$price = $_POST['price'];
$lab_name = $_POST['lab_name'];
$content = $_POST['content'];

$ret = mysqli_query($conn, "update event set event_name = '$event_name', date = '$date',price = '$price', lab_name = '$lab_name', content = '$content' where event_no = $event_no;");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=event_list.php'>";
}

?>

