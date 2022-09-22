"use strict";
$(document).ready(function () {
	/*-- sidebar js --*/
	$("#sidebarCollapse").on("click", function () {
		$("#sidebar").toggleClass("active");
	});
	/*-- tooltip js --*/
	$('[data-toggle="tooltip"]').tooltip();
});

var ps = new PerfectScrollbar("#sidebar");

// const sell = document.getElementById('sell');
// const btn = document.getElementById('plus');

// btn.addEventListener('click', () => {
// 	const para = document.createElement('div')
// 	para.innerHTML = `<select name="medicine" id="medicine">
// 	<option value="medicine">Name 1</option>
// 	<option value="medicine">Name 2</option>
// 	<option value="medicine">Name 3</option>
// </select>
// <input type="number" name="quantity" id="quantity" min="0" required>`

// 	para.insertBefore(btn, sell)
// });
// $(function () {
//     var duplicates = 0,
//         $original = $('.element').clone(true);

//     function DuplicateForm () {
//         var newForm;

//         duplicates++; 

//         newForm = $original.clone(true).insertBefore($('.fa-3x'));

//         $.each($('input', newForm), function(i, item) {            
// 		    $(item).attr('name', $(item).attr('name') + duplicates);
//         });

//     }

//     $('#plus').on('click', function (e) {
//         e.preventDefault();
//         DuplicateForm();
//     });
// });

const btn_lab = document.getElementById('btn-lab');
const btn_detail = document.getElementById('btn-detail');
const btn_pres = document.getElementById('btn-pres');
const lab = document.getElementById('lab');
const pat_detail = document.getElementById('patient-detail');
const pres = document.getElementById('prescription');

btn_lab.addEventListener('click', () => {
	lab.classList.toggle('hide')
});
btn_detail.addEventListener('click', () => {
	pat_detail.classList.toggle('hide')
});
btn_pres.addEventListener('click', () => {
	pres.classList.toggle('hide')
});


