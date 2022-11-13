const btn_lab = document.getElementById('btn-lab');
const btn_detail = document.getElementById('btn-detail');
const btn_pres = document.getElementById('btn-pres');
const lab = document.getElementById('lab');
const pat_detail = document.getElementById('patient-detail');
const pres = document.getElementById('prescription');

btn_lab.addEventListener('click', () => {
	lab.classList.toggle('hide');
	btn_lab.classList.toggle('now')
});
btn_detail.addEventListener('click', () => {
	pat_detail.classList.toggle('hide')
	btn_detail.classList.toggle('now')
});
btn_pres.addEventListener('click', () => {
	pres.classList.toggle('hide')
	btn_pres.classList.toggle('now')
});