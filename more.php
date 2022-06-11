<?php require_once './header.php'?>
<link rel="stylesheet" type="text/css" href="static/img.css" />

<!------------------------------------------------------------------------------------------------------------------------------------>
<br><br><br><br>
<?php
$page=isset($_GET['page'])?$_GET['page']:0;//从零开始
$imgnums = 6;    //每页显示的图片数
$path="./updir/";   //图片保存的目录
$handle = opendir($path);
$i=0;
while (false !== ($file = readdir($handle))) {
    list($filesname,$ext)=explode(".",$file);
    if($ext=="gif" or $ext=="jpg" or $ext=="png" or $ext=="GIF" or $ext=="jpeg" or $ext=="webg" or $ext=="apng") {
        if (!is_dir('./updir/'.$file)) {//此处
            $array[]=$file;//保存图片名称
            ++$i;
        }
    }
}
if($array){
    rsort($array);//修改日期倒序排序
}

for($j=$imgnums*$page; $j<($imgnums*$page+$imgnums)&&$j<$i; ++$j){
    echo "<div class='responsive'>";
    //图片
    echo "<div class='father1'>";
    echo "<img src='/updir/$array[$j]'><br><br>";//此处需设置路径，默认/updir/
    echo "</div>";

//分页并判断
/*------------------------------------------暂时废弃--------------------------------------------------------------------------------
realpage = @ceil($i / $imgnums) - 1;
$Prepage = $page-1;
$Nextpage = $page+1;
if($Prepage<0){
    echo "<br><br><br>";
    echo "<div class='footer-bt'>";
    echo "<div class='btn-group'>";
    echo "<button type='button' class='btn'><a href=?page=$Prepage>上一页</a></button> ";
    echo "<button type='button' class='btn'><a href=?page=$Nextpage>下一页</a></button>";
    echo "<button type='button' class='btn'><a href=?page=$realpage>尾页</a></button>";
    echo "</div>";
    echo "</div>";
}
elseif($Nextpage >= $realpage){
    echo "<br><br><br>";
    echo "<div class='footer-bt'>";
    echo "<div class='btn-group'>";
    echo "<button type='button' class='btn'><a href=?page=0>首页</a></button> ";
    echo "<button type='button' class='btn'><a href=?page=$Prepage>上一页</a></button>";
    echo "<button type='button' class='btn'><a href=?page=$Nextpage>下一页</a></button>";
    echo "</div>";
    echo "</div>";
}
else{
    echo "<br><br><br>";
    echo "<div class='footer-bt'>";
    echo "<div class='btn-group'>";
    echo "<button type='button' class='btn'><a href=?page=0>首页</a></button> ";
    echo "<button type='button' class='btn'><a href=?page=$Prepage>上一页</a></button>";
    echo "<button type='button' class='btn'><a href=?page=$Nextpage>下一页</a></button>";
    echo "<button type='button' class='btn'><a href=?page=$realpage>尾页</a></button>";
    echo "</div>";
    echo "</div>";*/
}

?>

<?php require_once './footer.php'?>