<?php require_once'./config.php'; ?>

<?php
function getext($file){
  $info = pathinfo($file);
  return $info['extension'];
  }
  if($_GET["act"]=="up"){
    $filex = $_FILES['pics'];
  if ($filex["error"] > 0){
    $errs = $filex['error'];
    echo "<b>错误{$errs}:</b>";
    switch ($errs) {
  case 1:  echo '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值'; break;
  case 2:  echo '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值'; break;
  case 3:  echo '上传异常,文件只有部分被上传'; break;
  case 4:  echo '文件空白或者说没有文件被上传'; break;
  case 6:  echo '上传的临时文件丢失'; break;
  case 7:  echo '文件写入失败建议检查文件夹读写权限'; break;
  }
  }else{
    $tape = getext($filex["name"]);
  if(!stristr("|{$isup}|","|.{$tape}|")){ exit("<b>上传失败：</b>文件名后缀[{$tape}]不支持!");}
  if($filex["size"]>$lenx*1024){ exit("<b>上传失败：</b>文件大小超过允许值{$lenx}KB!");}
    $fileName = date("YmdHis")."_".uniqid().".".$tape;
  if(!is_dir("./$updir/")) {
  if(!mkdir("./$updir/", 0777, true)) {
   exit("<span>转存失败：</span>创建文件夹失败！");
  }
  }
  move_uploaded_file($filex["tmp_name"], "./$updir/".$fileName);
  if (file_exists("./$updir/".$fileName)){
   exit("<span>上传成功 文件直链：".$url.$xiegang.$updir.$xiegang.$fileName);
  }else{
   exit("<span>转存失败：</span>请检查文件夹读写权限！");
  }
  }
  exit();
  }
  ?>
<?php require_once'./header.php'; ?>

  <script>
  var $=function(node){
  return document.getElementById(node);
  }
  function $(objId){
  return document.getElementById(objId);
  }
  function GetRequest(Url,ia,GetFunction){
  if(window.ActiveXObject){
  var xpost = new ActiveXObject("Microsoft.XMLHTTP");
  }else{
  var xpost = new XMLHttpRequest();
  }
  xpost.onreadystatechange = function(){
  if(xpost.readyState == 4){
  if(xpost.status == 200){
  GetFunction(xpost.responseText);
  }else{
  GetFunction(404);
  }
  }
  }
  xpost.open("post",'?act=up&vi='+ia,true);
  xpost.upload.onprogress = function(evt) {
  per = Math.floor((evt.loaded / evt.total) * 100) + "%";
  $('per'+ia).style.width = per;
  $('per'+ia).innerHTML = per+"";
  }
  xpost.send(Url);
  }
  window.onload = function () {
  input = $("fielinput");
  if (typeof (FileReader) === 'undefined') {
  $("tips").innerHTML = "抱歉，请使用chrome,firefox等现代浏览器，国产浏览器请使用急速模式！";
  input.setAttribute('disabled', 'disabled');
  } else {
  input.addEventListener('change', readFile, false);
  }
  }
  function postFile(filea,ib,finame) {
  console.log("files:"+ib,filea);
  var SendUrl = new FormData();
      SendUrl.append('pics',$('fielinput').files[ib]);
  GetRequest(SendUrl,ib,function(GetText){
  if(GetText == 404){
  $("tips"+ib).innerHTML += "<br><b>上传失败：</b>通讯异常!";
  }else{
  $("tips"+ib).innerHTML += "<br>"+GetText;
  }
  });
  }
  function readFile() {
  files = $("fielinput").files;
  $("tips").innerHTML = "";
  if(files.length><?php echo $lenf; ?>){
  $("tips").innerHTML = "<b>全部未上传：</b>文件数超<?php echo $lenf; ?>个!";
  return false;
  }
  for(ii=0; ii<files.length; ii++){
  ia=ii;
  finame = files[ia].name;
  fisize = files[ia].size;
  if (fisize>1) {
  $("tips").innerHTML += "<div class=\"tips\"><div id=\"tips"+ia+"\"><span>["+ia+"]</span> "+finame+"</div><div class=\"per\" id=\"per"+ia+"\"></div></div>\r\n";
  if (!/(<?php echo $isup; ?>)$/.test(finame)){
  $("tips"+ia).innerHTML += "<br><b>未上传：</b>后缀格式不支持!";
  continue;
  }
  if (fisize><?php echo $lenx; ?>*1024) {
  $("tips"+ia).innerHTML += "<br><b>未上传：</b>文件大小超<?php echo $lenx; ?>kB!";
  continue;
  }
  filea = files[ia];
  postFile(filea,ia,finame);
  }
  }
  $("fielinput").value="";
  } 
  </script>


<style type="text/css">
{margin:0;padding:0;font-size:14px;line-height:150%;font-family:"microsoft yahei",SimHei;}
#tips,#file{border: 1px dashed #ffff;height:10rem;padding;text-align:center}
.tips {margin:5px auto;width:calc(95%-12px);}

b {color:#fff;font-size:18px;font-weight:bold;}
span {font-size:18px;font-weight:bold;color:#000;font-weight: lighter}
</style>

<br><br><br><br>


<div class="droppable">
<input type="file" class="file" id="fielinput" multiple="multiple" /><br>
</div>


        <!--页脚-->

        <footer>
            <span>
              <div id="tips">
                <b>操作说明：</b>点上边按钮选择要上传文件即可!<br>
                <b>支持上传：</b><?php echo $isup;?>后缀文件!<br>
                <b>上传限制：</b>文件<?php echo $lenf; ?>个以内，每个文件<?php echo $lenx;?>KB以内!
                <?php echo $desc; ?>
            </span>
        </footer>
    </body>
</html>
<!--
------------------------------------------------------以下内容不可删------------------------------------------------------------------------
项目起始日期：2022/5/9
项目名称：Fish_Img
开发者：🇫 🇮 🇸 🇭
使用的开源项目：ZUI(https://www.openzui.com/)、Font Awesome(https://fontawesome.dashgame.com/)
参考：EasyImage简单图床(png.cm)
Copyright © 2022-2030 🇫 🇮 🇸 🇭 All rights reserved 
本项目使用MIT开源协议，请遵守MIT开源协议，禁止删除本段注释
敬请注意：本程序为开源程序，你可以使用本程序在任何非商业项目或者网站中。
但请你务必保留代码中相关版权信息（页面logo和页面上必要的链接可以更改）
本人仅为程序开源创作，如非法网站与本人无关，请勿用于非法用途、如代码中含有任何侵权元素，请联系删改

------------------------------------------------------以下内容可删-------------------------------------------------------------------------------------
本项目开源地址：
Github：
Gitee：
作者自建工具站：https://tools.xyfish.cn/

友链：
信年：http://xinnian.xyfish.cn
-->