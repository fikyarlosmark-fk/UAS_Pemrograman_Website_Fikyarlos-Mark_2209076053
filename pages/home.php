<div class="container">

<div class="description-card">
    <div class="icon"></div>
    <div>
        <h2>Kalkulator Elektronika</h2>
        <p>By Kalkulator Elektronika</p>
        <p>Web ini merupakan projek akhir UAS Pemrograman Website yang ditujukan untuk membantu perhitungan dasar dan konversi satuan untuk mahasiswa Teknik Elektro.</p>
    </div>
</div>

<div class="features-section">

<div class="column">
<h3>⚡ Kalkulator</h3>
<ul class="feature-list">

   <li class="list-item kalkulator-item"
    onclick="location.href='index.php?page=calculator/ohm'">
    <div class="item-icon">⚡</div>
    <span class="item-title">Kalkulator Hukum Ohm</span>
</li>

<li class="list-item kalkulator-item"
    onclick="location.href='index.php?page=calculator/resistor_seri'">
    <div class="item-icon">—</div>
    <span class="item-title">Kalkulator Resistansi Seri</span>
</li>

<li class="list-item kalkulator-item"
    onclick="location.href='index.php?page=calculator/resistor_paralel'">
    <div class="item-icon">⋮</div>
    <span class="item-title">Kalkulator Resistansi Paralel</span>
</li>

</ul>
</div>

<div class="column">
<h3>🔁 Konversi</h3>
<ul class="feature-list">

    <a href="index.php?page=konversi_satuan/converter_voltage" class="home-link">
        <li class="list-item konversi-item">
            <div class="item-icon v">V</div>
            <span class="item-title">Konversi Tegangan</span>
        </li>
    </a>

    <a href="index.php?page=konversi_satuan/converter_current" class="home-link">
        <li class="list-item konversi-item">
            <div class="item-icon i">I</div>
            <span class="item-title">Konversi Arus</span>
        </li>
    </a>

    <a href="index.php?page=konversi_satuan/converter_resistance" class="home-link">
        <li class="list-item konversi-item">
            <div class="item-icon r">R</div>
            <span class="item-title">Konversi Resistansi</span>
        </li>
    </a>

    <a href="index.php?page=konversi_satuan/converter_power" class="home-link">
        <li class="list-item konversi-item">
            <div class="item-icon w">W</div>
            <span class="item-title">Konversi Daya</span>
        </li>
    </a>

    <a href="index.php?page=konversi_satuan/converter_capacitance" class="home-link">
        <li class="list-item konversi-item">
            <div class="item-icon f">F</div>
            <span class="item-title">Konversi Kapasitansi</span>
        </li>
    </a>

</ul>
</div>


</div>
</main>
</div>

<script>
// Toggle Dark Mode
const toggleBtn = document.getElementById('toggleDark');
const body = document.body;

// Load preference
if(localStorage.getItem('darkMode') === 'enabled'){
    body.classList.add('dark-mode');
    toggleBtn.textContent = 'Light Mode';
}

toggleBtn.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    if(body.classList.contains('dark-mode')){
        toggleBtn.textContent = 'Light Mode';
        localStorage.setItem('darkMode','enabled');
    } else {
        toggleBtn.textContent = 'Dark Mode';
        localStorage.setItem('darkMode','disabled');
    }
});
</script>

