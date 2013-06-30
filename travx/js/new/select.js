function init ()
{
	var x = document.getElementsByClassName ("tribe");
	var y = document.getElementsByClassName ("loc");
	var z = document.getElementsByClassName ("serv");
	for (var i = 0; i < 4; ++i)
	{
		if (i < x.length)
			x[i].setAttribute ("onclick", "sel(this);");
		if (i < y.length)
			y[i].setAttribute ("onclick", "sel(this);");
		if (i < z.length)
			z[i].setAttribute ("onclick", "sel(this);");
	}
}
function sel(a){var x=a.className;var y=document.getElementsByClassName(x+" sel");if(y.length)y[0].className=x;a.className=x+" sel";document.getElementById(x).value=a.innerHTML}
