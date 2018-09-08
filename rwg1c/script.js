function sendRequest(fileName, divName, showLoading, postValues)
{
    var http = createRequestObject();

    if (typeof(showLoading) === 'undefined')
    {
        showLoading = 'TRUE';
    }

    http.onreadystatechange = function()
    {
        if (http.readyState == 4 && http.status == 200)
        {
            showContent(http.responseText, divName);
        }
        else
        {
            if (showLoading.toUpperCase() === 'TRUE')
            {
                document.getElementById(divName).innerHTML = '<img src="http://ezxcess.antlabs.com/login/loading.gif"/>';
            }
        }
    }

    if (typeof(postValues) === 'undefined')
    {
        http.open('GET', fileName, true);
        http.send(null);
    }
    else
    {
        http.open('POST', fileName, true);
        http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        http.send(postValues);
    }
}

function ajaxPost()
{
    if(!checkToS())
    {
        return false;
    }

    var namevalue = document.getElementById('uid').value;
    var password = document.getElementById('pwd').value;
    var formData = "uid=" + namevalue + "&pwd=" + password;

    document.getElementById('next').onclick = function(){ toggleSubmit(); } ;
    document.getElementById('form-label-2').innerHTML = '&nbsp; ';
    document.getElementById('form-field-2').innerHTML = '';
    document.getElementById('form-label-3').innerHTML = '&nbsp; ';
    document.getElementById('form-field-3').innerHTML = '';
    document.getElementById('next').disabled = true;
    document.getElementById('auth').disabled = true;
    sendRequest('main.ant?c=pms_processor', 'form-field-2', 'TRUE', formData);
}

function toggleToS()
{
	document.getElementById('next').disabled = !document.getElementById('tos').checked;
}

function checkToS()
{
	var objTos = document.getElementById('tos');
    if(objTos != null && !objTos.checked)
    {
        alert('You must agree with all of the terms and conditions');
        return false;
    }
    return true;
}

function noEnter(evt)
{
    var e = (window.event) ? window.event : evt;
    var code = (e.keyCode) ? e.keyCode : (e.which) ? e.which : '';
    return !(code == 13);
}

function createRequestObject()
{
    var req;

    if(window.XMLHttpRequest)
    {
        // Firefox, Safari, Opera...
        req = new XMLHttpRequest();
    }
    else if(window.ActiveXObject)
    {
        // Internet Explorer 5+
        req = new ActiveXObject('Microsoft.XMLHTTP');
    }
    else
    {
        // There is an error creating the object, just as an old browser is being used.
        alert('Problem creating the XMLHttpRequest object');
    }

    return req;
}

function showContent(response, divName)
{
    if (response.match("/^<div id=\"middle\">/"))
    {
        var start = response.indexOf('<div id="middle">')+17;
        var end = response.indexOf('<div id="bottom">')-7;
        var content = response.substring(start,end);
    }
    else
    {
        var content = response;
    }
    document.getElementById('auth').disabled = false;
    document.getElementById('next').disabled = false;
    document.getElementById(divName).innerHTML = content;
    success_url = document.getElementById('success_url').value;
    console.log(success_url);
    if (success_url != '')
    {
        window.location = success_url;
    }
}

$(document).ready(function() 
{
    toggleAuth(); 
}
);
