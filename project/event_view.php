<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

$mode = "뒤로 가기";

if (array_key_exists("event_no", $_GET)) {
    $event_no = $_GET["event_no"];
    $query = "select * from event natural join lab where event_no = $event_no";
    $res = mysqli_query($conn, $query);
    $event = mysqli_fetch_assoc($res);
    if(!$event) {
        msg("물품이 존재하지 않습니다.");
    }
}

?>

<div class="container fullwidth">

        <br>
        <h3><b>이벤트 상세 보기</h3></b>
        <br>
        
       <!-- <p>
            <label for="event_no">No.</label>
            <input readonly type="text" id="event_no" name="event_no" value="<?= $event['event_no'] ?>"/>
        </p>-->
        
        <p>
            <label for="event_name">이벤트</label>
            <input readonly type="text" id="event_name" name="event_name" value="<?= $event['event_name'] ?>"/>
        </p>
        
        <p>
            <label for="date">이벤트 날짜</label>
            <input readonly type="text" id="date" name="date" value="<?= $event['date'] ?>"/>
        </p>
        
        <p>
            <label for="date">가격</label>
            <input readonly type="text" id="price" name="price" value="<?= $event['price'] ?>"/>
        </p>
        
        <p>
            <label for="lab_name">주최자</label>
            <input readonly type="text" id="lab_name" name="lab_name" value="<?= $event['lab_name'] ?>"/>
        </p>

        <p>
            <label for="content">내용</label>
            <textarea readonly id="content" name="content" rows="10"><?= $event['content'] ?></textarea>
        </p>

     <br><p align="center"><a href='event_list.php'><button class="button primary small" onclick="javascript:return validate();"><?=$mode?></button>


    </div>
<? include("footer.php") ?>