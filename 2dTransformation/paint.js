function drawAxes(){
    //画出坐标轴
    var canvas = document.getElementById("board");
    var context = canvas.getContext('2d');
    context.moveTo(0,300);
    context.lineTo(900,300);
    context.moveTo(450,0);
    context.lineTo(450,600);
    context.stroke();
}


// draw one line with parameters that you give
function drawLine(x, y,x1,y1) {
    var canvas = document.getElementById("board");
    var context = canvas.getContext('2d');
    context.lineWidth = 1;
    context.strokeStyle="black";
    context.moveTo(x,y);
    context.lineTo(x1,y1);
    context.stroke();
}

//画图案
function drawRect(arr){
    for(var i = 1 ; i < arr.length ; i ++)
    {
        drawLine(arr[i-1][0],arr[i-1][1],arr[i][0],arr[i][1]);
    }
    var n = arr.length;
    drawLine(point[0][0],point[0][1],point[n-1][0],point[n-1][1]);
}
