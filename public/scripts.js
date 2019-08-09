function db0click()
{
	var d0x = document.getElementById("d0");
	var b0x = document.getElementById("b0");
	var d1x = document.getElementById("d1");
	var d2x = document.getElementById("d2");
	var d3x = document.getElementById("d3");
	var b1x = document.getElementById("b1");
	var b2x = document.getElementById("b2");
	var b3x = document.getElementById("b3");
	if (d0x.style.display === "none") d0x.style.display = "block";
	else if (d0x.style.display === "block") d0x.style.display = "none";
	if (d0x.style.display === "block") b0x.style.backgroundColor = "rgb(25, 25, 25)";
	else if (d0x.style.display === "none") b0x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d1x.style.display === "block") d1x.style.display = "none";
	if (d2x.style.display === "block") d2x.style.display = "none";
	if (d3x.style.display === "block") d3x.style.display = "none";
	if (d0x.style.display === "block") b1x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d0x.style.display === "block") b2x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d0x.style.display === "block") b3x.style.backgroundColor = "rgb(77, 77, 77)";
}
function db1click()
{
	var d1x = document.getElementById("d1");
	var d2x = document.getElementById("d2");
	var d3x = document.getElementById("d3");
	var b1x = document.getElementById("b1");
	var b2x = document.getElementById("b2");
	var b3x = document.getElementById("b3");
	d1x.style.display = (d1x.style.display === "none") ? "block" : "none";
	b1x.style.backgroundColor = (d1x.style.display === "block") ? "rgb(25, 25, 25)" : "rgb(77, 77, 77)";
	if (d1x.style.display === "block") b2x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d1x.style.display === "block") b3x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d2x.style.display === "block") d2x.style.display = "none";
	if (d3x.style.display === "block") d3x.style.display = "none";
}
function db2click()
{
	var d1x = document.getElementById("d1");
	var d2x = document.getElementById("d2");
	var d3x = document.getElementById("d3");
	var b1x = document.getElementById("b1");
	var b2x = document.getElementById("b2");
	var b3x = document.getElementById("b3");
	d2x.style.display = (d2x.style.display === "none") ? "block" : "none";
	b2x.style.backgroundColor = (d2x.style.display === "block") ? "rgb(25, 25, 25)" : "rgb(77, 77, 77)";
	if (d2x.style.display === "block") b1x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d2x.style.display === "block") b3x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d1x.style.display === "block") d1x.style.display = "none";
	if (d3x.style.display === "block") d3x.style.display = "none";
}
function db3click()
{
	var d1x = document.getElementById("d1");
	var d2x = document.getElementById("d2");
	var d3x = document.getElementById("d3");
	var b1x = document.getElementById("b1");
	var b2x = document.getElementById("b2");
	var b3x = document.getElementById("b3");
	d3x.style.display = (d3x.style.display === "none") ? "block" : "none";
	b3x.style.backgroundColor = (d3x.style.display === "block") ? "rgb(25, 25, 25)" : "rgb(77, 77, 77)";
	if (d3x.style.display === "block") b2x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d3x.style.display === "block") b1x.style.backgroundColor = "rgb(77, 77, 77)";
	if (d1x.style.display === "block") d1x.style.display = "none";
	if (d2x.style.display === "block") d2x.style.display = "none";
}
function clickLink()
{
	var d0x = document.getElementById("d0");
	var b0x = document.getElementById("b0");
	d0x.style.display = "none";
	b0x.style.backgroundColor = "rgb(77, 77, 77)";
}
