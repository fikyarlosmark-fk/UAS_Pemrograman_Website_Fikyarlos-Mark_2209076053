<div class="main-container">
<div class="calc-header">
    <span class="icon">⚡</span>
    <h2>Kalkulator Resistor Seri</h2>
</div>

<p>Total resistansi seri adalah penjumlahan semua resistor.</p>

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
    loadHistory();
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
    let total = 0;
    let steps = [];
    let values = [];

    for(let i=1;i<=count;i++){
        let val = parseFloat(document.getElementById('r'+i).value);
        if(!isNaN(val)){
            total += val;
            steps.push(`R${i}`);
            values.push(val);
        }
    }

    document.getElementById('hasil').innerHTML = `
        <div class="result-box">
            <div class="result-value">R total = ${total.toFixed(2)} Ω</div>
            <div class="steps">R = ${steps.join(' + ')}</div>
        </div>
    `;

    // Simpan history otomatis ke MySQL
    saveHistory(values.join(','), total);
}

function saveHistory(resistors, total){
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "pages/calculator/save_history_resistor_seri.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function(){
        if(this.status === 200){
            const res = JSON.parse(this.responseText);
            if(res.status === "success"){
                console.log("History tersimpan!");
                loadHistory();
            } else {
                console.log("Error:", res.message);
            }
        }
    };
    xhr.send(`resistors=${resistors}&total=${total}`);
}

function loadHistory(){
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "pages/calculator/load_history_resistor_seri.php", true);
    xhr.onload = function(){
        if(this.status === 200){
            document.getElementById('history-list').innerHTML = this.responseText;
        }
    };
    xhr.send();
}
</script>

