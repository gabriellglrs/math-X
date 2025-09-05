<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME')}}</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            margin-bottom: 40px;
            border-radius: 0 0 30px 30px;
        }

        .operation-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            border: 2px solid transparent;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .operation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .operation-card.selected {
            border-color: #007bff;
            background: linear-gradient(145deg, #e3f2fd 0%, #bbdefb 100%);
        }

        .operation-icon {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #007bff;
        }

        .form-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .section-title {
            color: #495057;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #007bff;
            display: inline-block;
        }

        .range-display {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            margin: 15px 0;
            border: 2px dashed #dee2e6;
        }

        .range-preview {
            font-size: 1.2em;
            color: #007bff;
            font-weight: bold;
        }

        .exercises-counter {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 15px;
            padding: 20px;
            text-align: center;
        }

        .counter-display {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .btn-generate {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            border-radius: 15px;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,123,255,0.3);
        }

        .btn-generate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,123,255,0.4);
        }

        .btn-generate:disabled {
            background: #6c757d;
            transform: none;
            box-shadow: none;
        }

        .alert-modern {
            border: none;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 30px 15px;
            }

            .form-section {
                padding: 20px 15px;
            }

            .operation-card {
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body style="background: #f5f7fa;">

<!-- logo -->
<x-logo/>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3">🧮 Gerador de Exercícios</h1>
        <p class="lead">Configure e gere exercícios matemáticos personalizados para seus estudos</p>
    </div>
</div>

<!-- Error Messages -->
@if($errors->any())
    <div class="container">
        <div class="alert alert-danger alert-modern" role="alert">
            <div class="d-flex align-items-center mb-2">
                <i class="bi bi-exclamation-triangle-fill me-2" style="font-size: 1.5rem;"></i>
                <h5 class="mb-0">Ops! Alguns ajustes são necessários</h5>
            </div>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<!-- Main Form -->
<form action="{{ route('generateExercises') }}" method="post" id="exerciseForm">
    @csrf
    <div class="container">
        <div class="row">

            <!-- Operations Section -->
            <div class="col-lg-4 mb-4">
                <div class="form-section">
                    <h4 class="section-title">📊 Operações</h4>

                    <div class="operation-card" data-operation="sum">
                        <div class="text-center">
                            <div class="operation-icon">➕</div>
                            <h6 class="fw-bold">Soma</h6>
                            <small class="text-muted">Adição de números</small>
                        </div>
                        <input type="checkbox" name="check_sum" class="d-none" checked>
                    </div>

                    <div class="operation-card" data-operation="subtraction">
                        <div class="text-center">
                            <div class="operation-icon">➖</div>
                            <h6 class="fw-bold">Subtração</h6>
                            <small class="text-muted">Subtração de números</small>
                        </div>
                        <input type="checkbox" name="check_subtraction" class="d-none" checked>
                    </div>

                    <div class="operation-card" data-operation="multiplication">
                        <div class="text-center">
                            <div class="operation-icon">✖️</div>
                            <h6 class="fw-bold">Multiplicação</h6>
                            <small class="text-muted">Multiplicação de números</small>
                        </div>
                        <input type="checkbox" name="check_multiplication" class="d-none" checked>
                    </div>

                    <div class="operation-card" data-operation="division">
                        <div class="text-center">
                            <div class="operation-icon">➗</div>
                            <h6 class="fw-bold">Divisão</h6>
                            <small class="text-muted">Divisão de números</small>
                        </div>
                        <input type="checkbox" name="check_division" class="d-none" checked>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            Selecione pelo menos uma operação
                        </small>
                    </div>
                </div>
            </div>

            <!-- Numbers Range Section -->
            <div class="col-lg-4 mb-4">
                <div class="form-section">
                    <h4 class="section-title">🎯 Intervalo de Números</h4>

                    <div class="mb-3">
                        <label for="number_one" class="form-label fw-semibold">
                            <i class="bi bi-arrow-down-circle me-1"></i>Valor Mínimo
                        </label>
                        <input type="number" class="form-control form-control-lg"
                               id="number_one" name="number_one"
                               min="0" max="999" value="0"
                               style="border-radius: 10px;">
                    </div>

                    <div class="mb-3">
                        <label for="number_two" class="form-label fw-semibold">
                            <i class="bi bi-arrow-up-circle me-1"></i>Valor Máximo
                        </label>
                        <input type="number" class="form-control form-control-lg"
                               id="number_two" name="number_two"
                               min="1" max="999" value="100"
                               style="border-radius: 10px;">
                    </div>

                    <div class="range-display">
                        <small class="text-muted d-block">Intervalo selecionado:</small>
                        <div class="range-preview" id="rangePreview">0 a 100</div>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="bi bi-lightbulb me-1"></i>
                            Escolha números entre 0 e 999
                        </small>
                    </div>
                </div>
            </div>

            <!-- Exercises Count and Generate -->
            <div class="col-lg-4 mb-4">
                <div class="form-section">
                    <h4 class="section-title">📝 Quantidade</h4>

                    <div class="exercises-counter">
                        <div class="counter-display" id="exercisesCounter">10</div>
                        <div>Exercícios</div>
                    </div>

                    <div class="mt-3">
                        <label for="number_exercises" class="form-label fw-semibold">
                            <i class="bi bi-hash me-1"></i>Número de Exercícios
                        </label>
                        <input type="range" class="form-range"
                               id="number_exercises" name="number_exercises"
                               min="5" max="50" value="10"
                               style="height: 8px;">
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">5</small>
                            <small class="text-muted">50</small>
                        </div>
                    </div>

                    <div class="mt-4 d-grid">
                        <button type="submit" class="btn btn-generate" id="generateBtn">
                            <i class="bi bi-magic me-2"></i>
                            Gerar Exercícios
                        </button>
                    </div>

                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="bi bi-clock me-1"></i>
                            Entre 5 e 50 exercícios
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<!-- footer -->
<x-footer/>

<!-- bootstrap -->
<script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Operation cards interaction
    const operationCards = document.querySelectorAll('.operation-card');

    operationCards.forEach(card => {
        const checkbox = card.querySelector('input[type="checkbox"]');

        // Initialize card state
        updateCardState(card, checkbox.checked);

        card.addEventListener('click', function() {
            checkbox.checked = !checkbox.checked;
            updateCardState(card, checkbox.checked);
            validateForm();
        });
    });

    function updateCardState(card, isChecked) {
        if (isChecked) {
            card.classList.add('selected');
        } else {
            card.classList.remove('selected');
        }
    }

    // Range preview update
    const minInput = document.getElementById('number_one');
    const maxInput = document.getElementById('number_two');
    const rangePreview = document.getElementById('rangePreview');

    function updateRangePreview() {
        const min = minInput.value;
        const max = maxInput.value;
        rangePreview.textContent = `${min} a ${max}`;

        // Validate range
        if (parseInt(min) >= parseInt(max)) {
            rangePreview.style.color = '#dc3545';
            rangePreview.innerHTML = `${min} a ${max} <small>(⚠️ Inválido)</small>`;
        } else {
            rangePreview.style.color = '#007bff';
        }
    }

    minInput.addEventListener('input', updateRangePreview);
    maxInput.addEventListener('input', updateRangePreview);

    // Exercises counter update
    const exercisesInput = document.getElementById('number_exercises');
    const exercisesCounter = document.getElementById('exercisesCounter');

    function updateExercisesCounter() {
        exercisesCounter.textContent = exercisesInput.value;
    }

    exercisesInput.addEventListener('input', updateExercisesCounter);

    // Form validation
    function validateForm() {
        const checkedOperations = document.querySelectorAll('input[type="checkbox"]:checked').length;
        const generateBtn = document.getElementById('generateBtn');

        if (checkedOperations === 0) {
            generateBtn.disabled = true;
            generateBtn.innerHTML = '<i class="bi bi-exclamation-triangle me-2"></i>Selecione uma operação';
        } else {
            generateBtn.disabled = false;
            generateBtn.innerHTML = '<i class="bi bi-magic me-2"></i>Gerar Exercícios';
        }
    }

    // Initialize
    updateRangePreview();
    updateExercisesCounter();
    validateForm();

    // Form submission feedback
    document.getElementById('exerciseForm').addEventListener('submit', function() {
        const generateBtn = document.getElementById('generateBtn');
        generateBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Gerando...';
        generateBtn.disabled = true;
    });
});
</script>

</body>
</html>
