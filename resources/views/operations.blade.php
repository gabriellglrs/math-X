<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ getenv('APP_NAME') }}</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">
    <!-- bootstrap -->
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="assets/css/main.css">

    <style>
        .exercise-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #007bff;
        }

        .exercise-number {
            font-size: 1.1em;
            margin-right: 15px;
        }

        .exercise-expression {
            font-size: 1.4em;
            color: #333;
            font-weight: normal;
        }

        .solution {
            color: #28a745;
            font-weight: bold;
        }

        .answer-line {
            border-bottom: 2px solid #333;
            min-width: 100px;
            display: inline-block;
            margin-left: 10px;
            height: 30px;
        }

        @media print {
            .no-print { display: none !important; }
            .exercise-item {
                background: white !important;
                border: 1px solid #ddd !important;
                break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <!-- logo -->
    <x-logo/>

    <!-- operations -->
    <div class="container">
        <hr>

        <div class="row mb-4">
            <div class="col-12">
                <h2>Exercícios de Matemática</h2>
            </div>
        </div>

        <div class="row">
            @foreach ($exercises as $exercise)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="exercise-item">
                        <span class="badge bg-primary exercise-number">{{ $exercise['exercise_number'] }}</span>
                        <div class="exercise-expression mt-2">
                            {{ str_replace(' = ', ' = ', $exercise['exercise']) }}<span class="answer-line"></span>
                        </div>
                        <div class="solution mt-2" style="display: none;">
                            Resposta: {{ $exercise['solution'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>
    </div>

    <!-- Controles -->
    <div class="container mt-5 no-print">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ url()->previous() }}" class="btn btn-primary px-4">
                    ← VOLTAR
                </a>
            </div>
            <div class="col-md-6 text-end">
                <button onclick="toggleSolutions()" class="btn btn-info px-4 me-2" id="toggleBtn">
                    MOSTRAR SOLUÇÕES
                </button>
                <button onclick="window.print()" class="btn btn-secondary px-4">
                    IMPRIMIR
                </button>
            </div>
        </div>
    </div>

    <!-- footer -->
    <x-footer/>

    <!-- bootstrap -->
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>

    <script>
        let solutionsVisible = false;

        function toggleSolutions() {
            const solutions = document.querySelectorAll('.solution');
            const toggleBtn = document.getElementById('toggleBtn');
            const hideBtn = document.getElementById('hideBtn');

            solutions.forEach(solution => {
                solution.style.display = 'block';
                solution.style.animation = 'fadeIn 0.5s ease-in';
            });

            toggleBtn.style.display = 'none';
            hideBtn.style.display = 'inline-block';
            solutionsVisible = true;
        }

        function hideSolutions() {
            const solutions = document.querySelectorAll('.solution');
            const toggleBtn = document.getElementById('toggleBtn');
            const hideBtn = document.getElementById('hideBtn');

            solutions.forEach(solution => {
                solution.style.display = 'none';
            });

            toggleBtn.style.display = 'inline-block';
            hideBtn.style.display = 'none';
            solutionsVisible = false;
        }

        // CSS Animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(-10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
