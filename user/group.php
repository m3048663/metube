<?php session_start();?>
<script>
function set_chat_msg()
{
    if(typeof XMLHttpRequest != "undefined")
    {
        oxmlHttpSend = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
       oxmlHttpSend = new ActiveXObject("Microsoft.XMLHttp");
    }
    if(oxmlHttpSend == null)
    {
       alert("Browser does not support XML Http Request");
       return;
    }
    var url = "./database/tb_group.php";
    var func = "set_message";
    var strname="<?php echo $_SESSION["user_name"] ?>";
    var strmsg="";
    if (document.getElementById("txtmsg") != null)
    {
        strmsg = document.getElementById("txtmsg").value;
        document.getElementById("txtmsg").value = "";
    }
    
    url += "?name=" + strname + "&msg=" + strmsg + "&func=" + func;
    oxmlHttpSend.open("GET",url,true);
    oxmlHttpSend.send(null);
  
}

function get_chat_msg()
{
   if(typeof XMLHttpRequest != "undefined")
   {
	oxmlHttp = new XMLHttpRequest();
   }
   else if (window.ActiveXobject)
   {
	oxmlHttp = new ActiveXobject("Microsoft.XMLHttp");
   }
   if(oxmlHttp == null)
   {
	alert("Browser does not support XML Http Request");
   }
   
   var url = "./database/tb_group.php";
   var func = "get_message";
   url += "?func=" + func;
   oxmlHttp.onreadystatechange = get_chat_msg_result;
   oxmlHttp.open("GET",url,true);
   oxmlHttp.send(null);
}

function get_chat_msg_result()
{
   if(oxmlHttp.readyState == 4 || oxmlHttp.readyState == "complete")
   {
	if (document.getElementById("message") != null)
	{
		document.getElementById("message").innerHTML = oxmlHttp.responseText;
		oxmlHttp = null;
	}
	var scrollDiv = document.getElementById("message");
	scrollDiv.scrollTop = scrollDiv.scrollHeight;
   }
}
//var t = setInterval(get_chat_msg,5000);
var t = setInterval(function(){get_chat_msg()},1000);

</script>


<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
	            <h3>Chat room</h3>
                </div>

<div class="container" id="message">
            <div class="col-sm-12">

</div>
</div>

   <div class="panel-footer clearfix">
      <textarea class="form-control" id="txtmsg" rows="3"></textarea>
        <span class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-xs-12" style="margin-top: 10px">
        <button class="btn btn-warning btn-lg btn-block" onclick="set_chat_msg()" id="btn-chat">Send</button>
        </span>
   </div>
		    



         </div>
     </div>
</div>
  
