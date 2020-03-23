<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$event_name = $_POST['event_name'];
$date = $_POST['date'];
$content = $_POST['content'];
$lab_name = $_POST['lab_name'];
$price = $_POST['price'];

$ret = mysqli_query($conn, "insert into event (event_name, date, content,lab_name,price) values('$event_name', '$date', '$content','$lab_name','$price')");
if(!$ret)
{
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=event_list.php'>";
}

?>

