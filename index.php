<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Page</title>
    <style type="text/css">
        body{
            margin: 0px;
            padding: 0px;
        }
        canvas{
            background-color: orange;
        }
    </style>
</head>
<body>
<canvas width="1000" height="800" id="canvas"></canvas>
<script type="text/javascript">
    var canvas = document.getElementById('canvas'); 
    var ctx=canvas.getContext('2d');
    var color ='red';
    var fig='arc';
    var press =false;
    var x = 0;
    var y = 0;
    var sX=240,sY=240;
    var square=null;

    square =new cuadro(sX,sY,40,40,'red');
    
    canvas.addEventListener('click',function(e){
        console.log(sX,sY);
        ctx.fillStyle=color;
        if(fig=='rec'){
            ctx.fillRect(e.offsetX-20,e.offsetY-20,40,40);
            ctx.strokeRect(e.offsetX-20,e.offsetY-20,40,40);
        }else{
            ctx.beginPath();
            ctx.arc(e.offsetX-20,e.offsetY-20, 30, 0, 2 * Math.PI);
            ctx.fill();
            ctx.stroke();
        }
    });
    
    canvas.addEventListener('mouseover',function(e){
        color=random_rgba();
    });
    canvas.addEventListener('mouseout',function(e){
        fig=(fig=='arc')?'rec':'arc';
    });


    // hacer los cuadritos mientras se mueve el 
    canvas.addEventListener('mousemove',function(e){
        if(press){
            ctx.fillStyle='black';
            ctx.fillRect(e.offsetX-20,e.offsetY-20,3,3);
        }
    });
    canvas.addEventListener('mousedown',function(e){
        press=true;
    })
    canvas.addEventListener('mouseup',function(e){
        press=false;
    })


    //SE MUEVE CON LAS TECLAS W,S,D,A

    document.addEventListener('keydown',function(e){
        // upppp
        if(e.keyCode == 87 || e.keyCode == 38){
            sY-=25;
        }
        //ritgh
        if(e.keyCode == 83 || e.keyCode == 40){
           sY +=25;
        }
        //left
        if(e.keyCode == 65 || e.keyCode == 37){
            sX -=25;
        }
        //down
        if(e.keyCode == 68 || e.keyCode == 39){
            sX +=25;
        }
        paint();
        })




    function paint(){
            ctx.fillStyle ='gray';
            ctx.fillRect(0,0,500,500);
            
            square.c=random_rgba();
            square.dibujar(ctx);
            update();
        }
        function update(){
            square.x=sX;
            square.y=sY;
        }
    function cuadro(x,y,w,n,c){
            this.x = x;
            this.y = y;
            this.w = w;
            this.n = n;
            this.c = c;
            this.dibujar = function(ctx){
                ctx.fillStyle=this.c;
                ctx.fillRect(this.x,this.y,this.w,this.n);
                ctx.strokeRect(this.x,this.y,this.w,this.n);
            }
        }
    function random_rgba() {
        var o = Math.round, r = Math.random, s = 255;
        return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
    }
</script>
</body>
</html>