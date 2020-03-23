<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "등록";
$action = "event_insert.php";

if (array_key_exists("event_no", $_GET)) {
    $event_no = $_GET["event_no"];
    $query =  "select * from event natural join lab where event_no = $event_no;";
    $res = mysqli_query($conn, $query);
    $event = mysqli_fetch_array($res);
    if(!$event) {
        msg("물품이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "event_modify.php";
}

$lab = array();
$query = "select * from lab";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $lab[$row['lab_name']] = $row['lab_name'];
}


?>
    <div class="container">
        <form name="event_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="event_no" value="<?=$event['event_no']?>"/>
            <h3>이벤트 <?=$mode?></h3> 
        <p>
            <label for="event_name">이벤트</label>
            <input type="text" id="event_name" name="event_name" value="<?= $event['event_name'] ?>"/>
        </p>
        
        <p>
                <label for="date">이벤트 날짜</label>
                <textarea placeholder="yyyymmdd 형식으로 입력해주세요" id="date" name="date" rows="1"><?=$event['date']?></textarea>
           </p>
            
        <p>
                <label for="content">내용</label>
                <textarea placeholder="내용 입력" id="content" name="content" rows="10"><?=$event['content']?></textarea>
            </p>
            
        <p>
            <label for="price">가격</label>
            <input type="text" id="price" name="price" value="<?= $event['price'] ?>"/>
        </p>
            
            <p>
                <label for="lab_name">주최자(현상소)</label>
                <select name="lab_name" id="lab_name">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($lab as $id => $name) {
                            if($id == $lab['lab_name']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            
            <script>	
                function validate() {
                    if(document.getElementById("event_name").value == "") {
                        alert ("이벤트를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("date").value == "") {
                        alert ("날짜를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("lab_name").value == "-1") {
                        alert ("주최자를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("content").value == "") {
                        alert ("내용 입력해 주십시오"); return false;
                    }

                    

                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>