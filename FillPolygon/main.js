/**
 * Created by wujiacheng on 16/5/20.
 */
//test para
var count = 0;

//edge object
function  ET(a,b,c,d)
{
    this.x= a;
    this.dx= b;
    this.maxy = c;
    this.line = d;
}
// edge tables
var point = new Array();
var AET = new Array();
var NET = new Array();
// scale of the polygon
var maxY = 0;
var minY = 1000 ;

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

//Draw polygon
function draw(){
    //get new position
    var x = event.clientX;
    var y = event.clientY;

    // add new point into point Array
    var p = new Array(x,y);
    point.push(p);
    if(point.length > 1){
        var n = point.length;
        drawLine(point[n-2][0],point[n-2][1],point[n-1][0],point[n-1][1]);
    }
}

// caculate the data of point and then add into NET Array;
function fillDraw(){
    // draw the last line  ,in order to complete the polygon that you draw
    var n = point.length;
    drawLine(point[0][0],point[0][1],point[n-1][0],point[n-1][1]);
    // get the minX and minY ;
    for (var i = 0 ; i < point.length ;i++){
        if( point[i][1] > maxY){
            maxY = point[i][1];
        }
        if( point[i][1] < minY){
            minY = point[i][1];
        }
    }

    // built the border table
    initNET();

    // fill the polygon
    fillPolygon();
}

function initNET()
{
    //get number of points
    var n = point.length;
    // add int NET
    for (var i = minY ; i <= maxY; i++)
    {
        for(var j = 0 ; j < point.length ; j++)
        {
            if(point[j][1] == i)
            {
                if(point[(j-1+n) % n][1] > point[j][1])
                {
                    var x = point[j][0];
                    var maxy = point[(j-1+n) % n][1] ;
                    var dx = ( point[(j-1+n) % n][0] - point[j][0] )/( point[(j-1+n) % n][1]- point[j][1])*1.0;
                    var et =  new ET(x,dx,maxy,i);
                    NET.push(et);
                //     count ++;
                //    console.log(count+"-NET: "+et.x+" "+et.maxy+" "+et.dx);
                }
                if(point[(j+1+n) % n][1] > point[j][1])
                {
                    var x = point[j][0];
                    var maxy = point[(j+1+n) % n][1] ;
                    var dx = ( point[(j+1+n) % n][0] - point[j][0] )/( point[(j+1+n) % n][1]- point[j][1])*1.0;
                    var et =  new ET(x,dx,maxy,i);
                    NET.push(et);

                    // count++;
                    // console.log(count+"-NET: "+et.x+" "+et.maxy+" "+et.dx);
                }
            }
        }
    }
}

// active AET and fill polygon
function fillPolygon()
{
    //fill the drawing
    for(var i = minY ; i < maxY ;i++)
    {
        // add edges in AET
        for(var j = 0 ; j < NET.length ; j++)
        {
            if (NET[j].line == i)
            {
                AET.push(NET[j]);
            }
        }
        //sort
        AET.sort(sortet);

        //remove the border that line reach maxy

        for (var k = 0; k < AET.length; k++)
        {
            if ( AET[k].maxy <= i)
            {
                AET.splice(k,1);
                // --k is very important ,or error will be occured in some special polygons.
                --k;
            }
        }

        //fill polygon
        if (AET.length > 0)
        {
              var can = false;
              for (var k = 0; k < AET.length - 1; ++k)
              {
                  can = !can;
                  if (can)
                  {
                      // get the start and end position(coordinate x)
                      var start = AET[k].x;
                      var end = AET[k+1].x;
                      // draw each line
                      drawLine(start,i,end,i);
                  }
                  AET[k].x += AET[k].dx;
              }
              var n = AET.length;
              AET[n-1].x += AET[n-1].dx;
          }
               console.log(AET.length);
    }
}



// sort
function sortet(a,b) {
    if(a.x != a.b)
        return a.x < b.x ? -1 : 1;
    return a.dx < b.dx ? -1 : 1;
}

//show AET
function showAET() {
    for (var i = 0; i < AET.length; i++) {
        var et = AET[i];
        console.log(count+"-AET: "+et.x+" "+et.maxy+" "+et.dx);

    }
}



//show current mouse position
function getPos(){
    document.getElementById("pos").innerHTML = " x: "+(event.clientX);
    document.getElementById("pos").innerHTML += " y: "+(event.clientY);
}
