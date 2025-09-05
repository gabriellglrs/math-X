<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercícios de Matemática - Impressão</title>

    <style>
        @page {
            size: A4;
            margin: 2cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: white;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5em;
            color: #007bff;
        }

        .header p {
            margin: 10px 0 0 0;
            color: #666;
        }

        .metadata {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 30px;
            border-left: 4px solid #007bff;
        }

        .metadata h3 {
            margin-top: 0;
            color: #495057;
        }

        .exercises-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        .exercise-item {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            page-break-inside: avoid;
        }

        .exercise-number {
            background: #007bff;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .exercise-expression {
            font-size: 1.4em;
            font-weight: 500;
            margin: 10px 0;
        }

        .answer-line {
            border-bottom: 2px solid #333;
            min-width: 80px;
            display: inline-block;
            margin-left: 15px;
            height: 25px;
        }

        .solutions-section {
            page-break-before: always;
            margin-top: 40px;
        }

        .solutions-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .solution-item {
            background: #e8f5e8;
            border: 1px solid #28a745;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: 1cm;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.9em;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        @media screen {
            body {
                max-width: 21cm;
                margin: 0 auto;
                padding: 20px;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📚 Exercícios de Matemática</h1>
        <p>Complete os exercícios abaixo</p>
    </div>

    @if(isset($metadata))
    <div class="metadata">
        <h3>📋 Informações dos Exercícios</h3>
        <p><strong>Data de geração:</strong> {{ $metadata['generated_at']->format('d/m/Y H:i:s') }}</p>
        <p><strong>Total de exercícios:</strong> {{ $metadata['total_exercises'] }}</p>
        <p><strong>Operações:</strong> {{ implode(', ', array_map('ucfirst', $metadata['operations'])) }}</p>
        <p><strong>Intervalo de números:</strong> {{ $metadata['range']['min'] }} a {{ $metadata['range']['max'] }}</p>
    </div>
    @endif

    <div class="exercises-grid">
        @foreach($exercises as $exercise)
            <div class="exercise-item">
                <div class="exercise-number">{{ $exercise['exercise_number'] }}</div>
                <div class="exercise-expression">
                    {{ $exercise['exercise'] }}
                    <span class="answer-line"></span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="solutions-section">
        <div class="header">
            <h2>✅ Respostas</h2>
        </div>

        <div class="solutions-grid">
            @foreach($exercises as $exercise)
                <div class="solution-item">
                    <strong>{{ $exercise['exercise_number'] }}.</strong>
                    {{ $exercise['solution'] }}
                </div>
            @endforeach
        </div>
    </div>

    <div class="footer">
        <p>{{ config('app.name', 'MathX') }} © {{ date('Y') }} - Gerado em {{ date('d/m/Y H:i') }}</p>
    </div>
</body>
</html>
