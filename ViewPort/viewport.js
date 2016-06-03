// Line object
var line = new Array();
// Origin point
var coo_x = 450 ;
var coo_y = 300 ;
// Viewport boundary
var wxl = -150;
var wxr = 150;
var wyt = 100;
var wyb = -100;
// Point binary
var p1 ;
var p2 ;
// Change String into int
var iP1 ;
var iP2 ;

// algorithm of Cohen Sutherland
function Cohen_Sutherland(){

    while(line.length)
    {
        setCode();              // locate two endpionts
        iP1 = parseInt(p1,2);   // parse int
        iP2 = parseInt(p2,2);   // parse int

        // if two endpionts both in viewport
        if((iP1 | iP2) == 0){
            drawViewPortLine(line[0][0],line[0][1],line[1][0],line[1][1]);
            line.length = 0;
        // if neither endpionts in viewport
        } else if((iP1 & iP2) != 0){
            line.length = 0;
        // line pass through viewport
        } else {
            //set p1 out
            pointSet();
            // get gradient
            var gradient = (line[1][1]-line[0][1])/(line[1][0]-line[0][0]);
            //left area
            if(iP1 == 9 || iP1 == 1  || iP1 == 5)
            {
                line[0][1] += (wxl - line[0][0]) * gradient;
                line[0][0] = wxl;
            }
            // right area
            else if(iP1 == 10 || iP1 == 2  || iP1 == 6)
            {
                line[0][1] += ( wxr - line[0][0]) * gradient;
                line[0][0] = wxr;
            }
            // top area
            else if(iP1 == 9 || iP1 == 8  || iP1 == 10)
            {
                line[0][0] += ( wyt - line[0][1]) / gradient;
                line[0][1] = wyt;
            }
            // bottom area
            else if(iP1 == 5 || iP1 == 4  || iP1 == 6)
            {
                line[0][0] += ( wyb - line[0][1]) / gradient;
                line[0][1] = wyb;
            }
        }
    }



}


// Set Code p1  & Code p2
function setCode(){
    // D3 D2 D2 D0
    p1 = (line[0][1] > wyt ? "1" : "0" );
    p1 += (line[0][1] < wyb ? "1" : "0" );
    p1 += (line[0][0] > wxr ? "1" : "0" );
    p1 +=  (line[0][0] < wxl ? "1" : "0" );

    p2 = (line[1][1] > wyt ? "1" : "0" );
    p2 += (line[1][1] < wyb ? "1" : "0" );
    p2 += (line[1][0] > wxr ? "1" : "0" );
    p2 +=  (line[1][0] < wxl ? "1" : "0" );

}

//set p1 out
function pointSet(){

    var x = line[0][0];
    var y = line[0][1];
    //document.getElementById("showdata").innerText += "set:  y= "+line[0][1]+"\n";
    if( x >= wxl && x <= wxr && y <= wyt && y >= wyb)
    {
        line[0][0] = line[1][0];
        line[0][1] = line[1][1];
        line[1][0] = x;
        line[1][1] = y;
        //document.getElementById("showdata").innerText += "set :x= "+line[0][0]+"  y= "+line[0][1]+"\n";
        //iP1 = parseInt(p1,2);   // parse int
        //iP2 = parseInt(p2,2);   // parse int
    }
}

// draw original line
function drawLine(x, y,x1,y1) {
    var canvas = document.getElementById("board");
    var context = canvas.getContext('2d');
    context.lineWidth = 1;
    context.strokeStyle="white";
    context.beginPath();
    context.moveTo(x,y);
    context.lineTo(x1,y1);
    context.stroke();
    context.closePath();

}
// draw one line in viewport
function drawViewPortLine(x, y,x1,y1) {
    var canvas = document.getElementById("board");
    var context = canvas.getContext('2d');
    context.lineWidth = 1;
    context.strokeStyle="orange";
    context.beginPath();
    context.moveTo(x+coo_x,-y+coo_y);
    context.lineTo(x1+coo_x,-y1+coo_y);
    context.stroke();
    context.closePath();
}

// canvas event listener
function draw(){
    // get current mouse position
    var x = event.clientX-coo_x;
    var y = -(event.clientY-coo_y);
    // add new point into line
    var p = new Array(x,y);
    line.push(p);
    // draw line if line has two son
    if(line.length % 2 == 0){
        // draw the basical line
        drawLine(line[0][0]+coo_x,-line[0][1]+coo_y,line[1][0]+coo_x,-line[1][1]+coo_y);
        // highlight the part in viewport
        Cohen_Sutherland();
        // reset line
        //line.length = 0;
    }
}


// draw the axes of coordinates
function drawAxes(){
    var canvas = document.getElementById("board");
    var context = canvas.getContext('2d');
    // open one draw path
    context.beginPath();
    context.moveTo(0,300);
    context.lineTo(900,300);
    context.moveTo(450,0);
    context.lineTo(450,600);
    context.stroke();
    // close the current draw path
    context.closePath();
}
