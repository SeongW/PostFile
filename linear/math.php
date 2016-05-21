<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="math.css" rel="stylesheet" type="text/css"/>
        <title>直线拟合</title>
        <script language="Javascript">
            // 换行纪录
            var count = 0;
            // 点的数组
            var coordinate = new Array();
            //result
            var a ;
            var b ;
            //画坐标轴
            function drawAxes(){
                //画出坐标轴
                var canvas = document.getElementById("canvas");
                var context = canvas.getContext('2d');
                context.moveTo(400,0);
                context.lineTo(400,600);
                context.moveTo(400,0);
                context.lineTo(395,5);
                context.moveTo(400,0);
                context.lineTo(405,5);
                context.moveTo(800,300);
                context.lineTo(795,295);
                context.moveTo(800,300);
                context.lineTo(795,305);
                context.stroke();
                context.moveTo(0,300);
                context.lineTo(800,300);
                context.stroke();
                context.font="12px Arial";
                context.fillText("(0,0)",405,290);
                context.fillText("y",405,15);
                context.fillText("x",780,290);

            }

            function getPos(){
                //显示鼠标当前坐标
                document.getElementById("x").innerHTML = " x: "+(event.clientX-410);
                document.getElementById("y").innerHTML = " y: "+(320-event.clientY);
            }

            function drawPoint(){
                //画点
                var x = event.clientX;          //画图坐标
                var y = event.clientY;          //画图坐标
                var c=document.getElementById("canvas");
                var ctx=c.getContext("2d");
                ctx.fillStyle="#000000";
                ctx.fillRect(x-10,y-10,3,3);
                //添加坐标纪录
                //实际坐标
                var act_x = x - 410;
                var act_y = 310 - y;
                var coo = new Array(act_x,act_y);
                coordinate.unshift(coo);
                //显示坐标纪录
                //每输出4个换行
                count++;
                if(count%4==0){
                    document.getElementById("coordinates").innerHTML+="("+act_x+","+act_y+") </br>";
                } else {
                    document.getElementById("coordinates").innerHTML+="("+act_x+","+act_y+") ";
                }
            }

            //最小二乘法线性拟合
            function math(){
                // E(xy)
                var num1 = 0;
                // E(x)*E(y)/N
                var num2 = 0;
                var num21 = 0;
                // E(x^2)
                var num3 = 0
                // (E(x))^2/N
                var num4 = 0;
                for(var i = 0 ; i < coordinate.length ; i++)
                {
                    num1+=(coordinate[i][0]*coordinate[i][1]); //x*y 的和
                    num2+=coordinate[i][0];         // x 的和
                    num21+=coordinate[i][1];        // y 的和
                    num3+=coordinate[i][0]*coordinate[i][0];  //x^2 的和
                }
                var n = coordinate.length;
                num4 = num2*num2/n;
                var avgX = num2/n;
                var avgY = num21/n;
                num2 = num2*num21/n;

                a = (num1-num2)/(num3-num4);
                b = avgY-a*avgX;
                 if (b > 0){
                     document.getElementById("coordinates").innerHTML = " y = "+a+" x + "+b;
                 } else {
                     document.getElementById("coordinates").innerHTML = " y = "+a+" x - "+Math.abs(b);
                 }

                //画直线
                var canvas = document.getElementById("canvas");
                var context = canvas.getContext('2d');
                //直线起点
                context.moveTo(0,-(a*(-400)+b)+305);
                context.lineTo(800,-(a*400+b)+305);
                context.stroke();
            }



        </script>
    </head>
    <body>
    <div>
        <div id="box">
            <canvas id="canvas" width="800" height="600" onMouseMove="getPos()" onmousedown="drawPoint()"></canvas>
            </canvas>
        </div>
        <div id="text">
            <p class="pos" id="x">x:</p>
            <p class="pos" id="y">y:</p>
            <button onclick="math()" class="button">直线拟合</button>
            <p id="coordinates"></p>

        </div>
    </div>
        <script>
            drawAxes();
        </script>



    </body>
</html>
