
<header class="header-top">
<h1>Konversi Arus Listrik</h1>
</header>

<div class="main-container">

<div class="converter-title">Konversi Satuan Arus Listrik</div>
<div class="main-conversion-display" id="mainResult"></div>

<div class="conversion-form">
<div class="form-group">
<span class="form-label">From</span>
<div class="input-unit-container">
<input type="number" id="fromValue" value="1">
<select id="fromUnit">
<option value="A">A</option>
<option value="mA">mA</option>
<option value="µA">µA</option>
<option value="kA">kA</option>
</select>
</div>
</div>

<span class="to-label">To</span>

<div class="form-group">
<div class="input-unit-container">
<input type="text" id="toValue" readonly>
<select id="toUnit">
<option value="mA">mA</option>
<option value="A">A</option>
<option value="µA">µA</option>
<option value="kA">kA</option>
</select>
</div>
</div>
</div>

<div class="conversion-grid" id="gridResult"></div>
</div>

<script>
const factors={
aA:1e-18,fA:1e-15,pA:1e-12,nA:1e-9,
µA:1e-6,mA:1e-3,A:1,
kA:1e3,MA:1e6,GA:1e9
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

