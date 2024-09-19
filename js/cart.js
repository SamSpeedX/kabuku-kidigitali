const bei = document.getElementById('bei').value;
const idai = document.getElementById('idadi').value;
const jumla = document.getElementById('jumla')

// idai.onchange = (e) => {
//     const count = idai;
//     const price = bei
//     var jumlaku = `${price}` * `${count}`;
//     alert(`${jumlaku}`)
//     jumla.innerHTML = `${jumlaku}`
// }

idai.addEventListener(onchange, function bd() {
    const count = idai;
    const price = bei
    var jumlaku = `${price}` * `${count}`;
    alert(`${jumlaku}`)
    jumla.innerHTML = `${jumlaku}`
    idai.style.border="1px solid green"
})

// addEventListener(function bd() {
//     const count = idai;
//     const price = bei
//     var jumlaku = `${price}` * `${count}`;
//     alert(`${jumlaku}`)
//     jumla.innerHTML = `${jumlaku}`
//     // idai.style.border="1px solid green"
// })

// jumla.innerHTML = `${jumlaku}`
// alert(`${idai}`)
console.log('====================================');
console.log(`${idai}`);
console.log('====================================');