function UserLocation()
{

    this.myfunc = function(ob)
    {
        userLatidue = ob.coords.latitude;
        userLongtitude = ob.coords.longitude;

        xhr = new XMLHttpRequest();
        if (xhr)
        {

            xhr.onreadystatechange=function()
            {
                if (xhr.readyState==4 && xhr.status==200)
                {
                    document.getElementById("response").innerHTML=xhr.responseText;
                }
            }

            xhr.open("GET", "distance.php?latitude=" + userLatidue + "&longtitude=" +userLongtitude);
            xhr.send(null);
        }

    }
    this.errfunc = function(ob)
    {
        alert(ob.message);
    }
    if(window.navigator.geolocation)
    {
        window.navigator.geolocation.getCurrentPosition(this.myfunc,this.errfunc);
    }
    else
    {
        alert("geolocation is not supported");
    }
}


