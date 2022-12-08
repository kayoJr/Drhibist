const btn_lab = document.getElementById('btn-lab');
const btn_detail = document.getElementById('btn-detail');
const lab = document.getElementById('lab');
const pat_detail = document.getElementById('patient-detail');

btn_lab.addEventListener('click', () => {
	lab.classList.toggle('hide');
	btn_lab.classList.toggle('now')
});
btn_detail.addEventListener('click', () => {
	pat_detail.classList.toggle('hide')
	btn_detail.classList.toggle('now')
});