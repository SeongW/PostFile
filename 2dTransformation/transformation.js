
// 多边形
var polygon = new Array();
// 变换矩阵
var matrix = new Array();
//前一次的图形
var pre_polygon ;
// 坐标轴实际位置,原点位置
var coo_x = 450;
var coo_y = 300;
// 最靠近原点的点
var og_x = 0;
var og_y = 0;

//点数据 x,y,1
function point(x,y,z){
    this.x = x;
    this.y = y;
    this.z = z;
}
// 初始化变换矩阵
function setMatrix(){
    var p1 = new Array(1,0,0);
    var p2 = new Array(0,1,0);
    var p3 = new Array(0,0,1);
    matrix.push(p1);
    matrix.push(p2);
    matrix.push(p3);
    // 前状态 等于 变换状态
    //pre_martrix = matrix;
}

// 恢复矩阵
function resetMatrix(){
    var n = matrix.length;
    for(var i = 0 ; i < n ; i++)
        for(var j = 0 ; j < n; j++)
            matrix[i][j] = (i==j?1:0);
}

function setRect(){
    // 画最后一条
    var n = polygon.length;
    drawLine(polygon[0][0]+coo_x,-polygon[0][1]+coo_y,polygon[n-1][0]+coo_x,-polygon[n-1][1]+coo_y);
    // 获取离原点最近的坐标
    var flag = 0;
    var min = 99999999;
    for ( var i = 0 ; i < n ; i++){
        if((polygon[i][0]*polygon[i][0]+polygon[i][1]*polygon[i][1]) < min)
            flag = i;
    }
    og_x = polygon[flag][0];
    og_y = polygon[flag][1];
    //showp(polygon);
}

// 根据原图建立一个有相同数组的图形
function newRect() {
    var newPoly = new Array();
    for(var i = 0 ; i < polygon.length ; i++){
        newPoly.push(new Array(0,0,0));
    }
    return newPoly;
}

// 画出坐标轴
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

//手动画图形
function draw(){
    // 获取当前坐标
    var x = event.clientX-coo_x;
    var y = -(event.clientY-coo_y);
    // 添加点
    var p = new Array(x,y,1);
    polygon.push(p);
    if(polygon.length > 1){
        var n = polygon.length;
        drawLine(polygon[n-2][0]+coo_x,-polygon[n-2][1]+coo_y,polygon[n-1][0]+coo_x,-polygon[n-1][1]+coo_y);
    }
}


// 画直线，起点x,y 终点 x1,y1
function drawLine(x, y,x1,y1) {
    var canvas = document.getElementById("board");
    var context = canvas.getContext('2d');
    context.lineWidth = 1;
    context.strokeStyle="black";
    context.moveTo(x,y);
    context.lineTo(x1,y1);
    context.stroke();
}

//根据坐标顺序画出图案
function drawRect(arr){
    //默认是多边形
    for(var i = 1 ; i < arr.length ; i ++)
    {
        drawLine(arr[i-1][0]+coo_x,-(arr[i-1][1]-coo_y),arr[i][0]+coo_x,-(arr[i][1]-coo_y));
    }
    //封闭图形
    var n = arr.length;
    drawLine(arr[0][0]+coo_x,-(arr[0][1]-coo_y),arr[n-1][0]+coo_x,-(arr[n-1][1]-coo_y));
}


//初始化图形 和 变换矩阵
function initPolygon(){
    // 创建图形
    setRect();
    // 创建变换矩阵
    setMatrix();
}

//  矩阵计算  poly图形  ， matrix 转换形式
function MatrixTran(){
    // 创建新图形
    var newone = newRect();
    // 普通矩阵相乘
    for (var i = 0; i < polygon.length; i++)
        for (var j = 0 ; j < 3 ; j++)
            for(var k = 0 ; k < 3 ; k++)
                newone[i][j] += (polygon[i][k]*matrix[k][j]);
    // 返回变换后的图形
    return newone;
}

// 矩阵1 ＊ 矩阵2 （矩阵2 默认3行3列）
function MultiMatric(matrix1,matrix2){
    var row = matrix1.length;
    var newone = createMatric(row);
    for (var i = 0; i < matrix1.length; i++)
        for (var j = 0 ; j < 3 ; j++)
            for(var k = 0 ; k < 3 ; k++)
                newone[i][j] += (matrix1[i][k]*matrix2[k][j]);
    // 返回变换后的图形
    return newone;
}

// 根据所给的行数 返回一个row行3列的矩阵
function createMatric(row){
    var newMatrix = new Array();
    for(var i = 0 ; i < row ; i++){
        newMatrix.push(new Array(0,0,0));
    }
    return newMatrix;
}


// 转换后设置位置
function setPolygon(){
    var d_x = polygon[0][0] - og_x;
    var d_y = polygon[0][1] - og_y;
    for (var i = 0 ; i < polygon.length ; i++)
    {
        polygon[i][0] -= d_x;
        polygon[i][1] -= d_y;
    }
}

// 平移
function shift(x,y){
    matrix[2][0] = x;
    matrix[2][1] = y;
}

// 比例变换
function scale(s){
    matrix[0][0] = s;
    matrix[1][1] = s;
    // 移动位置
    setPolygon();
}

// 旋转变换
function rotate(angle){
    //
    var angle_pi = (2*Math.PI*angle)/360;
    matrix[0][0] = Math.cos(angle_pi);
    matrix[0][1] = Math.sin(angle_pi);
    matrix[1][0] = -Math.sin(angle_pi);
    matrix[1][1] = Math.cos(angle_pi);
    setPolygon();
}

// 对称变换
// x轴对称
function symmetry_x(){
    matrix[1][1] = -1;
}
// y轴对称
function symmetry_y(){
    matrix[0][0] = -1;
}
// 原点对称
function symmetry_base_point(){
    matrix[0][0] = -1;
    matrix[1][1] = -1;
}
// y=x 对称
function symmetry_yx(){
    matrix[0][0] = 0;
    matrix[1][1] = 0;
    matrix[1][0] = 1;
    matrix[0][1] = 1;
    //showm();
}
// y=-x 对称
function symmetry_ryx(){
    matrix[0][0] = 0;
    matrix[1][1] = 0;
    matrix[1][0] = -1;
    matrix[0][1] = -1;
}

// 错切
function cut(b,c){
    matrix[0][1] = b;
    matrix[1][0] = c;
    setPolygon();
}

function changePolygon(obj){
    switch (obj.value) {
        case "shift":
            var shift_x = document.getElementById("shift_x").value;
            var shift_y = document.getElementById("shift_y").value;
            if(shift_x && shift_y){
                shift(shift_x,shift_y);
            } else alert("请输入完整");
            break;
        case "cut":
            var cut_x = document.getElementById("cut_x").value;
            var cut_y = document.getElementById("cut_y").value;
            if(cut_x && cut_y){
                cut(cut_x,cut_y);
            } else alert("请输入完整");
            break;
        case "scale":
            var range = document.getElementById("range").value;
            if(range){
                scale(range);
            } else alert("请输入完整");
            break;
        case "rotate":
            var angle = document.getElementById("angle").value;
            rotate(angle);
            break;
        case "base":
            symmetry_base_point();
            break;
        case "symmetry_x":
            symmetry_x();
            break;
        case "symmetry_y":
            symmetry_y();
            break;
        case "symmetry_ryx":
            symmetry_ryx();
            break;
        case "symmetry_yx":
            symmetry_yx();
            break;
    }
    // 得到图形坐标
    // 单次变换
    //var c = MultiMatric(polygon,matrix);

    // 连续变换
    pre_polygon = MultiMatric(polygon,matrix);
    polygon = pre_polygon;
    // 画图
    drawRect(pre_polygon);
    // 初始化变换矩阵
    resetMatrix();
}

//显示变换矩阵
function showm(){
    var text = "";
    for(var i = 0 ; i < 3 ; i++)
        for(var j = 0 ; j < 3; j++)
        {
            text += matrix[i][j]+" ";
        }
    alert(text);
}

//显示当前矩阵
function showp(poly){
    var text = "";
    for(var i = 0 ; i < 4 ; i++)
        for(var j = 0 ; j < 3; j++)
        {
            text += poly[i][j]+" ";
        }
    alert(text);
}
