<header class="header-top">
    <h1>Kalkulator Hukum Ohm </h1>
</header>

<div class="main-container">

    <div class="calc-header">
        <span class="icon">⚡</span>
        <h2>Kalkulator Hukum Ohm</h2>
    </div>

    <p class="description">
        Masukkan dua nilai, sistem akan menghitung nilai yang belum diketahui.
    </p>

    <div class="input-group">
        <label>Tegangan (V)</label>
        <input type="number" id="v" value="12">
    </div>

    <div class="input-group">
        <label>Arus (I)</label>
        <input type="number" id="i" value="2">
    </div>

    <div class="input-group">
        <label>Resistansi (R)</label>
        <input type="number" id="r" placeholder="Hasil">
    </div>

    <button class="calculate-btn" onclick="hitung()">Hitung</button>

    <div id="result-area"></div>

</div>

<script>
    function hitung() {        
        let V = document.getElementById('v').value === "" ? null : parseFloat(document.getElementById('v').value);
        let I = document.getElementById('i').value === "" ? null : parseFloat(document.getElementById('i').value);
        let R = document.getElementById('r').value === "" ? null : parseFloat(document.getElementById('r').value);
    
        const V_input = document.getElementById('v');
        const I_input = document.getElementById('i');
        const R_input = document.getElementById('r');
        const result_area = document.getElementById('result-area');

        V_input.style.backgroundColor = 'white';
        I_input.style.backgroundColor = 'white';
        R_input.style.backgroundColor = 'white';
        result_area.innerHTML = '';
    
        const inputs_given = [V, I, R].filter(val => val !== null && !isNaN(val)).length;

        let hasil = '';
        let steps = '';
        let result_value = 0;
        let unknown_variable_name = '';

        if (inputs_given !== 2) {
            result_area.innerHTML = `
                <div class="result-box" style="background:#fff3cd; border-color:#ffeeba;">
                    <div class="result-value" style="color:red;">ERROR!</div>
                    <div class="steps" style="color:#856404;">Harap masukkan tepat dua nilai untuk menghitung nilai yang belum diketahui.</div>
                </div>
            `;
            return;
        }
        
        if (V === null) {
            result_value = I * R;
            unknown_variable_name = 'Tegangan (V)';
            formula = 'V = I &times; R';
            
            V_input.value = result_value.toFixed(2);
            V_input.style.backgroundColor = '#ccffcc'; 
            
            hasil = `${unknown_variable_name} = ${result_value.toFixed(2)} Volt`;
            steps = `<div>${formula}</div><div>V = ${I} &times; ${R}</div>`;
        }
        
        else if (I === null) {
            if (R === 0) {
                result_area.innerHTML = `
                    <div class="result-box" style="background:#f8d7da; border-color:#f5c6cb;">
                        <div class="result-value" style="color:#721c24;">ERROR!</div>
                        <div class="steps" style="color:#721c24;">Resistansi (R) tidak boleh nol saat menghitung Arus.</div>
                    </div>
                `;
                return;
            }
            result_value = V / R;
            unknown_variable_name = 'Arus (I)';
            formula = 'I = V &div; R';
            
            I_input.value = result_value.toFixed(2);
            I_input.style.backgroundColor = '#ccffcc';
            
            hasil = `${unknown_variable_name} = ${result_value.toFixed(2)} Ampere`;
            steps = `<div>${formula}</div><div>I = ${V} &div; ${R}</div>`;
        }
        
        else if (R === null) {
            // Cek jika pembagi I adalah nol
            if (I === 0) {
                 result_area.innerHTML = `
                    <div class="result-box" style="background:#f8d7da; border-color:#f5c6cb;">
                        <div class="result-value" style="color:#721c24;">ERROR!</div>
                        <div class="steps" style="color:#721c24;">Arus (I) tidak boleh nol saat menghitung Resistansi.</div>
                    </div>
                `;
                return;
            }
            result_value = V / I;
            unknown_variable_name = 'Resistansi (R)';
            formula = 'R = V &div; I';
            
            R_input.value = result_value.toFixed(2);
            R_input.style.backgroundColor = '#ccffcc';
            
            hasil = `${unknown_variable_name} = ${result_value.toFixed(2)} &Omega;`;
            steps = `<div>${formula}</div><div>R = ${V} &div; ${I}</div>`;
        }
        
        document.getElementById('result-area').innerHTML = `
            <div class="result-box">
                <div class="result-value">${hasil}</div>
                <div class="steps">${steps}</div>
            </div>
        `;
        // Kirim data ke server untuk disimpan
        let V_save = V === null ? result_value : V;
        let I_save = I === null ? result_value : I;
        let R_save = R === null ? result_value : R;

        saveHistory(V_save, I_save, R_save, hasil);
    }

    // --- Simpan history otomatis ke MySQL ---
    function saveHistory(V, I, R, hasil){
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "pages/calculator/save_history_ohm.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`V=${V}&I=${I}&R=${R}&hasil=${encodeURIComponent(hasil)}`);

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

    const inputs = [document.getElementById('v'), document.getElementById('i'), document.getElementById('r')];
    
    inputs.forEach(input => {
        input.addEventListener('input', () => {
           
            document.getElementById('result-area').innerHTML = '';
            
            inputs.forEach(other_input => {
                if (other_input !== input) {
                    other_input.style.backgroundColor = 'white';            
                    if (input.value !== "") {
                        if (other_input.value !== "" && other_input.style.backgroundColor === 'white') {
                        }
                    }
                }
            });
        });
    });

</script>

