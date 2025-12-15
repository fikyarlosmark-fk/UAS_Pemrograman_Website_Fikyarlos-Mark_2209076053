<header class="header-top">
    <h1>Kalkulator Resistor Paralel</h1>
</header>

<div class="main-container">

<div class="calc-header">
    <span class="icon">⚡</span>
    <h2>Kalkulator Resistor Paralel</h2>
</div>

<p>Total resistansi paralel dihitung dari kebalikan jumlah kebalikan resistor.</p>

<div id="resistor-area"></div>

<button onclick="tambah()">+ Tambah Resistor</button>
<button onclick="hapus()">− Hapus Resistor</button>
<button onclick="hitung()">Hitung</button>

<div id="hasil"></div>

</div>

<script>
let count = 2;

// buat default 2 resistor
window.onload = () => {
    for(let i=1;i<=count;i++) buatInput(i);
};

function buatInput(i){
    let div = document.createElement('div');
    div.className = 'input-group';
    div.id = 'res'+i;
    div.innerHTML = `
        <label>R${i} (Ω)</label>
        <input type="number" id="r${i}">
    `;
    document.getElementById('resistor-area').appendChild(div);
}

function tambah(){
    count++;
    buatInput(count);
}

function hapus(){
    if(count <= 2){
        alert('Minimal 2 resistor');
        return;
    }
    document.getElementById('res'+count).remove();
    count--;
}

function hitung(){
    let sum = 0;
    let steps = [];
    let resistor_values = [];

    for(let i=1;i<=count;i++){
        let val = parseFloat(document.getElementById('r'+i).value);
        if(val > 0){
            sum += 1/val;
            steps.push(`1/R${i}`);
            resistor_values.push(val);
        }
    }

    let total = sum === 0 ? 0 : 1/sum;

    document.getElementById('hasil').innerHTML = `
        <div class="result-box">
            <div class="result-value">R total = ${total.toFixed(2)} Ω</div>
            <div class="steps">1/R = ${steps.join(' + ')}</div>
        </div>
    `;

    // --- Kirim data ke server untuk disimpan ---
    saveHistory(resistor_values, total);
}

// --- Simpan history ke MySQL ---
function saveHistory(resistors, total){
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "pages/calculator/save_history_resistor_paralel.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`resistors=${encodeURIComponent(resistors.join(','))}&total=${total}`);

    xhr.onload = function(){
        if(this.status === 200){
            const response = JSON.parse(this.responseText);
            if(response.status === "success"){
                console.log("History tersimpan!");
            } else {
                console.log("Error menyimpan history:", response.message);
            }
        }
    }
}
</script>