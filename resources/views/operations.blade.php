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
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 0 0 25px 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .stats-card {
            background: rgba(61, 61, 61, 0.9);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-number {
            font-size: 2rem;
            font-weight: bold;
            color: #007bff;
        }

        .exercise-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 123, 255, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .exercise-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(135deg, #007bff, #0056b3);
        }

        .exercise-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }

        .exercise-number {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 15px;
        }

        .exercise-expression {
            font-size: 1.5em;
            color: #2c3e50;
            font-weight: 500;
            margin: 15px 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .answer-space {
            background: #f8f9fa;
            border: 2px dashed #007bff;
            border-radius: 8px;
            min-width: 100px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .answer-space:hover {
            background: #e3f2fd;
            border-color: #0056b3;
        }

        .solution-card {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            border: 1px solid #28a745;
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            display: none;
            animation: slideDown 0.4s ease-out;
        }

        .solution-text {
            color: #155724;
            font-weight: 600;
            font-size: 1.1em;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .control-panel {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin: 30px 0;
        }

        .btn-modern {
            border-radius: 12px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-primary-modern {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }

        .btn-success-modern {
            background: linear-gradient(135deg, #28a745, #1e7e34);
            color: white;
        }

        .btn-warning-modern {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #212529;
        }

        .btn-secondary-modern {
            background: linear-gradient(135deg, #6c757d, #545b62);
            color: white;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .progress-indicator {
            background: #e9ecef;
            border-radius: 10px;
            height: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .progress-bar-custom {
            background: linear-gradient(135deg, #28a745, #20c997);
            height: 100%;
            width: 0%;
            transition: width 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @media print {
            body {
                background: white !important;
            }

            .no-print {
                display: none !important;
            }

            .exercise-card {
                background: white !important;
                border: 2px solid #ddd !important;
                box-shadow: none !important;
                break-inside: avoid;
                page-break-inside: avoid;
                margin-bottom: 15px;
            }

            .exercise-card::before {
                background: #333 !important;
            }

            .solution-card {
                display: none !important;
            }

            .header-section {
                background: white !important;
                color: #333 !important;
                border-bottom: 3px solid #007bff;
            }
        }

        @media (max-width: 768px) {
            .exercise-expression {
                font-size: 1.3em;
            }

            .exercise-card {
                padding: 20px;
            }

            .control-panel {
                padding: 20px 15px;
            }
        }

        /* Remove setinhas no Chrome, Edge e Safari */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Remove setinhas no Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <!-- logo -->
    <x-logo />

    <!-- Header Section -->
    <div class="header-section no-print">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="display-6 fw-bold mb-2">🧮 Exercícios de Matemática</h1>
                    <p class="lead mb-0">Complete os exercícios e verifique suas respostas</p>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="stats-card">
                                <div class="stats-number">{{ count($exercises) }}</div>
                                <small>Exercícios</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stats-card">
                                <div class="stats-number" id="completedCount">0</div>
                                <small>Verificados</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Indicator -->
    <div class="container no-print">
        <div class="progress-indicator">
            <div class="progress-bar-custom" id="progressBar"></div>
        </div>
    </div>

    <!-- Exercises -->
    <div class="container">
        <div class="row" id="exercisesContainer">
            @foreach ($exercises as $exercise)
                <div class="col-12 col-lg-6 col-xl-4">
                    <div class="exercise-card" data-exercise="{{ $loop->iteration }}">
                        <div class="exercise-number">{{ $exercise['exercise_number'] }}</div>

                        <div class="exercise-expression">
                            <span>{{ str_replace(' =', ' =', $exercise['exercise']) }}</span>
                            <div class="answer-space" onclick="focusInput(this)">
                                <input type="number" class="form-control border-0 bg-transparent text-center fw-bold"
                                    placeholder="?" style="width: 80px;"
                                    onchange="checkAnswer(this, {{ $exercise['solution'] }})">
                            </div>
                        </div>

                        <div class="solution-card">
                            <p class="solution-text">
                                <span class="badge bg-success">✓</span>
                                Resposta: <strong>{{ $exercise['solution'] }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Control Panel -->
    <div class="container no-print">
        <div class="control-panel">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <a href="{{ route('home') }}" class="btn btn-primary-modern btn-modern">
                        <i class="bi bi-arrow-left me-2"></i>Nova Configuração
                    </a>
                </div>
                <div class="col-md-8 text-end">
                    <button onclick="showAllAnswers()" class="btn btn-success-modern btn-modern me-2" id="showBtn">
                        <i class="bi bi-eye me-2"></i>Mostrar Respostas
                    </button>
                    <button onclick="hideAllAnswers()" class="btn btn-warning-modern btn-modern me-2" id="hideBtn"
                        style="display: none;">
                        <i class="bi bi-eye-slash me-2"></i>Ocultar Respostas
                    </button>
                    <button onclick="resetExercises()" class="btn btn-secondary-modern btn-modern me-2">
                        <i class="bi bi-arrow-clockwise me-2"></i>Reiniciar
                    </button>
                    <button onclick="window.print()" class="btn btn-secondary-modern btn-modern">
                        <i class="bi bi-printer me-2"></i>Imprimir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <x-footer />

    <!-- bootstrap -->
    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>

    <script>
        let completedExercises = 0;
        const totalExercises = {{ count($exercises) }};

        function focusInput(answerSpace) {
            const input = answerSpace.querySelector('input');
            input.focus();
        }

        function checkAnswer(input, correctAnswer) {
            const userAnswer = parseFloat(input.value);
            const card = input.closest('.exercise-card');
            const solutionCard = card.querySelector('.solution-card');

            if (userAnswer === correctAnswer) {
                input.style.color = '#28a745';
                input.style.fontWeight = 'bold';
                solutionCard.style.display = 'block';
                solutionCard.innerHTML = `
                    <p class="solution-text">
                        <span class="badge bg-success">✓ Correto!</span>
                        Resposta: <strong>${correctAnswer}</strong>
                    </p>
                `;

                if (!card.classList.contains('completed')) {
                    card.classList.add('completed');
                    completedExercises++;
                    updateProgress();
                }
            } else if (input.value !== '') {
                input.style.color = '#dc3545';
                solutionCard.style.display = 'block';
                solutionCard.innerHTML = `
                    <p class="solution-text">
                        <span class="badge bg-danger">✗ Tente novamente</span>
                        Sua resposta: <strong>${userAnswer || 'Vazia'}</strong>
                    </p>
                `;
                solutionCard.style.background = 'linear-gradient(135deg, #f8d7da, #f5c6cb)';
                solutionCard.style.borderColor = '#dc3545';
            } else {
                solutionCard.style.display = 'none';
                input.style.color = '';
            }
        }

        function updateProgress() {
            const percentage = (completedExercises / totalExercises) * 100;
            document.getElementById('progressBar').style.width = percentage + '%';
            document.getElementById('completedCount').textContent = completedExercises;

            if (completedExercises === totalExercises) {
                setTimeout(() => {
                    alert('🎉 Parabéns! Você completou todos os exercícios!');
                }, 500);
            }
        }

        function showAllAnswers() {
            const solutionCards = document.querySelectorAll('.solution-card');
            const exercises = document.querySelectorAll('.exercise-card');

            exercises.forEach((card, index) => {
                const solutionCard = card.querySelector('.solution-card');
                const exerciseNumber = index + 1;
                const correctAnswer = {{ json_encode(array_column($exercises, 'solution')) }}[index];

                solutionCard.style.display = 'block';
                solutionCard.innerHTML = `
                    <p class="solution-text">
                        <span class="badge bg-info">📝</span>
                        Resposta: <strong>${correctAnswer}</strong>
                    </p>
                `;
                solutionCard.style.background = 'linear-gradient(135deg, #d1ecf1, #b6dfea)';
                solutionCard.style.borderColor = '#17a2b8';
            });

            document.getElementById('showBtn').style.display = 'none';
            document.getElementById('hideBtn').style.display = 'inline-block';
        }

        function hideAllAnswers() {
            const solutionCards = document.querySelectorAll('.solution-card');
            solutionCards.forEach(card => {
                card.style.display = 'none';
            });

            document.getElementById('showBtn').style.display = 'inline-block';
            document.getElementById('hideBtn').style.display = 'none';
        }

        function resetExercises() {
            if (confirm('Tem certeza que deseja reiniciar todos os exercícios?')) {
                const inputs = document.querySelectorAll('.exercise-card input');
                const solutionCards = document.querySelectorAll('.solution-card');

                inputs.forEach(input => {
                    input.value = '';
                    input.style.color = '';
                    input.style.fontWeight = '';
                });

                solutionCards.forEach(card => {
                    card.style.display = 'none';
                });

                document.querySelectorAll('.exercise-card').forEach(card => {
                    card.classList.remove('completed');
                });

                completedExercises = 0;
                updateProgress();
                hideAllAnswers();
            }
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Add enter key support for inputs
            document.querySelectorAll('.exercise-card input').forEach(input => {
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        const correctAnswer = parseFloat(this.closest('.exercise-card')
                            .querySelector('.solution-card').textContent.match(/\d+\.?\d*/)[0]);
                        checkAnswer(this, correctAnswer);
                    }
                });
            });
        });
    </script>
</body>

</html>
