const btns = document.querySelectorAll('.button');

//lab
const cbc = document.getElementById('cbc');
const bloodgroup = document.getElementById('bloodgroup');
const esr = document.getElementById('esr');
const stool = document.getElementById('stool');
const urinalysis = document.getElementById('urinalysis');
const micro = document.getElementById('microscopy');
const serum = document.getElementById('serum');
const gram_stain = document.getElementById('gram_stain');
const sputum = document.getElementById('sputum');
const blood = document.getElementById('bloodfilm');

//chemistry
const fbs = document.getElementById('fbs');
const sgot = document.getElementById('sgot');
const sgpt = document.getElementById('sgpt');
const alp = document.getElementById('alp');
const bt = document.getElementById('bt');
const bd = document.getElementById('bd');

//srology
const pict = document.getElementById('pict')
const vdrl = document.getElementById('vdrl');

btns.forEach(item => {
    item.addEventListener('click', (e) => {
        if (e.target.classList.contains ('CBC')) {
            cbc.classList.toggle('hide');
        } else if (e.target.classList.contains ('Microscopy')) {
            micro.classList.toggle('hide');
        } else if (e.target.classList.contains ('Blood_Film')) {
            blood.classList.toggle('hide');
        }  else if (e.target.classList.contains ('Stool')) {
            stool.classList.toggle('hide');
        } else if (e.target.classList.contains('FBS_RBS')) {
            fbs.classList.toggle('hide');
        } else if (e.target.classList.contains('SGOT')) {
            sgot.classList.toggle('hide');
        } else if (e.target.classList.contains('PICT')) {
            pict.classList.toggle('hide');
        } else if (e.target.classList.contains('VDRL')) {
            vdrl.classList.toggle('hide');
        }
    })
})