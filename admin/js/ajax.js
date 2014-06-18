var xmlHttp;
function createXMLHttpRequest()
{
    if (window.XMLHttpRequest)
    {
        xmlHttp = new XMLHttpRequest();//mozilla浏览器
    }
    else if (window.ActiveXObject)
    {
        try
        {
            xmlHttp = new ActiveX0bject("Msxml2.XMLHTTP");//IE老版本
        }
        catch (e)
        {
        }
        try
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");//IE新版本
        }
        catch (e)
        {
        }
        if (!xmlHttp)
        {
            window.alert("不能创建XMLHttpRequest对象实例");
            return false;
        }
    }
}


function startRequest(username)
{
    createXMLHttpRequest();//特编

    xmlHttp.open("GET", "admin_u_c.php?xname=" + username, true);
    xmlHttp.onreadystatechange = handleStateChange;
    xmlHttp.send(null);
}


function handleStateChange()
{
    if (xmlHttp.readyState == 4)
    {
        if (xmlHttp.status == 200)
        {
//alert("来自服务器的响应：" + xmlHttp.responseText);
            if (xmlHttp.responseText == "true") {
                document.getElementById("ckuser").innerHTML = '此用户名以被人注册';
            }
            else if (xmlHttp.responseText == "false")
            {
                document.getElementById("ckuser").innerHTML = '该用户名可以使用';
            }
        }
    }
}