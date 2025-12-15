
<header class="header-top"> 
    <h1>Konversi Tegangan</h1>
</header>

<div class="main-container">

<div class="converter-title">Konversi Satuan Tegangan</div>
<div class="main-conversion-display" id="mainResult">
    1 V = 1000 mV
</div>

<div class="conversion-form">

<div class="form-group">
    <span class="form-label">From</span>
    <div class="input-unit-container">
        <input type="number" id="fromValue" value="1">
        <select id="fromUnit">
            <option value="V">V</option>
            <option value="mV">mV</option>
            <option value="kV">kV</option>
        </select>
    </div>
</div>

<span class="to-label">To</span>

<div class="form-group">
    <div class="input-unit-container">
        <input type="text" id="toValue" readonly>
        <select id="toUnit">
            <option value="mV">mV</option>
            <option value="V">V</option>
            <option value="kV">kV</option>
        </select>
    </div>
</div>

</div>

<div class="conversion-grid" id="gridResult"></div>

</div>

<script>
const factors = {
    aV:1e-18, fV:1e-15, pV:1e-12, nV:1e-9, µV:1e-6,
    mV:1e-3, cV:1e-2, dV:1e-1,
    V:1,
    daV:1e1, hV:1e2, kV:1e3,
    MV:1e6, GV:1e9, TV:1e12, PV:1e15, EV:1e18
};

const units = Object.keys(factors);

function convert(){
    const fromVal = parseFloat(fromValue.value) || 0;
    const from = fromUnit.value;
    const to = toUnit.value;

    const result = fromVal * factors[from] / factors[to];
    toValue.value = result.toLocaleString();

    mainResult.innerText = `${fromVal} ${from} = ${result.toLocaleString()} ${to}`;

    gridResult.innerHTML = "";
    units.forEach(u=>{
        const val = fromVal * factors[from] / factors[u];
        gridResult.innerHTML += `
            <div class="grid-item">
                <span class="unit-name">${u}</span>
                <span class="unit-value">${val.toLocaleString()} ${u}</span>
            </div>`;
    });
}

fromValue.oninput = convert;
fromUnit.onchange = convert;
toUnit.onchange = convert;

convert();
</script>

