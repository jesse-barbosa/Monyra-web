    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container ms-5">
    <h2 class="mt-5 text-purple fw-bold mb-2">Análise de Finanças</h2>
        <div class="row">
            <div class="col-5">
                <canvas id="gastosMensais" width="400" height="200"></canvas>
            </div>
            <div class="col-5">
                <canvas id="ganhosMensais" width="400" height="200"></canvas>
            </div>
        </div>
    <h2 class="mt-5 ms-3 text-purple fw-bold mb-4">Suas transferências</h2>
        <div class="row p-2">
            <div class="col-3 m-2">
                <div class="card border-0">
                <div class="card-body ps-4 pt-4">
                    <h6 class="card-subtitle mb-2 fw-medium opacity-50">07-08-2024</h6>
                    <h5 class="card-title">Gastos R$25</h5>
                    <p class="card-subtitle mb-2 opacity-50">'Pagamento'</p>
                </div>
                </div>
            </div>
            <div class="col-3 m-2">
                <div class="card border-0">
                <div class="card-body ps-4 pt-4">
                    <h6 class="card-subtitle mb-2 fw-medium opacity-50">07-08-2024</h6>
                    <h5 class="card-title">Gastos R$25</h5>
                    <p class="card-subtitle mb-2 opacity-50">'Pagamento'</p>
                </div>
                </div>
            </div>
            <div class="col-3 m-2">
                <div class="card border-0">
                <div class="card-body ps-4 pt-4">
                    <h6 class="card-subtitle mb-2 fw-medium opacity-50">07-08-2024</h6>
                    <h5 class="card-title">Gastos R$25</h5>
                    <p class="card-subtitle mb-2 opacity-50">'Pagamento'</p>
                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script>
        // Gráfico de gastos mensais
        const ctxGastosMensais = document.getElementById('gastosMensais').getContext('2d');
        new Chart(ctxGastosMensais, {
            type: 'bar',
            data: {
                labels: ['Inve', 'Saúd', 'Educ', 'Vest', 'Mora', 'Inves'],
                datasets: [{
                    label: 'Gastos',
                    data: [100, 120, 150, 180, 200, 220],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
        });

        // Gráfico de ganhos mensais
        const ctxGanhosMensais = document.getElementById('ganhosMensais').getContext('2d');
        new Chart(ctxGanhosMensais, {
            type: 'bar',
            data: {
                labels: ['Remu', 'Rend', 'Empre', 'Bene'],
                datasets: [{
                    label: 'Ganhos',
                    data: [150, 180, 200, 220],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
        });

    </script>