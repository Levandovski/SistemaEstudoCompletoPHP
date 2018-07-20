
RGraph=window.RGraph||{isRGraph:true};RGraph.Thermometer=function(conf)
{if(typeof conf==='object'&&typeof conf.id==='string'){var parseConfObjectForOptions=true;}else{var conf={id:arguments[0],min:arguments[1],max:arguments[2],value:arguments[3]}}
this.id=conf.id;this.canvas=document.getElementById(this.id);this.context=this.canvas.getContext?this.canvas.getContext('2d'):null;this.canvas.__object__=this;this.uid=RGraph.CreateUID();this.canvas.uid=this.canvas.uid?this.canvas.uid:RGraph.CreateUID();this.colorsParsed=false;this.type='thermometer';this.isRGraph=true;this.min=RGraph.stringsToNumbers(conf.min);this.max=RGraph.stringsToNumbers(conf.max);this.value=RGraph.stringsToNumbers(conf.value);this.coords=[];this.graphArea=[];this.currentValue=null;this.bulbRadius=0;this.bulbTopRadius=0;this.bulbTopCenterX=0
this.bulbTopCenterY=0;this.coordsText=[];this.original_colors=[];this.firstDraw=true;this.properties={'chart.strokestyle':'black','chart.colors':['Gradient(#c00:red:#f66:#fcc)'],'chart.gutter.left':15,'chart.gutter.right':15,'chart.gutter.top':15,'chart.gutter.bottom':15,'chart.ticksize':3,'chart.text.color':'black','chart.text.font':'Segoe UI, Arial, Verdana, sans-serif','chart.text.size':12,'chart.text.accessible':true,'chart.text.accessible.overflow':'visible','chart.text.accessible.pointerevents':false,'chart.units.pre':'','chart.units.post':'','chart.zoom.factor':1.5,'chart.zoom.fade.in':true,'chart.zoom.fade.out':true,'chart.zoom.hdir':'right','chart.zoom.vdir':'down','chart.zoom.frames':25,'chart.zoom.delay':16.666,'chart.zoom.shadow':true,'chart.zoom.background':true,'chart.title':'','chart.title.side':'','chart.title.side.bold':true,'chart.title.side.font':null,'chart.shadow':true,'chart.shadow.offsetx':0,'chart.shadow.offsety':0,'chart.shadow.blur':15,'chart.shadow.color':'gray','chart.resizable':false,'chart.contextmenu':null,'chart.adjustable':false,'chart.value.label':true,'chart.value.label.decimals':null,'chart.value.label.thousand':',','chart.value.label.point':'.','chart.labels.count':5,'chart.scale.visible':false,'chart.scale.decimals':0,'chart.annotatable':false,'chart.annotate.color':'black','chart.scale.decimals':0,'chart.scale.point':'.','chart.scale.thousand':',','chart.tooltips':null,'chart.tooltips.highlight':true,'chart.tooltips.effect':'fade','chart.tooltips.event':'onclick','chart.highlight.stroke':'rgba(0,0,0,0)','chart.highlight.fill':'rgba(255,255,255,0.7)','chart.clearto':'rgba(0,0,0,0)'}
if(!this.canvas){alert('[THERMOMETER] No canvas support');return;}
this.$0={}
if(!this.canvas.__rgraph_aa_translated__){this.context.translate(0.5,0.5);this.canvas.__rgraph_aa_translated__=true;}
var RG=RGraph,ca=this.canvas,co=ca.getContext('2d'),prop=this.properties,pa2=RG.path2,win=window,doc=document,ma=Math
if(RG.Effects&&typeof RG.Effects.decorate==='function'){RG.Effects.decorate(this);}
this.set=this.Set=function(name)
{var value=typeof arguments[1]==='undefined'?null:arguments[1];if(arguments.length===1&&typeof name==='object'){RG.parseObjectStyleConfig(this,name);return this;}
if(name.substr(0,6)!='chart.'){name='chart.'+name;}
while(name.match(/([A-Z])/)){name=name.replace(/([A-Z])/,'.'+RegExp.$1.toLowerCase());}
if(name=='chart.ylabels.count'){name='chart.labels.count';}
prop[name.toLowerCase()]=value;return this;};this.get=this.Get=function(name)
{if(name.substr(0,6)!='chart.'){name='chart.'+name;}
name=name.replace(/([A-Z])/g,function(str)
{return'.'+String(RegExp.$1).toLowerCase()});return prop[name];};this.draw=this.Draw=function()
{RG.fireCustomEvent(this,'onbeforedraw');if(!this.colorsParsed){this.parseColors();this.colorsParsed=true;}
this.currentValue=this.value;this.coordsText=[];this.gutterLeft=prop['chart.gutter.left'];this.gutterRight=prop['chart.gutter.right'];this.gutterTop=prop['chart.gutter.top'];this.gutterBottom=prop['chart.gutter.bottom'];this.scale2=RG.getScale2(this,{'max':this.max,'min':this.min,'strict':true,'scale.thousand':prop['chart.scale.thousand'],'scale.point':prop['chart.scale.point'],'scale.decimals':prop['chart.scale.decimals'],'ylabels.count':prop['chart.labels.count'],'scale.round':prop['chart.scale.round'],'units.pre':prop['chart.units.pre'],'units.post':prop['chart.units.post']});this.drawBackground();this.drawBar();this.drawTickMarks();this.DrawLabels();if(prop['chart.title']){this.DrawTitle();}
if(prop['chart.title.side']){this.DrawSideTitle();}
if(prop['chart.resizable']){RG.AllowResizing(this);}
if(prop['chart.contextmenu']){RG.ShowContext(this);}
RG.InstallEventListeners(this);if(this.firstDraw){RG.fireCustomEvent(this,'onfirstdraw');this.firstDraw=false;this.firstDrawFunc();}
RG.FireCustomEvent(this,'ondraw');return this;};this.drawBackground=this.DrawBackground=function()
{var bulbRadius=(ca.width-this.gutterLeft-this.gutterRight)/2;this.bulbTopRadius=(ca.width-this.gutterLeft-this.gutterRight-24)/2
this.bulbTopCenterX=this.gutterLeft+bulbRadius;this.bulbTopCenterY=this.gutterTop+bulbRadius;this.bulbBottomRadius=bulbRadius;this.bulbBottomCenterX=this.gutterLeft+bulbRadius;this.bulbBottomCenterY=ca.height-this.gutterBottom-bulbRadius;this.bulbRadius=bulbRadius;co.beginPath();co.fillStyle=prop['chart.strokestyle'];if(prop['chart.shadow']){RG.setShadow(this,prop['chart.shadow.color'],prop['chart.shadow.offsetx'],prop['chart.shadow.offsety'],prop['chart.shadow.blur']);}
co.fillRect(this.gutterLeft+12,this.gutterTop+bulbRadius,ca.width-this.gutterLeft-this.gutterRight-24,ca.height-this.gutterTop-this.gutterBottom-bulbRadius-bulbRadius);co.arc(this.bulbBottomCenterX,this.bulbBottomCenterY,bulbRadius,0,RG.TWOPI,0);co.arc(this.bulbTopCenterX,this.bulbTopCenterY,this.bulbTopRadius,0,RG.TWOPI,0);co.fill();RG.NoShadow(this);co.beginPath();co.fillStyle='white';co.fillRect(this.gutterLeft+12+1,this.gutterTop+bulbRadius,ca.width-this.gutterLeft-this.gutterRight-24-2,ca.height-this.gutterTop-this.gutterBottom-bulbRadius-bulbRadius);co.arc(this.gutterLeft+bulbRadius,ca.height-this.gutterBottom-bulbRadius,bulbRadius-1,0,RG.TWOPI,0);co.arc(this.gutterLeft+bulbRadius,this.gutterTop+bulbRadius,((ca.width-this.gutterLeft-this.gutterRight-24)/2)-1,0,RG.TWOPI,0);co.fill();co.beginPath();co.fillStyle=prop['chart.colors'][0];co.arc(this.gutterLeft+bulbRadius,ca.height-this.gutterBottom-bulbRadius,bulbRadius-1,0,RG.TWOPI,0);co.rect(this.gutterLeft+12+1,ca.height-this.gutterBottom-bulbRadius-bulbRadius,ca.width-this.gutterLeft-this.gutterRight-24-2,bulbRadius);co.fill();this.graphArea[0]=this.gutterLeft+12+1;this.graphArea[1]=this.gutterTop+bulbRadius;this.graphArea[2]=ca.width-this.gutterLeft-this.gutterRight-24-2;this.graphArea[3]=(ca.height-this.gutterBottom-bulbRadius-bulbRadius)-(this.graphArea[1]);};this.drawBar=this.DrawBar=function()
{var barHeight=((this.value-this.min)/(this.max-this.min))*this.graphArea[3];co.beginPath();co.fillStyle=prop['chart.colors'][0];if(RGraph.ISOLD){co.arc(this.bulbBottomCenterX,this.bulbBottomCenterY,this.bulbBottomRadius-1,0,RG.TWOPI,false)}
co.rect(this.graphArea[0],this.graphArea[1]+this.graphArea[3]-barHeight,this.graphArea[2],barHeight+2);co.fill();this.coords[0]=[this.graphArea[0],this.graphArea[1]+this.graphArea[3]-barHeight,this.graphArea[2],barHeight];};this.drawTickMarks=this.DrawTickMarks=function()
{co.strokeStyle=prop['chart.strokestyle']
var ticksize=prop['chart.ticksize'];co.beginPath();for(var i=this.graphArea[1];i<=(this.graphArea[1]+this.graphArea[3]);i+=(this.graphArea[3]/10)){co.moveTo(this.gutterLeft+12,Math.round(i));co.lineTo(this.gutterLeft+12+ticksize,Math.round(i));}
co.stroke();co.beginPath();for(var i=this.graphArea[1];i<=(this.graphArea[1]+this.graphArea[3]);i+=(this.graphArea[3]/10)){co.moveTo(ca.width-(this.gutterRight+12),Math.round(i));co.lineTo(ca.width-(this.gutterRight+12+ticksize),Math.round(i));}
co.stroke();};this.drawLabels=this.DrawLabels=function()
{if(prop['chart.value.label']){co.fillStyle=prop['chart.text.color'];var text=prop['chart.scale.visible']?RG.number_format(this,this.value.toFixed(typeof prop['chart.value.label.decimals']=='number'?prop['chart.value.label.decimals']:prop['chart.scale.decimals'])):RG.number_format(this,this.value.toFixed(typeof prop['chart.value.label.decimals']=='number'?prop['chart.value.label.decimals']:prop['chart.scale.decimals']),prop['chart.units.pre'],prop['chart.units.post']);RG.Text2(this,{'font':prop['chart.text.font'],'size':prop['chart.text.size'],'x':this.gutterLeft+this.bulbRadius,'y':this.coords[0][1]+7,'text':text,'valign':'top','halign':'center','bounding':true,'boundingFill':'white','tag':'value.label'});}
if(prop['chart.scale.visible']){this.DrawScale();}};this.drawTitle=this.DrawTitle=function()
{co.fillStyle=prop['chart.text.color'];RG.Text2(this,{'font':prop['chart.text.font'],'size':prop['chart.text.size']+2,'x':this.gutterLeft+((ca.width-this.gutterLeft-this.gutterRight)/2),'y':this.gutterTop,'text':String(prop['chart.title']),'valign':'center','halign':'center','bold':true,'tag':'title'});};this.drawSideTitle=this.DrawSideTitle=function()
{var font=prop['chart.title.side.font']?prop['chart.title.side.font']:prop['chart.text.font'];var size=prop['chart.title.side.size']?prop['chart.title.side.size']:prop['chart.text.size']+2;co.fillStyle=prop['chart.text.color'];RG.Text2(this,{'font':font,'size':size+2,'x':this.gutterLeft-3,'y':((ca.height-this.gutterTop-this.gutterBottom)/2)+this.gutterTop,'text':String(prop['chart.title.side']),'valign':'center','halign':'center','angle':270,'bold':prop['chart.title.side.bold'],'tag':'title.side'});};this.drawScale=this.DrawScale=function()
{var numLabels=prop['chart.labels.count'];var step=(this.max-this.min)/numLabels;co.fillStyle=prop['chart.text.color'];var font=prop['chart.text.font'];var size=prop['chart.text.size'];var units_pre=prop['chart.units.pre'];var units_post=prop['chart.units.post'];var decimals=prop['chart.scale.decimals'];for(var i=1;i<=numLabels;++i){var x=ca.width-this.gutterRight;var y=ca.height-this.gutterBottom-(2*this.bulbRadius)-((this.graphArea[3]/numLabels)*i);var text=RG.number_format(this,String((this.min+(i*step)).toFixed(decimals)),units_pre,units_post);RG.Text2(this,{'font':font,'size':size,'x':x-6,'y':y,'text':text,'valign':'center','tag':'scale'});}
RG.Text2(this,{'font':font,'size':size,'x':x-6,'y':ca.height-this.gutterBottom-(2*this.bulbRadius),'text':RG.number_format(this,(this.min).toFixed(decimals),units_pre,units_post),'valign':'center','tag':'scale'});};this.getShape=this.getBar=function(e)
{for(var i=0;i<this.coords.length;i++){var mouseCoords=RGraph.getMouseXY(e);var mouseX=mouseCoords[0];var mouseY=mouseCoords[1];var left=this.coords[i][0];var top=this.coords[i][1];var width=this.coords[i][2];var height=this.coords[i][3];if((mouseX>=left&&mouseX<=(left+width)&&mouseY>=top&&mouseY<=(top+height+this.bulbBottomRadius))||RG.getHypLength(this.bulbBottomCenterX,this.bulbBottomCenterY,mouseX,mouseY)<=this.bulbBottomRadius){var tooltip=RG.parseTooltipText?RG.parseTooltipText(prop['chart.tooltips'],i):'';return{0:this,'object':this,1:left,'x':left,2:top,'y':top,3:width,'width':width,4:height,'height':height,5:i,'index':i,'tooltip':tooltip};}}
return null;};this.getValue=function(arg)
{if(arg.length==2){var mouseX=arg[0];var mouseY=arg[1];}else{var mouseCoords=RGraph.getMouseXY(arg);var mouseX=mouseCoords[0];var mouseY=mouseCoords[1];}
var value=this.graphArea[3]-(mouseY-this.graphArea[1]);value=(value/this.graphArea[3])*(this.max-this.min);value=value+this.min;value=Math.max(value,this.min);value=Math.min(value,this.max);return value;};this.highlight=this.Highlight=function(shape)
{if(prop['chart.tooltips.highlight']){if(typeof prop['chart.highlight.style']==='function'){(prop['chart.highlight.style'])(shape);return;}
pa2(co,'b r % % % % a % % % % % false s % f %',shape['x'],shape['y'],shape['width'],shape['height']+this.bulbBottomRadius,this.bulbBottomCenterX,this.bulbBottomCenterY,this.bulbBottomRadius-1,0,RG.TWOPI,prop['chart.highlight.stroke'],prop['chart.highlight.fill']);}};this.getObjectByXY=function(e)
{var mouseXY=RGraph.getMouseXY(e);if(mouseXY[0]>this.gutterLeft&&mouseXY[0]<(ca.width-this.gutterRight)&&mouseXY[1]>=this.gutterTop&&mouseXY[1]<=(ca.height-this.gutterBottom)){return this;}};this.adjusting_mousemove=this.Adjusting_mousemove=function(e)
{if(prop['chart.adjustable']&&RG.Registry.Get('chart.adjusting')&&RG.Registry.Get('chart.adjusting').uid==this.uid){var mouseXY=RGraph.getMouseXY(e);var value=this.getValue(e);if(typeof(value)=='number'){RG.FireCustomEvent(this,'onadjust');this.value=Number(value.toFixed(prop['chart.scale.decimals']));RG.redrawCanvas(ca);}}};this.positionTooltip=function(obj,x,y,tooltip,idx)
{var coordX=obj.coords[tooltip.__index__][0];var coordY=obj.coords[tooltip.__index__][1];var coordW=obj.coords[tooltip.__index__][2];var coordH=obj.coords[tooltip.__index__][3];var canvasXY=RGraph.getCanvasXY(ca);var mouseXY=RG.getMouseXY(window.event);var gutterLeft=obj.gutterLeft;var gutterTop=obj.gutterTop;var width=tooltip.offsetWidth;var height=tooltip.offsetHeight;tooltip.style.left=0;tooltip.style.top=window.event.pageY-height-5+'px';tooltip.style.overflow='';if(canvasXY[0]+mouseXY[0]-(width/2)<0){tooltip.style.left=canvasXY[0]+mouseXY[0]-(width*0.1)+'px';}else if(canvasXY[0]+mouseXY[0]+(width/2)>doc.body.offsetWidth){tooltip.style.left=canvasXY[0]+mouseXY[0]-(width*0.9)+'px';}else{tooltip.style.left=canvasXY[0]+mouseXY[0]-(width/2)+'px';}};this.getYCoord=function(value)
{if(value>this.max||value<this.min){return null;}
var y=(this.graphArea[1]+this.graphArea[3])-(((value-this.min)/(this.max-this.min))*this.graphArea[3]);return y;};this.overChartArea=function(e)
{var mouseXY=RG.getMouseXY(e);var mouseX=mouseXY[0];var mouseY=mouseXY[1];if(mouseX>=this.graphArea[0]&&mouseX<=(this.graphArea[0]+this.graphArea[2])&&mouseY>=this.graphArea[1]&&mouseY<=(this.graphArea[1]+this.graphArea[3]+this.bulbRadius)){return true;}
if(RG.getHypLength(this.bulbBottomCenterX,this.bulbBottomCenterY,mouseX,mouseY)<=this.bulbRadius){return true;}
if(RG.getHypLength(this.bulbTopCenterX,this.bulbTopCenterY,mouseX,mouseY)<=this.bulbTopRadius){return true;}
return false;};this.parseColors=function()
{if(this.original_colors.length===0){this.original_colors['chart.colors']=RG.array_clone(prop['chart.colors']);}
var colors=prop['chart.colors'];for(var i=0;i<colors.length;++i){colors[i]=this.parseSingleColorForGradient(colors[i]);}};this.reset=function()
{};this.parseSingleColorForGradient=function(color)
{if(!color){return color;}
if(typeof color==='string'&&color.match(/^gradient\((.*)\)$/i)){var parts=RegExp.$1.split(':');var grad=co.createLinearGradient(prop['chart.gutter.left'],0,ca.width-prop['chart.gutter.right'],0);var diff=1/(parts.length-1);grad.addColorStop(0,RG.trim(parts[0]));for(var j=1;j<parts.length;++j){grad.addColorStop(j*diff,RG.trim(parts[j]));}}
return grad?grad:color;};this.on=function(type,func)
{if(type.substr(0,2)!=='on'){type='on'+type;}
this[type]=func;return this;};this.firstDrawFunc=function()
{};this.grow=function()
{var obj=this;var callback=arguments[1]||function(){};var opt=arguments[0]||{};var frames=opt.frames?opt.frames:30;var origValue=Number(obj.currentValue);var newValue=obj.value;newValue=ma.min(newValue,this.max);newValue=ma.max(newValue,this.min);var diff=newValue-origValue;var step=(diff/frames);var frame=0;function iterate()
{obj.value=(step*frame)+origValue;RGraph.clear(obj.canvas);RGraph.redrawCanvas(obj.canvas);if(frame<frames){frame++;RGraph.Effects.updateCanvas(iterate);}else{callback(obj);}}
iterate();return this;};RG.att(ca);RG.Register(this);if(parseConfObjectForOptions){RG.parseObjectStyleConfig(this,conf.options);}};