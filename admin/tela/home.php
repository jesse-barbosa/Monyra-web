<style>
        .card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-body i {
            color: #4caf50;
        }
        .card-body h3 {
            margin: 1rem 0;
        }
        .fw-lighter {
            font-weight: 300;
        }
    </style>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-10">
                <div>
                    <h1 class="fw-normal" id="welcome-message"></h1>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="py-2 bg-dark rounded text-light" id="date-time"></div>
            </div>
        </div>
    </div>

    <script>
        function getGreeting() {
            const hours = new Date().getHours();
            if (hours < 12) {
                return 'Bom dia';
            } else if (hours < 18) {
                return 'Boa tarde';
            } else {
                return 'Boa noite';
            }
        }

        function formatDateTime() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit' };
            return now.toLocaleTimeString('pt-BR', options);
        }

        document.getElementById('welcome-message').innerText = `${getGreeting()}, <?php echo $_SESSION['nome'];?>`;
        document.getElementById('date-time').innerText = `${formatDateTime()}`;
        
        // Update time every minute
        setInterval(() => {
            document.getElementById('date-time').innerText = `${formatDateTime()}`;
        }, 60000);
    </script>
    <hr class="mt-4">
    <div class="container-fluid mt-5">
        <div class="row">
            <h3 class="mb-4 text-secondary fw-normal">Total Registros</h3>
            <?php
            $cards = [
                ['icon' => 'bi-people', 'file' => 'MostrarItem', 'class' => 'Mostrar', 'method' => 'totalUsers', 'label' => 'Total de Usuários'],
                ['icon' => 'bi-bookmark', 'file' => 'MostrarItem', 'class' => 'Mostrar', 'method' => 'totalGoals', 'label' => 'Total de Metas'],
                ['icon' => 'bi-currency-exchange', 'file' => 'MostrarItem', 'class' => 'Mostrar', 'method' => 'totalTransfers', 'label' => 'Total de Transferências']
            ];

            foreach ($cards as $card) {
                echo '<div class="col-md-2 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi ' . $card['icon'] .' text-dark fs-1"></i>';
                                include_once("../classe/" . $card['file'] . ".php");
                                $total = new $card['class']();
                                echo '<h3 class="text-dark fw-bold">' . $total->{$card['method']}() . '</h3>
                                <p class="card-text fw-lighter">' . $card['label'] . '</p>
                            </div>
                        </div>
                      </div>';
            }
            ?>
        </div>
    </div>