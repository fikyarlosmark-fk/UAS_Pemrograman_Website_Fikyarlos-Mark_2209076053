
<header class="header-top">
    <h1>Konversi Kapasitansi</h1>
</header>

<div class="main-container">
<div class="converter-title">Konversi Satuan Kapasitansi</div>
<div class="main-conversion-display" id="mainResult"></div>

<div class="conversion-form">
<div class="form-group">
<span class="form-label">From</span>
<div class="input-unit-container">
<input type="number" id="fromValue" value="1">
<select id="fromUnit">
<option value="F">F</option>
<option value="µF">µF</option>
<option value="nF">nF</option>
<option value="pF">pF</option>
</select>
</div>
</div>

<span class="to-label">To</span>

<div class="form-group">
<div class="input-unit-container">
<input type="text" id="toValue" readonly>
<select id="toUnit">
<option value="µF">µF</option>
<option value="F">F</option>
<option value="nF">nF</option>
<option value="pF">pF</option>
</select>
</div>
</div>
</div>

<div class="conversion-grid" id="gridResult"></div>
</div>

<script>
const factors={
pF:1e-12,nF:1e-9,µF:1e-6,
mF:1e-3,F:1
};

const units=Object.keys(factors);

function convert(){
let v=parseFloat(fromValue.value)||0;
let f=fromUnit.value;
let t=toUnit.value;
let r=v*factors[f]/factors[t];
toValue.value=r.toLocaleString();
mainResult.innerText=`${v} ${f} = ${r.toLocaleString()} ${t}`;

gridResult.innerHTML="";
units.forEach(u=>{
gridResult.innerHTML+=`
<div class="grid-item">
<span class="unit-name">${u}</span>
<span class="unit-value">${(v*factors[f]/factors[u]).toLocaleString()} ${u}</span>
</div>`;
});
}

fromValue.oninput=convert;
fromUnit.onchange=convert;
toUnit.onchange=convert;
convert();
</script>

