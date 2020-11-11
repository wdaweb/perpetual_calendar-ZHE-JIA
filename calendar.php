<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <style>
    table{
        width:750px;
        margin:auto;
        border:1px solid #ccc;
    }
    table td{
        border:1px solid #ccc;
        text-align:center;
        padding:10px;
    }
    table td:hover{
        background:#7eb0e6;
    }
    body{
        background-image:url(a1.jpg);
        background-repeat:no-repeat;
        background-size: 100vw 100vh;

    }
    </style>
</head>
<body class="">
    
<?php
    //上下月
    if(isset($_GET['month']) || isset($_GET['year'])){


        $toMonth=$_GET['month'];
        $toYear=$_GET['year'];

        if($toMonth >= 12){
            $nextMonth=1;
            $nextYear=$toYear+1;
    
        }
        else{
            $nextMonth=$toMonth+1;
            $nextYear=$toYear;
    
        }
        
    
        if($toMonth <=1){
            $lastMonth=12;
            $lastYear=$toYear-1;
    
        }else {
            $lastMonth=$toMonth-1;
            $lastYear=$toYear;
    
        }
        //選單列表
    }else if(isset($_POST['chooseyear']) || isset($_POST['choosemonth'])){

        $toYear=$_POST['chooseyear'];
        $toMonth=$_POST['choosemonth'];

        if($toMonth >= 12){
            $nextMonth=1;
            $nextYear=$toYear+1;
    
        }
        else{
            $nextMonth=$toMonth+1;
            $nextYear=$toYear;
    
        }
        
    
        if($toMonth <=1){
            $lastMonth=12;
            $lastYear=$toYear-1;
    
        }else {
            $lastMonth=$toMonth-1;
            $lastYear=$toYear;
    
        }
        //輸入年月
    }else if(isset($_POST['thisYear'] ) || isset($_POST['thisMonth'])) {

        //避免其中一個年或月沒輸入
        if(!empty($_POST['thisYear'])){
            $toYear=$_POST['thisYear'];
        }else {
            $toYear=date("Y");
        }
        if(!empty($_POST['thisMonth'])){
            if($_POST['thisMonth']>12){
                $toMonth=$_POST['thisMonth'] %12 ;   //月份超過12算超過月份
            }else{
                $toMonth=$_POST['thisMonth'];
            }
            
        }else {
            $toMonth=date("m");
        }



        if($toMonth >= 12){
            $nextMonth=1;
            $nextYear=$toYear+1;
    
        }
        else{
            $nextMonth=$toMonth+1;
            $nextYear=$toYear;
    
        }
        
    
        if($toMonth <=1){
            $lastMonth=12;
            $lastYear=$toYear-1;
    
        }else {
            $lastMonth=$toMonth-1;
            $lastYear=$toYear;
    
        }

    }else {
        $toYear=date("Y");
        $toMonth=date("m");

    }
    

    $allDaylast=date("t");
    $firstDay=strtotime($toYear."-".$toMonth."-".'1');
    $allDay =date("t",$firstDay);
    $startDay=date("w",$firstDay);

?> 
    <div class="container ">
    <div class="bg-dark text-white  rounded border border-primary p-3 col-12 mt-5 " style="box-shadow:10px 10px 10px #111; ">
        <div align="center" valign="center" >
            <h1>萬年曆</h1>
        </div>
        <div align="center" valign="center" >
            <h6 class="col-12"><?=$toYear;?>年<?=$toMonth;?>月</h6>
        </div>

        <!-- 輸入年月表單 -->
        <h5 class="col-12">請輸入年月</h5>
        <form class="col-12" action="calendar.php" method="post">
            <p ><input type="text" name="thisYear" > 年</p>
            <p ><input type="text" name="thisMonth" > 月</p>
            <input type="submit" value="確認" class="btn btn-primary btn-sm">
            <input type="reset" value="重置" class="btn btn-primary btn-sm">
        </form>

        <br>

        <!-- 選擇年月表單 -->
        <form action="calendar.php" method="post" class="col-12">
        <p><select name="chooseyear" >
        <?php
            for($i=date("Y"); $i>=1;$i--){
                echo "<option>";
                echo $i;
                
            }        
                echo "</option>";
        ?>
        </select>
                年
        <select name="choosemonth" >
        
            <?php

                for($i=12; $i>=1;$i--){
                    echo "<option>";
                    echo "$i";
                }
                    echo "</option>";
            ?>
        </select>
                    月
        </p>
                <input type="submit" value="確認" class="btn btn-primary btn-sm">
        </form>

            <!-- 上下月表單 -->
        <div class="row justify-content-around">
        <div class='col-auto' >
            <a href="calendar.php?month=<?=$lastMonth;?>&year=<?=$lastYear;?>" class="btn btn-primary btn-sm">上個月</a>
            </div>
            <div class='col-auto' >
            <a href="calendar.php?month=<?=$nextMonth;?>&year=<?=$nextYear;?>" class="btn btn-primary btn-sm">下個月</a>
            </div>
        </div>
<table class="col-12 ">
    <tr>
        <td rowspan="7" class="p-0" style="width:150px; height:300px;" ><img src="https://picsum.photos/150/300/?random=1"></td>
        <td>日</td>
        <td>一</td>
        <td>二</td>
        <td>三</td>
        <td>四</td>
        <td>五</td>
        <td>六</td>
    </tr>
<?php

    //算表格數量 避免td過多
    if($startDay + $allDay <=28){
        $week =4;
    }else if($startDay + $allDay >28 && $startDay + $allDay <=35 ){
        $week =5;
    }else if($startDay + $allDay >35 && $startDay + $allDay <=42 ){
        $week =6;
    }
    //計算日期數字
    for($i=0; $i<$week ;$i++){

        echo "<tr>";
        for($j=0;$j<7;$j++){
            echo "<td>";

            if($i==0 && $j<$startDay){
                
            }else if(($i*7) + ($j+1)-$startDay>$allDay){
                echo "&nbsp";
            }
            else{
                echo (($i*7) + ($j+1))-$startDay;
            }

            echo "</td>";

        }
        echo "</tr>";
    }
    
?>
</table>

</div>
</div>
</body>
</html>