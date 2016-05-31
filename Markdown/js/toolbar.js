/**
 * Created by wujiacheng on 16/5/27.
 */
//获取光标所在位置
function getCurPosition(){
    var content = document.getElementById("content");
    var curPosition=-1;

    if(content.selectionStart){//非IE浏览器
        cursurPosition= content.selectionStart;
    }else{//IE
        try{
            var range = document.selection.createTextRange();
            range.moveStart("character",content.value.length);
            cursurPosition=range.text.length;
        } catch (err){
            return 0;
        }

    }
    return cursurPosition;
}


//添加内容
function addContent(btn){
    // get mouse position
    var pos = getCurPosition();
    // get button value
    var btnvalue = btn.value;
    //DOM
    var con = document.getElementById("content");
    var content = con.value;
    var newContent ="";
    //Cursor length
    var len = 0;
    //Select length
    var select_len = 0;

    // add content
    switch(btnvalue){
        case 'code':
            newContent ="\n```\n文字\n ```\n";
            len = 5;
            select_len = 2;
            break;
        case '>':
            newContent ="\n>文字\n";
            len = 2;
            select_len = 2;
            break;
        case 'b':
            newContent ="\n**文字**\n";
            len = 3;
            select_len = 2;
            break;
        case 'link':
            var link = document.getElementById("linkInput").value;
            document.getElementById("linkInput").value = "http://";
            newContent = "<"+link+">";
            len = 3;
            select_len = 3;
            con.focus();

            break;
        case "photoLink":
            var link = document.getElementById("linkToPhoto").value;
            document.getElementById("linkToPhoto").value = "http://";
            newContent = "![Markdown Logo][image]\n"+
                         "[image]: "+link;
            len = 1;
            select_len =1;
            break;
        case 'i':
            newContent = "\n*文字*\n";
            len = 2;
            select_len = 2;
            break;
        case 'h1':
            newContent = "\n#文字\n";
            len = 2;
            select_len = 2;
            break;
        case 'h2':
            newContent = "\n##文字\n";
            len = 3;
            select_len = 2;
            break;
        case 'h3':
            newContent = "\n###文字\n";
            len = 4;
            select_len = 2;
            break;
        case 'table':
            newContent = "| header 1   | header 2    |\n"+
                         "| ---------- | ----------- |\n"+
                         "| cell 1.1   | cell 1.2    |\n"+
                         "| cell 2.1   | cell 2.2    |\n";
            len = 2;
            select_len = 8;
            break;
        case 'ul':
            newContent = "\n- 文字\n    - 文字\n        - 文字";
            len = 3;
            select_len =2;
            break;



    }
    con.value = con.value.substring(0,pos)+newContent+con.value.substring(pos);
    setCaretPosition(con,pos,len);
    selectContent(con,pos+len,select_len);
    PreviewMarkdown();
}




//实时预览
function PreviewMarkdown()
{
    var xmlhttp ;
    var content = document.getElementById("content").value;
    // console.log("content:"+content);
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("preview").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST","preview_ajax.php",true);
    xmlhttp.send(content);
}


//加载
window.onload = function() {
    var con = document.getElementById("content");
    con.onkeydown = function(ev){
        var keyEvent = ev || event;
        if(keyEvent == 9){
            if(keyEvent.preventDefault){
                keyEvent.preventDefault();
            } else {
                window.event.returnValue = false;
            }
            var pos = getCurPosition();
            var con = document.getElementById("content");
            var content = con.value.substring(o,pos)+"    "+con.value.substring(pos);
            con.value = content;
            con.focus();
        }
    }
}

//设置光标位置
/**
 *
 * @param obj  控件
 * @param pos  位置 int
 * @param len  位移长度 int
 */
function setCaretPosition(obj, pos,len){
    if(obj.setSelectionRange) {
        obj.focus();
        obj.setSelectionRange(pos+len,pos+len);
    } else if (obj.createTextRange){
        var range = obj.createTextRange();
        range.collapse(true);
        range.moveEnd('character', pos+len);
        range.moveStart('character', pos+len);
        range.select();
    }
}

//光标选中文字
function selectContent(obj,pos,len){
    if(obj.createTextRange){
        //IE浏览器
        var range = obj.createTextRange();
        range.moveEnd("character",pos+len);
        range.moveStart("character", pos);
        range.select();
    }else{
        //非IE浏览器
        obj.setSelectionRange(pos, pos+len);
        obj.focus();
    }
}

function tabKey() {
    var ev = window.event;
    if(ev.keyCode == 9){
        var content = document.getElementById("content");
        content.value += "    ";
    }
    content.focus();
    ev.keyCode = 0;
    ev.returnValue = false;
}

