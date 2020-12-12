var opening = $('dialog')[0]
dialogPolyfill.registerDialog(opening)
$('.carousel-cell').not('.visible').slideUp();
$('#next_btn').on('click', function () {
	$('.visible').slideUp()
	$('.visible').next().slideDown()
	$('.visible').next().addClass('visible')
	$('.visible').first().removeClass('visible')
	if ($('.visible').next().length == 0) {
		$(this).text('Let\'s Start!')
		$(this).off()
		$(this).on('click', function () {
            localStorage.setItem('badstarted',true)
			$('dialog#welcome').addClass('hide')
			$('dialog#welcome')[0].addEventListener('animationend', function () {
				opening.close()
			})
		})
	}
})
var qrcode1 = new QRCode(document.getElementById("qrcode1"), {
	width : 100,
	height : 100,
	text: `Never gonna run around and desert you`
});
$('img').attr("title","")

if(localStorage.getItem('badstarted') != 'true') opening.showModal()
for (i in foods) {
	$("#available tbody").append(`<tr>
			<td class="mdl-data-table__cell--non-numeric">${foods[i][0]}</td>
			<td>₱<span class="price">${foods[i][1].toFixed(2)}</span></td>
			<td><div class="mdl-textfield mdl-js-textfield">
			<input size="5" maxlength="3" min="0" max="254" class="mdl-textfield__input qty" type="number" id="qty_${foods.indexOf(foods[i])}">
    		<label class="mdl-textfield__label" for="qty_${foods.indexOf(foods[i])}">Qty</label>
			</div></td>
			<td class="total" id="total_${foods.indexOf(foods[i])}"></td>
			</tr>`)
}
$(".total").hide()
var sum_total = 0;
var _hexi = "data:text/html;base64,";
var hexi = ``;
$(".qty").on('input',function () {
    var totalprice;
	if ($(this).val() == "") {
		$(this).parent().parent().parent().find(".total").text("0");
        totalprice = 0
	}else{
        totalprice = $(this).val()
        totalprice *= $(this).parent().parent().parent().find(".price").text()
        $(this).parent().parent().parent().find(".total").text(totalprice);
    }
	sum_total = 0;
	$(".total").each(function(k,v){
		if($(this).text() != ""){
			sum_total += parseInt($(this).text())
		}
	})
    $("#total_sum").find("span").text(`₱${sum_total.toFixed(2)}`);
    _hexi = "data:text/html,";

    hexi = `<meta name="viewport" content="width=device-width, initial-scale=1.0"><p>Customer: ${$("#name").val()}</p>`
    hexi += `<table><thead><tr><th>Qty</th><th>Item</th><th>Total Price</th></thead><tbody>`
	$(".qty").each(function(k,v){
		if(!$(this).val() == ""){
            var item = $(this).parent().parent().parent().find("td").first().text()
            hexi+=`<tr><td>${$(this).val()}</td><td>${item}</td>`
            hexi +=`<td>&#8369;${parseInt($(this).parent().parent().parent().find(".total").text()).toFixed(2)}</td></tr>`
        }
	})
    hexi += `<tr><td><hr></td></tr><tr><td colspan="2">Total Price:</td><td>&#8369;${sum_total.toFixed(2)}</td><tbody></table>`
    console.log(hexi)
    _hexi += (hexi);
})
$('form').on('submit', function(e){
    var qrout = new QRCode(document.getElementById("qrdialogout"), {
        width : 200,
        height : 200,
        text: _hexi
    });
    document.getElementById("qrdialog").showModal()
    e.preventDefault()
    return false;
})
$("#loader, #error").hide()
$(".closeqr").on('click', function(){
    $(this).parent().parent()[0].close()
    $("#qrdialogout").text("");
})